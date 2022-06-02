<?php

namespace App\Http\Controllers;

use App\YoutubeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;

class YoutubeVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);

        if (!is_array(config("blogetc"))) {
            throw new \RuntimeException('The config/blogetc.php does not exist. Publish the vendor files for the BlogEtc package by running the php artisan publish:vendor command');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = YoutubeVideo::orderBy("created_at", "desc")
            ->paginate(10);

        return view("blogetc_admin::videos.index", ['videos'=>$videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blogetc_admin::videos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'url' => 'required',
            'status' => 'required',
            'thumbnail' => 'required|mimes:jpeg,jpg,png,gif'
        ])->validate();


        if ($request->hasfile('thumbnail')) {
            $image = $request->file('thumbnail');
            $rand = mt_rand(100000, 999999);
            $name = time() . "_"  . $rand . "." . $image->getClientOriginalExtension();
            $image->move(public_path() . '/video_thumbnails/', $name);
        }

        $video = new YoutubeVideo($request->except(['_token','thumbnail']));
        $video->thumbnail = $name;
        $video->save();
        return redirect()->route('videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function show(YoutubeVideo $youtubeVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $youtubeVideo = YoutubeVideo::findOrFail($id);
        return view("blogetc_admin::videos.edit", compact('youtubeVideo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'url' => 'required',
            'status' => 'required',
            'thumbnail' => 'nullable|mimes:jpeg,jpg,png,gif'
        ])->validate();

        $youtubeVideo = YoutubeVideo::findOrFail($id);

        $youtubeVideo->fill($request->except(['_token','thumbnail']));


        if ($request->hasfile('thumbnail')) {
            $image = $request->file('thumbnail');
            $rand = mt_rand(100000, 999999);
            $name = time() . "_"  . $rand . "." . $image->getClientOriginalExtension();
            $image->move(public_path() . '/video_thumbnails/', $name);
            $youtubeVideo->thumbnail = $name;
        }
        $youtubeVideo->save();
        return redirect()->back()->withMessage('Video Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $youtubeVideo = YoutubeVideo::findOrFail($id);
        $youtubeVideo->delete();
        return redirect()->route('videos.index');
    }
}
