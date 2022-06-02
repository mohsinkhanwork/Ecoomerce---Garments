<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<link rel="apple-touch-icon" sizes="57x57" href="{{ url('favicons/apple-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ url('favicons/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ url('favicons/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ url('favicons/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ url('favicons/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ url('favicons/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ url('favicons/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ url('favicons/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ url('favicons/apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ url('favicons/android-icon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ url('favicons/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicons/favicon-16x16.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ url('favicons/android-icon-192x192.png') }}">
<link rel="manifest" href="{{ url('favicons/manifest.json') }}">
<meta name="msapplication-TileColor" content="#ba6a20">
<meta name="msapplication-TileImage" content="{{ url('favicons/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#ba6a20">

@php
$description = "Urban Enigma is a Brand known for its unique clothing & accessories to stand out from crowd, show the world that you are different, that you are an Enigma";

if(isset($meta_description) && $meta_description != ''){
  $description = $meta_description;
}

$tags = "T-shirts, Hats, hoodies, unique clothing, accessories";
if(isset($meta_tags) && $meta_tags != ''){
  $tags = $meta_tags;
}


@endphp
<title>{{$title}} – Urban Enigma</title>
<meta charset="UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="title" content="{{$title}} – Urban Enigma">
<meta name="description" content="{{$description}}">
<meta name="keywords" content="{{ $tags }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->full() }}">
<meta property="og:title" content="{{$title}} – Urban Enigma">
<meta property="og:description" content="{{$description}}">
<meta property="og:image" content="{{ $seo_img??url('favicons/android-icon-192x192.png') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->full() }}">
<meta property="twitter:title" content="{{$title}} – Urban Enigma">
<meta property="twitter:description" content="{{$description}}">
<meta property="twitter:image" content="{{ $seo_img??url('favicons/android-icon-192x192.png') }}">
    

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ url('blog/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/lightbox-js/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ url('blog/assets/css/style.css') }}">
    
</head>
<body>
    <header>
     <div class="header-area">
        <div class="main-header ">
            <div class="header-top d-lg-block d-none">
             <div class="container-fluid">
              <div class="row">
                <div class="col-xl-12">
                    <div class="d-flex justify-content-lg-between align-items-center justify-content-sm-end justify-content-center">
                        <div class="header-info-mid">
                            <!-- logo -->
                            <div class="logo">
                                <a href="{{route('index')}}"><img class="blog-logo-img" src="{{ url('blog/assets/img/logo/logo.png') }}" alt=""></a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom  header-sticky">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="d-flex align-items-center justify-content-between d-lg-none d-xl-none align-items-stretch">
                <button class="navbar-toggler " type="button">
                <span class="navbar-toggler-icon"></span>
                </button>
                <!-- logo 2 -->
                <div class="logo2">
                    <a href="{{route('index')}}"><img class="mobile_logo" src="{{ url('blog/assets/img/logo/logo.png') }}" alt=""></a>
                </div>
                <div class="sticky_search">
                    <form id="header_search_form_nobile" class="search-form" method='get' action='{{route("blogetc.search")}}'>
                        <i class="ti-search" id="header_search_btn_mobile"></i>
                        <input required autocomplete="off" type='text' name='s' placeholder='Blog Search' id="search_input_mobile" class='form-control' value='{{\Request::get("s")}}' title="Search here">
                    </form>
                </div>
                <div class="sticky_shop">
                    <a class="shop_btn_header text-uppercase" href="{{ route('collection') }}">Shop</a>
                </div>
                <div class="mobile_search">
                    <i class="ti-search"></i>
                </div>

            </div>
            <div class="col-xl-12 nav_wrapper">
                <div class="bottom-wrap d-flex justify-content-between align-items-center">
                    
                    <!-- Main-menu -->
                    <div class="main-menu d-lg-block d-none" id="navbarContent">
                        <nav>                                                
                            <ul id="navigation">
                                @foreach($blog_menu_categories as $category)     
                                <li><a href="{{$category->url()}}">{{$category->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <div class="d-flex search_wrapper">
                    <!-- Search box -->
                    <form id="header_search_form" class="search-form d-none d-lg-block" method='get' action='{{route("blogetc.search")}}'>
                        <i class="ti-search" id="header_search_btn"></i>
                        <input required autocomplete="off" type='text' name='s' placeholder='Search...' id="search_input" class='form-control' value='{{\Request::get("s")}}' title="Search here">
                    </form>
                    <a class="shop_btn_header text-uppercase d-none d-lg-block" href="{{ route('collection') }}">Shop Urban Enigma</a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<form id="header_subscribe_form" class="d-lg-none d-xl-none" method="post" action="{{ route('user.subscribe') }}">
<div class="d-flex bd-highlight">
    @csrf
    <input class="header_su_input flex-grow-2 bd-highlight" autocomplete="off" required type="email" name="email" placeholder="Enter your mail">
  <button type="submit" class="header_su_btn bd-highlight" >Subscribe</button>
</div>
@if(Session::has('message') || Session::has('error'))
<div class="pera text-center p-1 bg-white">
    @if(Session::has('error'))<small class="text-danger">{{ Session::get('error') }}</small> @endif
    @if(Session::has('message'))<small class="text-success">{{ Session::get('message') }}</small> @endif
</div>
@endif

</form>	
</div>
</div>
</header>
@yield('content')
<footer>
    <div class="footer-wrapper">
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-caption">
                            <div class="footer-tittle">
                                <div class="mb-2">
                                <a class="shop_btn_footer text-uppercase " href="{{ route('collection') }}">Shop Urban Enigma</a>
                                </div>
                                <ul>
                                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 footer_cat">
                        <div class="single-footer-caption">
                            <div class="footer-tittle">
                                <h4><span>Blog Categories</span></h4>
                                <ul>
                                    @foreach($blog_menu_categories as $category)     
                                    <li><a href="{{$category->url()}}">{{$category->category_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="single-footer-caption">
                            <div class="footer-tittle">
                                <h4><span>About</span></h4>
                                <p>
                                Urban Enigma didn’t just happen. I've always been a person that is not easily understood, so I wanted to design unique clothing that fits my personality and hopefully yours. The Urban Enigma brand had to grab your curiosity at first glance. It’s like that feeling you get when you see something that stops you in your tracks, something totally different and unexpected that you had to check it out. Imagine the first time you saw a person playing music in the park, a skater doing the wildest trick you’ve ever seen, a street performer expressing their passion to the world or the first time you visited a new city and were amazed by the flashing lights. That’s the impact I wanted my clothing brand to have. I started by selecting the best materials and blending them seamlessly with my creative flare. The clothes took on a life of their own and Urban-Enigma was born.
                                </p>
                                <p>
                                Urban Enigma is a brand that embraces the cultural diversity and the stand out and be different personality of the urban lifestyle. My belief is that we all have a mystery or complexity to us and when others are curious enough they’ll take the time to marvel at what makes us unique. So Stand out, be different, by just being yourself, an Enigma.
                                </p>
                            </div>
                            <div class="header-social">
                            <a href="https://www.facebook.com/UrbanEnigma/" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/urbanenigma_apparel/" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/UrbanEnigmaTalk" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.youtube.com/channel/UCe8KnRlO54DnvkKp-VxXAkA" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.pinterest.com/urbanenigma_apparel/" target="_blank"><i class="fab fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Urban Enigma</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Scroll Up -->
<div id="back-top" class="">
    <a title="Go to Top" href="#" class=""> <i class="ti-angle-double-up scroll-animate"></i></a>
</div>

<!-- JS here -->
<!-- Jquery, Popper, Bootstrap -->
<script src="{{ url('blog/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ url('blog/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ url('blog/assets/js/popper.min.js') }}"></script>
<script src="{{ url('blog/assets/js/bootstrap.min.js') }}"></script>

<!-- Slick , Owl-Carousel , Mobile Menu-->
<script src="{{ url('blog/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('blog/assets/js/slick.min.js') }}"></script>
<script src="{{ url('blog/assets/js/jquery.slicknav.min.js') }}"></script>

<!-- wow, popup, Nice-select  -->
<script src="{{ url('blog/assets/js/wow.min.js') }}"></script>
<script src="{{ url('blog/assets/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ url('blog/assets/js/jquery.nice-select.min.js') }}"></script>

<!-- contact js -->
<script src="{{ url('blog/assets/js/contact.js') }}"></script>
<script src="{{ url('blog/assets/js/jquery.form.js') }}"></script>
<script src="{{ url('blog/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ url('blog/assets/js/mail-script.js') }}"></script>
<script src="{{ url('blog/assets/js/jquery.ajaxchimp.min.js') }}"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="{{ url('blog/assets/js/plugins.js') }}"></script>
<script src="{{ url('blog/assets/js/main.js') }}"></script>

<script src="{{ url('vendor/lightbox-js/lightbox.min.js') }}"></script>
</body>
</html>