@extends("blogetc_admin::layouts.admin_layout")
@section("content")


    <h5>Admin - Add post</h5>

    <form method='post' action='{{route("videos.store")}}'  enctype="multipart/form-data" >

        @csrf
        @include("blogetc_admin::videos.form", ['youtubeVideo' => new \App\YoutubeVideo()])
        <input type='submit' class='btn btn-primary' value='Add new video' >

    </form>

@endsection