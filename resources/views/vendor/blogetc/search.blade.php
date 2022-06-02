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
                        <h2>Search Results for {{$query}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($search_results as $result)
                <?php $post = $result->indexable; ?>
                @if($post && is_a($post,\WebDevEtc\BlogEtc\Models\BlogEtcPost::class))
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="technology-post mb-40">
                        <div class="technology-wrapper">
                            <div class="properties-img">
                                <?=$post->image_tag("medium", true, ''); ?>
                            </div>
                            <div class="properties-caption">
                                <h3><a href="{{$post->url()}}">{{$post->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @empty
                <p class="text-center">Sorry, but there were no results!</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Technology Area End -->
</main>
@endsection