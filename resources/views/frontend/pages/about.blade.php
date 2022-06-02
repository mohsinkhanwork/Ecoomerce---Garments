<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.meta',[
        'meta_title'=>'About  Urban Engima | Online Clothing Store Inspired by Cultural Diversity',
        'meta_description'=>"Our clothes embrace the urban lifestyle as a combination of many different cultures and ethnicities. We believe in being unique, not perfect. Stand out, be different by just being yourself an Enigma! Know more.",
        'meta_img'=> asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>'About  Urban Engima | Online Clothing Store Inspired by Cultural Diversity',
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
</head>
<body id="about" oncontextmenu="return false;">

<div id="preloader" style="display: none"></div>

<!-- About Container -->
<div class="about-container">

    <div class="about-header-bg-mobile"></div>

    <!-- Header -->
    <header>

        <!-- Logo -->
        <div class="logo-container">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{ asset('frontend/assets/images/about-logo.png') }}" alt="#"/>
                <img class="logo-mobile" src="{{ asset('frontend/assets/images/about-logo-mobile.png') }}" alt="#"/>
            </a>
        </div>
        <!-- Logo CLOSE-->

        <button class="c-hamburger c-hamburger--htla top burger-menu-top">
            <span>toggle menu</span>
        </button>

        <!-- Navigation -->
        @include('frontend.partials.navigation')
        <!-- Navigation CLOSE -->

        <!-- <div class="nav-border"></div> -->

    </header>
    <!-- Header CLOSE -->

    <!-- About Content -->

    <div class="about-bg-mobile-top"></div>

    <div class="container-main bubble-width-increase wow fadeIn hidden-xs" data-wow-duration="2s" data-wow-delay="2.3s" data-wow-offset="160" style="visibility: visible; animation-duration: 2s; animation-delay: 2.3s; animation-name: fadeIn;">

        <div class="about-bg">

            <div class="about-content">

                <h1 class="display-none">About  Urban Engima | Online Clothing Store Inspired by Cultural Diversity</h1>
                <h1>ABOUT URBAN ENIGMA</h1>

                <p>
                    Urban Enigma didn’t just happen. I've always been a person that is not easily understood,
                    so I wanted to design unique clothing that fits my personality and hopefully yours.
                    The Urban Enigma brand had to grab your curiosity at first glance.
                    It’s like that feeling you get when you see something that stops you in your tracks,
                    something totally different and unexpected that you had to check it out.
                    Imagine the first time you saw a person playing music in the park,
                    a skater doing the wildest trick you’ve ever seen,
                    a street performer expressing their passion to the world or the first time
                    you visited a new city and were amazed by the flashing lights.
                    That’s the impact I wanted my clothing brand to have.
                    I started by selecting the best materials and blending them seamlessly with my creative flare.
                    The clothes took on a life of their own and Urban-Enigma was born.
                </p>

                <p>
                    Urban Enigma is a brand that embraces the cultural diversity and the stand out and be different personality of the urban lifestyle. My belief is that we all have a mystery or complexity to us and when others are curious enough they’ll take the time to marvel at what makes us unique. So Stand out, be different, by just being yourself, an Enigma.
                    {{-- Urban Enigma is a brand that embraces the cultural diversity and the stand out and be different personality of the urban lifestyle.
                    My belief is that we all have a mystery or complexity to us and when others are curious enough they’ll take the time to marvel at what makes us unique.
                    We are all an enigma, so embrace it and let our clothing tell your story. --}}
                </p>
                <p>- Ray Stancil -</p>

            </div>

        </div>

    </div>
    <div class="container-main bubble-width-increase wow fadeIn visible-xs" data-wow-duration="1s" data-wow-delay="1.3s" data-wow-offset="160" style="visibility: hidden; animation-duration: 1s; animation-delay: 1.3s; animation-name: fadeIn;">

        <div class="about-bg">

            <div class="about-content">

                <h2>ABOUT URBAN ENIGMA</h2>

                <p>
                    Urban Enigma didn’t just happen. I've always been a person that is not easily understood,
                    so I wanted to design unique clothing that fits my personality and hopefully yours.
                    The Urban Enigma brand had to grab your curiosity at first glance.
                    It’s like that feeling you get when you see something that stops you in your tracks,
                    something totally different and unexpected that you had to check it out.
                    Imagine the first time you saw a person playing music in the park,
                    a skater doing the wildest trick you’ve ever seen,
                    a street performer expressing their passion to the world or the first time
                    you visited a new city and were amazed by the flashing lights.
                    That’s the impact I wanted my clothing brand to have.
                    I started by selecting the best materials and blending them seamlessly with my creative flare.
                    The clothes took on a life of their own and Urban-Enigma was born.
                </p>

                <p>
                    Urban Enigma is a brand that embraces the cultural diversity and the stand out and be different personality of the urban lifestyle. My belief is that we all have a mystery or complexity to us and when others are curious enough they’ll take the time to marvel at what makes us unique. So Stand out, be different, by just being yourself, an Enigma.
                </p>
                <p>- Ray Stancil -</p>

            </div>

        </div>

    </div>

    <div class="about-bg-mobile-bot">   </div>

    <!-- About Content CLOSE -->

    <div class="puzzle-new hidden-xs">
        <img src="{{ asset('frontend/assets/images/Artboard 13.png') }}" alt="#">
    </div>
    <div class="puzzle-new-mobile visible-xs  wow fadeIn" data-wow-duration="0s" data-wow-delay="0.3s" data-wow-offset="160" style="visibility: hidden; animation-duration: 0s; animation-delay: 0.3s; animation-name: fadeIn;">
        <img src="{{ asset('frontend/assets/images/Artboard 13.png') }}" alt="#">
    </div>

</div>
<!-- About Container CLOSE -->

<img class="get-social-black" src="{{ asset('frontend/assets/images/Get_Social_Black.png') }}" alt="#">

<div class="mobile-social-buttons">
    @include('frontend.partials.social')
</div>

<!-- Footer Inner Page-->
<div class="footer-inner-page">
    <!-- Steps -->
    @include('frontend.partials.steps')
    <!-- Steps CLOSE -->

    <footer>

        <div class="footer-inner">
            @include('frontend.partials.footer')
        </div>

    </footer>
    <!-- Footer CLOSE -->
</div>
<!-- Footer Inner Page CLOSE-->

<div class="copyright about">
    <p class="text-center text-md-left">Copyright &copy; {{ date('Y') }} Urban Enigma. All rights reserved.</p>
</div>
<div id="nav-mobile"></div>

<div class="popup-overlay"></div>

<!-- Register Popup -->
@include('frontend.partials.register')
<!-- Register Popup CLOSE -->

<!-- Search Box Popup -->
<div class="search-box-container">
        <span>
            <a href="javascript:;">x</a>
        </span>
    <input id="searchBox" type="text" placeholder="Search..." />
</div>
<!-- Search Box Popup -->

<!-- start scroll to top -->
<div id="scroll-top" class="hvr-bob scroll-toop blog-top" style="display: none;">
    <i class="fa fa-chevron-up fa-3x"></i>
</div>
<!-- end scroll to top -->

<!-- start Cart Function -->
@include('frontend.partials.cart')
<!-- End Cart Function -->

@include('frontend.partials.msg-modal')
{{-- Re-generate the files if any change made in any JS file by visiting this URL: BASE_URL/minify/save --}}
@include('frontend.partials.script')
</body>
</html>
