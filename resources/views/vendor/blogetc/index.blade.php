@extends("blogetc::layouts.main",['title'=>$title,'meta_description'=>$meta_description])
@section("content")
<main>
    <h1 class="d-none">Urban Engima's blog is about the latest trends & news in clothing fashion, accessories, and everything else related to lifestyle & culture. We provide you with the hottest looks on earth as well as a different thought perspective!</h1>
    <!-- Whats New Start -->
    <section class="whats-news-area mt-20 pb-30">
        <div class="container-fluid">
            <div class="row">
                @if(count($feature_posts))
                <!-- Left Details Caption -->
                <div class="col-xxl-7 col-xl-6 col-lg-6">
                    @foreach($feature_posts as $feature_post)
                    <div class="single-slider  mb-30 mt-20">
                            <div class="trending-top">
                                <div class="fet_title">
                                    <h2 class="text-center"><a href="{{$feature_post->url()}}">{{$feature_post->title}}</a></h2>
                                </div>
                                <div class="trend-top-img">
                                    <?=$feature_post->image_tag("large", true, ''); ?>
                                </div>
                                @if(count($feature_post->categories)) 
                                <div class="trend-top-cap">
                                    <a href="{{$feature_post->categories->first()->url()}}" class="d-inline-block"><span class="cat_link_span">{{$feature_post->categories->first()->category_name}}</span></a>
                                </div>
                                @endif
                                @if($feature_post->short_description)
                                <div class="mb-20 fet_short_descp">
                                    {!! $feature_post->generate_introduction() !!}
                                </div>
                                @endif
                                <div class="fet_share d-flex justify-content-between mb-10">
                                    <div class="post_share">
                                        <div class="social-iocn">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $feature_post->url() }}" class="m-2" title="Share on Facbook"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="https://twitter.com/share?text={{ $feature_post->title }}&url={{ $feature_post->url() }}" class="m-2" title="Share on Twitter"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="https://pinterest.com/pin/create/link/?url={{ $feature_post->url() }}&media={{ $feature_post->image_url('large') }}&description={{ $feature_post->title }}" class="m-2" title="Share on Pinterest"><i class="fab fa-pinterest"></i></a>
                                            <a target="_blank" href="https://api.whatsapp.com/send?text={{ $feature_post->url() }}" data-action="share/whatsapp/share" class="m-2" title="Share on Whatsapp"><i class="fab fa-whatsapp"></i></a>
                                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ $feature_post->url() }}&title={{ $feature_post->title }}&source={{ route('blogetc.index') }}" class="m-2" title="Share on Linkedin"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <a class="fet_read_more" href="{{ $feature_post->url() }}">Read More</a>

                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
                @endif
            @if(count($home_posts))
            <!-- Right single caption -->
            <div class="col-xxl-5 col-xl-6 col-lg-6">
                <div class="row">
                    <div class="col-12 recent_post d-lg-none d-xl-none text-center mb-3">
                    Recent Post
                    </div>
                    @foreach($home_posts as $home_post)
                    <!-- single -->
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-6 home_recent_posts">
                        <div class="whats-right-single mb-20">
                            <div class="whats-right-img">
                                <div class="d-lg-none d-xl-none recent_post_title text-center mb-2">
                                    {{$home_post->title}}
                                </div>
                              <?=$home_post->image_tag("medium", true, ''); ?>
                          </div>
                          <div class="whats-right-cap d-none d-lg-block">
                            @if(count($home_post->categories))<a href="{{$home_post->categories->first()->url()}}"><span class="cat_link_span">{{$home_post->categories->first()->category_name}}</span></a>@endif
                            <h4><a href="{{$home_post->url()}}">{{$home_post->title}}</a></h4>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
            @endif
</div>
</div>
</section>
@if(count($home_categories))
@foreach($home_categories as $home_category)
@if(count($home_category->posts))
<section class="technology-area mb-30 home_category_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle mb-30 d-flex align-items-center justify-content-between">
                    <h2>{{ $home_category->category_name }}</h2>
                    <a href="{{ $home_category->url() }}">See All</a>
                </div>
            </div>
        </div>
        <div class="{{ ($home_category->home_layout == 'slider' && count($home_category->posts) > 4)?'category-slider-home':'row category-grid-home' }}">
            @foreach($home_category->posts as $home_category_post)
            <div class="col-lg-3 col-6 home_category_column">
                @if($home_category->home_layout == 'slider' && count($home_category->posts) > 4)<div class="technology-post technology-post2">@endif
                <div class="technology-post mb-30">
                    <div class="technology-wrapper">
                        
                        
                        <div class="properties-img">
                            <?=$home_category_post->image_tag("medium", true, ''); ?>
                        </div>
                        <div class="properties-caption">
                            <h3><a href="{{$home_category_post->url()}}">{{$home_category_post->title}}</a></h3>
                        </div>

                    </div>
                </div>
                @if($home_category->home_layout == 'slider' && count($home_category->posts) > 4)</div>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endforeach
@endif
@if(count($ig_posts))
<!-- IG Area Start -->
<div class="ig-area mb-20">
    <div class="container">
        
        <!-- Section Tittle -->
            <div class="subcrition-tittle text-center">
                <h2 class="text-capitalize ig_video_text"><span>Urban Enigma Instagram</span></h2>
            </div>
            <div class="line_insta"></div> 
            <div class="row insta_row">
                @foreach($ig_posts as $key => $ig_post)
                <div class="col-4 mt-3 mb-2 insta_div">
                    <a class="ig_link" href="#insta_post_{{ $key+1 }}" data-lightbox="ig_post" target="_blank">
                    <img src="{{ $ig_post['media_url'] }}" title="Insta Feed {{ $key+1 }}" class="w-100">
                    </a>
                    <div id="insta_post_{{ $key+1 }}" hidden >
                        <div class="row ig_post_div">
                            <div class="col-md-6 col-sm-12">
                                @if($ig_post['video_url'])
                                <video controls style='width:100%;'>
                                    <source src="{{ $ig_post['video_url'] }}" type='video/mp4'>
                                    Your browser does not support the video tag.
                                </video>
                                @else
                                <img class="ig_post_img w-100" src="{{ $ig_post['media_url'] }}" title="Insta Feed {{ $key+1 }}" class="w-100">
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-12 ig_post_caption">
                                <p>{!! nl2br($ig_post['caption']) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        <div class="line_insta"></div>
    </div>
</div>
<!-- video Area End -->
@endif
@if(count($videos))
<!-- video Area Start -->
<div class="video-area mb-20">
    <div class="container">
        <!-- Section Tittle -->
            <div class="subcrition-tittle text-center mb-40">
                <h2 class="text-uppercase yt_video_text">YOU'LL WANNA SEE THIS</h2>
                <p class="text-uppercase">WATCH Urban Enigma IN ACTION</p>
            </div> 
                <div class="row">
                    @foreach($videos as $video)
                <div class="col-md-6 col-sm-12">
                    <a class="videos_popup video_link" data-lightbox="gallery" data-image-alt="{{ $video->name }}" href="{{ $video->url }}">
                        <span class="yt_play"><i class="fab fa-youtube" aria-hidden="true"></i></span>
                    <img src="{{ $video->image_url() }}" title="{{ $video->name }}" class="w-100">
                    </a>
                    <h4 class="text-center mt-2">{{ $video->name }}</h4>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a class="btn btn-black" href="{{ route('front.videos.all') }}">View All</a>
            </div>
    </div>
</div>
<!-- video Area End -->
@endif
<!-- Subscribe Area Start -->
<div class="subscribe-area section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-7 col-xl-8 col-lg-9">
                <!-- Section Tittle -->
                <div class="subcrition-tittle text-center mb-40">
                    <h2>Subscribe to the newsletter</h2>
                    <p>Get a weekly digest of our most important stories direct to your inbox.</p>
                </div> 
                <!--Hero form -->
                <form id="user_subscribe_form" method="post" action="{{ route('user.subscribe') }}" class="search-box">
                    @csrf
                    <div class="input-form">
                        <input autocomplete="off" required type="email" name="email" placeholder="Enter your mail">
                    </div>
                    <div class="search-form">
                        <button type="submit" >Subscribe</button>
                    </div>	
                </form>	
                @if(Session::has('message') || Session::has('error'))
                <div class="pera text-center pt-10">
                    @if(Session::has('error'))<p class="text-danger">{{ Session::get('error') }}</p> @endif
                    @if(Session::has('message'))<p class="text-success">{{ Session::get('message') }}</p> @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Subscribe Area End -->
</main>
@endsection