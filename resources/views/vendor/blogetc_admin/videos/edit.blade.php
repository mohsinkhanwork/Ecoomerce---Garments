@extends("blogetc_admin::layouts.admin_layout")
@section("content")

@if(Session::has('message'))
<div class="alert alert-success">
    {{ Session::get('message') }}
</div>

@endif
    <h5>Edit Video</h5>
    <form method='post' action='{{route("videos.update",$youtubeVideo->id)}}'  enctype="multipart/form-data" >

        @csrf
        @method("patch")
        @include("blogetc_admin::videos.form", ['youtubeVideo' => $youtubeVideo])
        <input type='submit' class='btn btn-primary' value='Update video' >

    </form>

@endsection