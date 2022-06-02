<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Swis\LaravelFulltext\Search;
use WebDevEtc\BlogEtc\Captcha\UsesCaptcha;
use App\BlogCategory;
use App\BlogPost;
use App\YoutubeVideo;

/**
 * Class BlogEtcReaderController
 * All of the main public facing methods for viewing blog content (index, single posts)
 * @package WebDevEtc\BlogEtc\Controllers
 */
class BlogReaderController extends Controller
{
    use UsesCaptcha;

    /**
     * Show blog posts
     * If category_slug is set, then only show from that category
     *
     * @param null $category_slug
     * @return mixed
     */
    public function index()
    {
        $feature_post = $home_posts = $home_categories = [];
        $title = 'Urban Engima Fashion Blog | Lifestyle & Culture | Enigma News';
        $feature_posts = BlogPost::where('is_published', 1)->where("is_featured", 1)->orderBy("posted_at", "desc")->take(7)->get();
        $home_posts = BlogPost::where('is_published', 1)->where('is_featured', 1)->orderBy("posted_at", "desc")->skip(7)->take(18)->get();
        $home_categories = BlogCategory::where('is_show_to_home', 1)
        ->orderBy('id', 'desc')
        ->get();
        foreach ($home_categories as $category) {
            $category->posts = $category->posts()->orderBy("posted_at", "desc")->take(8)->get();
        }
        $videos = YoutubeVideo::where('is_featured', 1)->where('status', 1)->orderBy('display_order_home', 'ASC')->get()->take(2);


        $ig_posts = [];
        $counter = 9;

        $ig_access_token = env('IG_ACCESS_TOKEN');
        try {
            $url = 'https://graph.instagram.com/'.env('IG_PAGE_ID', 6240161132721512).'/media?limit='.$counter.'&access_token=' . $ig_access_token;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $result = json_decode($response);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        if ($result && isset($result->data)) {
            foreach ($result->data as $media_id) {
                $id = $media_id->id;
                if ($id) {
                    try {
                        $url = 'https://graph.instagram.com/'.$id.'?fields=id,media_type,media_url,caption,timestamp,permalink,thumbnail_url&access_token=' . $ig_access_token;
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_TIMEOUT => 30000,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                            ),
                        ));
                        $result_image = curl_exec($ch);
                        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        curl_close($ch);
                        $result_image = json_decode($result_image);
                        $media_url = $caption = $video_url = '';

                        if ($result_image->media_type == "IMAGE") {
                            $media_url = $result_image->media_url;
                        } elseif ($result_image->media_type == "VIDEO") {
                            $media_url = $result_image->thumbnail_url;
                            $video_url = $result_image->media_url;
                        }
                        if (isset($result_image->caption)) {
                            $caption = $result_image->caption;
                        }

                        $ig_posts[] = ['permalink' => $result_image->permalink,'media_url' => $media_url,'caption' => $caption,'video_url' => $video_url];
                    } catch (\Exception $e) {
                        \Log::error($e->getMessage());
                    }
                }
            }
        }

        return view("blogetc::index", [
            'title' => $title,
            'meta_description' => 'Urban Engima`s blog is about the latest trends & news in clothing fashion, accessories, and everything else related to lifestyle & culture. We provide you with the hottest looks on earth as well as a different thought perspective!',
            'feature_posts' => $feature_posts,
            'home_posts' => $home_posts,
            'home_categories' => $home_categories,
            'videos' => $videos,
            'ig_posts' => $ig_posts,
        ]);
    }

    /**
     * Show the search results for $_GET['s']
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function search(Request $request)
    {
        if (!config("blogetc.search.search_enabled")) {
            throw new \Exception("Search is disabled");
        }
        $query = $request->get("s");
        $search = new Search();
        $search_results = $search->run($query);

        \View::share("title", "Search results for " . e($query));

        return view("blogetc::search", [
            'title' => "Search results for " . e($query). ' - Fashion Blog',
            'meta_description' => 'Urban Enigma is a Brand known for its unique clothing & accessories to stand out from crowd, show the world that you are different, that you are an Enigma.',
            'query' => $query,
            'search_results' => $search_results
        ]);
    }




    /**
     * View all posts in $category_slug category
     *
     * @param Request $request
     * @param $category_slug
     * @return mixed
     */
    public function view_category($category_slug, Request $request)
    {
        $category = BlogCategory::where("slug", $category_slug)->firstOrFail();
        $posts_query = $category->posts();

        if (isset($request->order_by) && $request->order_by == 'oldest') {
            $posts_query->orderBy('posted_at', 'ASC');
        } elseif (isset($request->order_by) && $request->order_by == 'newest') {
            $posts_query->orderBy('posted_at', 'DESC');
        } else {
            $posts_query->orderBy('posted_at', 'DESC');
        }

        $posts = $posts_query->paginate(12);
        $description = 'Urban Enigma is a Brand known for its unique clothing & accessories to stand out from crowd, show the world that you are different, that you are an Enigma.';
        if ($category->category_description) {
            $description = $category->category_description;
        }
        return view("blogetc::category", [
            'title' => $category->category_name . ' - Fashion Blog',
            'meta_description' => $description,
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    /**
     * View a single post and (if enabled) it's comments
     *
     * @param Request $request
     * @param $blogPostSlug
     * @return mixed
     */
    public function viewSinglePost(Request $request, $blogPostSlug)
    {
        $blog_post = BlogPost::where("slug", $blogPostSlug)
            ->firstOrFail();

        $description = 'Urban Enigma is a Brand known for its unique clothing & accessories to stand out from crowd, show the world that you are different, that you are an Enigma.';
        if ($blog_post->meta_desc) {
            $description = $blog_post->meta_desc;
        }

        return view("blogetc::single_post", [
            'post' => $blog_post,
            'meta_description' => $description,
        ]);
    }

    public function videos(Request $request)
    {
        $videos = YoutubeVideo::where('status', 1)->orderBy('id', 'desc')->paginate(12);

        return view("blogetc::videos", [
            'title' => 'Urban Enigma Videos',
            'videos' => $videos,
            'meta_description' => 'Urban Enigma Videos',
        ]);
    }
}
