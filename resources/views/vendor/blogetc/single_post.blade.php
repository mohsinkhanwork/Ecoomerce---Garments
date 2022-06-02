@extends("blogetc::layouts.main",['title'=>$post->gen_seo_title(),'meta_description'=>$meta_description,'seo_img' => $post->image_url('large') ])
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
    <!-- Post Details Stat -->
    <div class="psot-details pb-80 pt-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="about-details-cap">
                        <h1 class="single_post_title">{{ $post->title }}</h1>
                        <h3>{{ $post->subtitle }}</h3>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="details-img mb-40">
                        <?=$post->image_tag("large", false, 'img-fluid'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-10">
                    <div class="about-details-cap">
                        {!! $post->post_body_output() !!}
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="post_share">
                        <div class="social-iocn pt-20 pb-20">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $post->url() }}" class="m-2" title="Share on Facbook"><i class="fab fa-facebook"></i></a>
                            <a target="_blank" href="http://twitter.com/share?text={{ $post->title }}&url={{ $post->url() }}" class="m-2" title="Share on Twitter"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="https://pinterest.com/pin/create/link/?url={{ $post->url() }}&media={{ $post->image_url('large') }}&description={{ $post->title }}" class="m-2" title="Share on Pinterest"><i class="fab fa-pinterest"></i></a>
                            <a target="_blank" href="https://api.whatsapp.com/send?text={{ $post->url() }}" data-action="share/whatsapp/share" class="m-2" title="Share on Whatsapp"><i class="fab fa-whatsapp"></i></a>
                            <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url={{ $post->url() }}&title={{ $post->title }}&source={{ route('blogetc.index') }}" class="m-2" title="Share on Linkedin"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Post Details End -->
   
    </main>
@endsection