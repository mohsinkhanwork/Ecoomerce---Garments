<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.meta',[
        'meta_title'=>'Contact Urban Engima | Unique Online Clothing Store',
        'meta_description'=>"Urban-Enigma is a unique online clothing store offering stylish T-Shirts, Caps & Face masks inspired by cultural diversity & be a different personality. Contact us to learn more.",
        'meta_img'=> asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>'Contact Urban Engima | Unique Online Clothing Store',
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
fbq('track', 'Contact');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=970630876776102&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body id="contact" oncontextmenu="return false;">

<div id="preloader" style="display: none"></div>

<!-- Contact Container -->
<div class="contact-container">


    <!-- Header BG -->
    <div class="header-contact-bg-mobile"></div>

    <!-- Header -->
    <header>

        <!-- Logo -->
        <div class="logo-container">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{ asset('frontend/assets/images/logo.png') }}" alt="#"/>
                <img class="logo-mobile" src="{{ asset('frontend/assets/images/enigma-logo-mobile.png') }}" alt="#"/>
            </a>
        </div>
        <!-- Logo CLOSE-->

        <button class="c-hamburger c-hamburger--htla top burger-menu-top">
            <span>toggle menu</span>
        </button>

        <!-- Navigation -->
        @include('frontend.partials.navigation')
        <!-- Navigation CLOSE -->

        <div class="nav-border"></div>

    </header>
    <!-- Header CLOSE -->

    <!-- Contact Content -->
    <h1 class="display-none">Contact Urban Engima | Unique Online Clothing Store</h1>
    <div class="contact-main">

        <div class="clearfix">

            <div class="contact-telephone contact-inner hvr-buzz-out">
                <a href="tel:+<?= str_replace(['-',' '],'',$phone) ?>" class="phone-number">203-881-6233</a>
                <img src="{{ asset('frontend/assets/images/dialer-phone new number 8-26-2020.png') }}" alt="#"/>
            </div>

            <div class="contact-form-container contact-inner wow bounceInUp hidden-xs" data-wow-duration="2s" data-wow-delay="0.8s" data-wow-offset="160" style="visibility: visible; animation-duration: 2s; animation-delay: 0.8s; animation-name: bounceInUp;">

                <div class="contact-envelope">
                    <img src="{{ asset('frontend/assets/images/contact-envelope.png') }}" alt="#"/>
                </div>

                <form class="contact-form-submittable" id="contact-form" method="post">
                @csrf

                <h2 class="email">E-MAIL</h2>

                <textarea name="message" placeholder="your message goes here..." required></textarea>

                <img class="contact-form-border" src="{{ asset('frontend/assets/images/contact-form-border.png') }}" alt="#"/>

                <div class="clearfix">

                    <div class="contact-form">

                        <div class="contact-input-bg">
                            <input type="text" name="subject" placeholder="subject mail..." required>
                        </div>

                        <div class="contact-input-bg">
                            <input type="email" name="subject_email" placeholder="your email..." required>
                        </div>

                    </div>

                    <div class="contact-submit-container">

                        <div class="contact-submit">

                            <input type="submit" value="SUBMIT">
                            <a href="#">cancel</a>

                        </div>

                    </div>

                </div>

                <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>

                </form>

            </div>
            <div class="contact-form-container contact-inner wow bounceInUp visible-xs" data-wow-duration="0.5s" data-wow-delay="0.2s" data-wow-offset="160" style="visibility: hidden; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: bounceInUp;">

                <div class="contact-envelope">
                    <img src="{{ asset('frontend/assets/images/contact-envelope.png') }}" alt="#"/>
                </div>

                <form class="contact-form-submittable" method="post">
                @csrf

                <h2 class="email">E-MAIL</h2>

                <textarea name="message" placeholder="your message goes here..." required></textarea>

                <img class="contact-form-border" src="{{ asset('frontend/assets/images/contact-form-border.png') }}" alt="#"/>

                <div class="clearfix">

                    <div class="contact-form">

                        <div class="contact-input-bg">
                            <input type="text" name="subject" placeholder="subject mail..." required>
                        </div>

                        <div class="contact-input-bg">
                            <input type="email" name="subject_email" placeholder="your email..." required>
                        </div>

                    </div>

                    <div class="contact-submit-container">

                        <div class="contact-submit">

                            <input type="submit" value="SUBMIT">
                            <a href="#">cancel</a>

                        </div>

                    </div>

                </div>

                <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>

                </form>

            </div>

            <div class="thanks wow bounceIn" data-wow-duration="2s" data-wow-delay="0.8s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.8s; animation-name: bounceIn;">
                <img src="{{ asset('frontend/assets/images/thank-u.png') }}" alt="thank-you">
            </div>

        </div>

    </div>

    <!-- Contact Content CLOSE -->

</div>
<!-- Contact Container CLOSE -->

<!--<div class="contact-buildings"></div>
<div class="contact-puzzle"></div>-->

<!-- Footer Inner Page-->
<div class="footer-inner-page contact-footer">
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

<div class="copyright contact">
    <p class="text-center text-md-left">Copyright &copy; {{ date('Y') }} Urban Enigma. All rights reserved.</p>
</div>
{{-- Re-generate the files if any change made in any JS file by visiting this URL: BASE_URL/minify/save --}}
@include('frontend.partials.script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
