<!DOCTYPE html>
<html lang="en">
<head>

    @include('frontend.partials.meta',[
        'meta_title'=>'Stand Out, Be Different | T-shirts, Face Mask & Caps | Urban Engima',
        'meta_description'=>'Urban Enigma is a brand that embraces cultural diversity & urban lifestyle. Stand out, be different with our range of fashionable face masks, caps, & t-shirts. Shop Now',
        'meta_img'=> asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>'T-shirts, Hats, hoodies, shop, personality',
        ])
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '970630876776102');
        fbq('track', 'PageView');
        fbq('track', 'ViewContent');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=970630876776102&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->

    @include('frontend.enternal_style')
</head>

<body id="homepage" oncontextmenu="return true;">

<div id="preloader" style="display: none"></div>

<!-- Header BG -->
<div class="header-bg"></div>
<div class="header-bg-mobile"></div>
<!-- Header -->
<header>

    <!-- Logo -->
    <a href="{{ url('/') }}">
        <div class="logo-container">
            <img class="logo" src="{{ asset('frontend/assets/images/logo.png') }}" alt="Logo" />
            <img class="logo-mobile" src="{{ asset('frontend/assets/images/enigma-logo-mobile.png') }}" alt="Logo"/>
        </div>
    </a>
    <!-- Logo CLOSE-->

    <button class="c-hamburger c-hamburger--htla top burger-menu-top">
        <span>toggle menu</span>
    </button>

    <!-- Navigation -->
    @include('frontend.partials.navigation')
    <!-- Navigation CLOSE -->

</header>
<!-- Floating Cart Container -->
<div class="floating-cart-container">
    <div class="container-main product-section clearfix">
        <div style="margin-bottom:50px;color:white">
            <h1 style="margin-top:50px;margin-bottom:50px">{{$page->title}}</h1>
            @php
                echo $page->description;
            @endphp
        </div>
    </div>
</div>
@include("frontend.partials.footer_new")
</body>
</html>
