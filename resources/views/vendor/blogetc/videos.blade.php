@extends("blogetc::layouts.main",['title'=>$title,'meta_description'=>$meta_description])
@section("content")
<main>
    <!-- breadcrumb Start-->
    <div class="page-notification">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <button id="back_btn_page" class="back_btn_page" onclick="window.history.back();"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->
    <!-- Technology Area 02 Start -->
    <section class="technology-area mb-10 content_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle section-tittle3 mb-30 text-center">
                        <h2>Videos</h2>
                    </div>
                </div>
            </div>
            @if(count($videos))
            <div class="row">
                @foreach($videos as $video)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a class="videos_popup video_link" data-lightbox="gallery" data-image-alt="{{ $video->name }}" href="{{ $video->url }}">
                        <span class="yt_play"><i class="fab fa-youtube" aria-hidden="true"></i></span>
                    <img src="{{ $video->image_url() }}" title="{{ $video->name }}" class="w-100">
                    </a>
                    <h4 class="text-center mt-2">{{ $video->name }}</h4>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    <!-- Technology Area End -->
    <!--Pagination Start  -->
    <div class="pagination-area text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $videos->links('blogetc::partials.pagination') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Pagination End  -->
</main>
@endsection