<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use WebDevEtc\BlogEtc\Interfaces\BaseRequestInterface;
use WebDevEtc\BlogEtc\Events\BlogPostAdded;
use WebDevEtc\BlogEtc\Events\BlogPostEdited;
use WebDevEtc\BlogEtc\Events\BlogPostWillBeDeleted;
use WebDevEtc\BlogEtc\Helpers;
use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;
use App\BlogPost;
use WebDevEtc\BlogEtc\Models\BlogEtcUploadedPhoto;
use App\Http\Requests\CreateBlogEtcPostRequest;
use WebDevEtc\BlogEtc\Requests\DeleteBlogEtcPostRequest;
use App\Http\Requests\UpdateBlogEtcPostRequest;
use WebDevEtc\BlogEtc\Traits\UploadFileTrait;
use Validator;

/**
 * Class BlogAdminController
 * @package WebDevEtc\BlogEtc\Controllers
 */
class BlogAdminController extends Controller
{
    use UploadFileTrait;

    /**
     * BlogAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class)->except('login');

        if (!is_array(config("blogetc"))) {
            throw new \RuntimeException('The config/blogetc.php does not exist. Publish the vendor files for the BlogEtc package by running the php artisan publish:vendor command');
        }
    }

    public function login(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required'
            ]
        ], [])->validate();
        /*attempt to do the login*/
        $rememberMe = ($request->has('remember') && $request->get('remember') == 'on') ? true : false;
        if (\Auth::attempt(['email' => $request->email, 'password' => $request->password], $rememberMe)) {
            if (!\Auth::user()->canManageBlogEtcPosts()) {
                abort(401, "User not authorised to manage blog posts: Your account is not authorised to edit blog posts");
            }
            return redirect()->route('blogetc.admin.index');
        }

        return redirect()->back()
        ->withInput($request->only('email', 'remember'))
        ->withErrors([
            'email' => 'These credentials do not match our records.'
        ]);
    }


    /**
     * View all posts
     *
     * @return mixed
     */
    public function index()
    {
        $posts = BlogPost::orderBy("posted_at", "desc")
            ->paginate(10);

        return view("blogetc_admin::index", ['posts'=>$posts]);
    }

    /**
     * Show form for creating new post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_post()
    {
        return view("blogetc_admin::posts.add_post");
    }

    /**
     * Save a new post
     *
     * @param CreateBlogEtcPostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store_post(CreateBlogEtcPostRequest $request)
    {
        $new_blog_post = new BlogPost($request->all());

        $this->processUploadedImages($request, $new_blog_post);

        if (!$new_blog_post->posted_at) {
            $new_blog_post->posted_at = Carbon::now();
        }

        $new_blog_post->user_id = \Auth::user()->id;
        $new_blog_post->save();

        $new_blog_post->categories()->sync($request->categories());

        Helpers::flash_message("Added post");
        event(new BlogPostAdded($new_blog_post));
        return redirect($new_blog_post->edit_url());
    }

    /**
     * Show form to edit post
     *
     * @param $blogPostId
     * @return mixed
     */
    public function edit_post($blogPostId)
    {
        $post = BlogPost::findOrFail($blogPostId);
        return view("blogetc_admin::posts.edit_post")->withPost($post);
    }

    /**
     * Save changes to a post
     *
     * @param UpdateBlogEtcPostRequest $request
     * @param $blogPostId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function update_post(UpdateBlogEtcPostRequest $request, $blogPostId)
    {
        /** @var BlogPost $post */
        $post = BlogPost::findOrFail($blogPostId);
        $post->fill($request->all());

        $this->processUploadedImages($request, $post);

        $post->save();
        $post->categories()->sync($request->categories());
        Helpers::flash_message("Updated post");
        event(new BlogPostEdited($post));

        return redirect($post->edit_url());
    }

    /**
     * Delete a post
     *
     * @param DeleteBlogEtcPostRequest $request
     * @param $blogPostId
     * @return mixed
     */
    public function destroy_post(DeleteBlogEtcPostRequest $request, $blogPostId)
    {
        $post = BlogPost::findOrFail($blogPostId);
        event(new BlogPostWillBeDeleted($post));

        $post->delete();

        // todo - delete the featured images?
        // At the moment it just issues a warning saying the images are still on the server.

        return view("blogetc_admin::posts.deleted_post")
            ->withDeletedPost($post);
    }

    /**
     * Process any uploaded images (for featured image)
     *
     * @param BaseRequestInterface $request
     * @param $new_blog_post
     * @throws \Exception
     * @todo - next full release, tidy this up!
     */
    protected function processUploadedImages(BaseRequestInterface $request, BlogPost $new_blog_post)
    {
        if (!config("blogetc.image_upload_enabled")) {
            // image upload was disabled
            return;
        }

        $this->increaseMemoryLimit();

        // to save in db later
        $uploaded_image_details = [];


        foreach ((array)config('blogetc.image_sizes') as $size => $image_size_details) {
            if ($image_size_details['enabled'] && $photo = $request->get_image_file($size)) {
                // this image size is enabled, and
                // we have an uploaded image that we can use

                $uploaded_image = $this->UploadAndResize($new_blog_post, $new_blog_post->title, $image_size_details, $photo);

                $new_blog_post->$size = $uploaded_image['filename'];
                $uploaded_image_details[$size] = $uploaded_image;
            }
        }


        // store the image upload.
        // todo: link this to the blogetc_post row.
        if (count(array_filter($uploaded_image_details))>0) {
            BlogEtcUploadedPhoto::create([
                'source' => "BlogFeaturedImage",
                'uploaded_images' => $uploaded_image_details,
            ]);
        }
    }
}
