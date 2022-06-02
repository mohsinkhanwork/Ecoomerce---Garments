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
    <section class="technology-area mb-10 content_section category_page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle section-tittle3 mb-30 text-center">
                        <h2>{{ $category->category_name  }}</h2>
                    </div>
                </div>
            </div>
            @if(count($posts))
            <div class="row">
                <div class="col-12 category_filter mb-3">
                    <form action="" method="GET">
                    
                    Order By <select name="order_by" onchange="this.form.submit()" id="filter_dropdown">
                        <option value="newest" {{ (isset($_GET['order_by']) && $_GET['order_by'] == 'newest')?'selected':'' }}>Newest Post</option>
                        <option value="oldest" {{ (isset($_GET['order_by']) && $_GET['order_by'] == 'oldest')?'selected':'' }}>Oldest Post</option>
                    </select>
                    </form>
                </div>
                @foreach($posts as $post)
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
                            {{ $posts->links('blogetc::partials.pagination') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Pagination End  -->
</main>
@endsection