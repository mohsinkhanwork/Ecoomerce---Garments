<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.meta',[
        'meta_title'=>'thankyou Urban Enigma | General, Shipping & Return',
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
fbq('track', 'Purchase', {value: 0.00, currency: 'USD'});
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=970630876776102&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body id="cart" oncontextmenu="return false;">

<div id="preloader" style="display: none"></div>

<!-- Cart Container -->
<div class="cart-container">

    <!-- Header BG -->

    <!-- Header -->
    <header>

        <!-- Logo -->
        <div class="logo-container">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{ asset('frontend/assets/images/enigma-logo.png') }}" alt="#"/>
            </a>
        </div>
        <!-- Logo CLOSE-->

        <!-- Navigation -->
        @include('frontend.partials.navigation')
        <!-- Navigation CLOSE -->

    </header>
    <!-- Header CLOSE -->

    <!-- Cart Content -->
    <div class="cart-main wow fadeInDown" data-wow-duration="2s" data-wow-delay="0.3s" data-wow-offset="200" style="visibility: visible; animation-duration: 2s; animation-delay: 0.3s; animation-name: fadeInDown;">

        @if (session('status'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ session('status') }}</strong>
        </span>
        @endif

        <div class="cart-body">

            <div style="text-align: center; margin-top: 40px;">
                <h1 style="color: #4c4a45">Thank you for shopping with Urban Enigma!</h1>
                <h2 style="color: #4c4a45; font-size: 20px; margin-top: 20px;">Your order detail has been sent to your email.</h2>
                <br />
                <a href="{{ url('/') }}" class="btn btn-warning btn-lg">Home</a>
            </div>

        </div>
        <!-- Cart Body CLOSE -->

    </div>

    <div class="cart-footer"></div>

    <!-- Cart Content CLOSE -->

</div>
<!-- Cart Container CLOSE -->

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

<div class="copyright thankyou">
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

<!-- start Cart Function -->
@include('frontend.partials.cart')
<!-- End Cart Function -->

@include('frontend.partials.msg-modal')
{{-- Re-generate the files if any change made in any JS file by visiting this URL: BASE_URL/minify/save --}}
@include('frontend.partials.script')
</body>
</html>
