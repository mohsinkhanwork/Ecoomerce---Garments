<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('frontend.partials.meta',[
        'meta_title'=>'FAQs Urban Enigma | General, Shipping & Return',
        'meta_description'=>"Frequently Asked Questions about Urban Enigma's process, shipping, and returns. If your question is not answered, please feel free to contact us and we will respond as soon as possible.",
        'meta_img'=> asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>'FAQs Urban Enigma | General, Shipping & Return',
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
<body id="faq" oncontextmenu="return false;">

<div id="preloader" style="display: none"></div>

<!-- Header BG -->

<!-- Header -->
<div class="faq-header-container">
    <header>

        <!-- Logo -->
        <div class="logo-container logo-container-faqs">
            <a href="{{ url('/') }}">
                <img class="logo visible-xs" src="{{ asset('frontend/assets/images/faq-newlogo-mobile.png') }}" alt="#"/>
                <img class="logo hidden-xs" src="{{ asset('frontend/assets/images/faq-newlogo.png') }}" alt="#"/>
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
    <div class="second-header">

        <div class="faq-title">
            <img class="faq-title-desktop" src="{{ asset('frontend/assets/images/faq-title.png') }}" alt="#"/>
            <img class="faq-title-mobile" src="{{ asset('frontend/assets/images/faq-title-mobile.png') }}" alt="#"/>
        </div>

        <!-- Start Content Headers -->

        <div class="content-headers">
            <ul class="faqs-tab">
                <a href="#general"><li>GENERAL <span>/</span></li></a>
                <a href="#shipping"><li>SHIPPING <span>/</span></li></a>
                <a href="#purchase"><li>PURCHASE <span>/</span></li></a>
                <a href="#returns"><li>RETURNS</li></a>
            </ul>
        </div>

        <!-- End Content Headers -->
    </div>

</div>
<!-- Header CLOSE -->

<!-- Faq Container -->
<div class="faq-container">

    <!-- Faq Content -->

    <div class="container-main align">
        <h1 class="display-none">FAQs Urban Enigma | General, Shipping & Return</h1>
        <div class="faq-inner" id="general">
            <div class="faq-first-question">
                <img src="{{ asset('frontend/assets/images/Artboard 2 line@2x.png') }}" alt="general" />
            </div>
            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-1"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">When/Where was Urban Enigma founded?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-1 hide-answer"><p>
                            Urban enigma was founded a long time ago in a galaxy far far away on a planet called earth somewhere in a state called Connecticut in the USA. If you would like to learn a little more about the brand, please visit the <span><a class="faq-about-link" href="{{ url('/about') }}">About Us</a></span> page.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-2"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">How do I find out about the latest news and products?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-2 hide-answer"><p>
                            Its easy! Just sign up to receive notifications on discounts and the latest news Urban-Enigma has to offer. We got you.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-3"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Are out-of-stock items restocked?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-3 hide-answer"><p>
                            If an item is out of stock, we will try to restock it as soon as possible.<span class="ans-3-decor"> You can still get it if it’s out of stock too</span>. Just choose the “Buy Back order” button. This shows up when certain sizes or items are out of stock. Items purchased this way may take 4 - 6 weeks of additional time. However, your order will be dispatched as soon as we restock.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-4"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Where can I find size and material details?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-4 hide-answer"><p>
                            Don’t worry we gotcha! Each item has the size details and measurements on their products pages to make sure you are getting the right fit for you everytime.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-5"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Which products can I find at Urban Enigma?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-5 hide-answer"><p>
                            Currently, we’re focused on two specific product types: Shirts and Hats. Keep an eye on our store, because that is sure to change in the future. Be sure to stay tuned and register to receive updates on what’s new at Urban-Enigma.
                            To check out all of our products, please <span><a class="faq-category-link" href="{{ url('/collection') }}">Click Here</a></span>.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-6"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Will I receive the same product that I see in the photo?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-6 hide-answer"><p>
                            Absolutely. We pride ourselves on delivering what our customers want, which is exactly what they see at the time of the order.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-7"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">How do I recover my forgotten password?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-7 hide-answer"><p>
                            You can easily do this by clicking log-in and then selecting “I forgot my password”. We’ll e-mail you a password reset link and it’ll all be fixed super quickly.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel g-8"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Will Urban-Enigma clothing make my job more bearable?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer ga-8 hide-answer"><p>
                            Probably not, but it’s worth a try.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq-inner" id="shipping">
            <div class="faq-first-question">
                <img src="{{ asset('frontend/assets/images/Artboard line@2x.png') }}" alt="shipping" />
            </div>
            <div class="faq-content">
                <div class="faq-question">
                    <span class="shipping-panel sh-1"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Where do you ship?  </h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer sha-1 hide-answer"><p>
                            Get yourself a world map. Close your eyes and point to a random place. If it’s not the ocean, we ship there -- worldwide.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel sh-2"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Do you use real ships?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer sha-2 hide-answer"><p>
                            Good question. Unfortunately the answer is no -- we tend to ship via air. It might not be as glorious as sailing the seven seas, but it does get your clothes to you faster.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel sh-3"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Can I track my order?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer sha-3 hide-answer"><p>
                            Yes, you can see the updated status of your order in real time. To do this, go to our "Track My Order" section of the website.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel sh-4"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">How much does shipment cost?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer sha-4 hide-answer"><p>
                            shipping cost is directly dependent on your location, package weight, shipping method and speed of your order.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel sh-5"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">How long will my order take to arrive?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer sha-5 hide-answer"><p>
                            All of our orders are shipped every Tuesday and Friday and take roughly 3 -5 days for orders in the United States. Additional time for other countries is to be expected and is related to the distance of the destination. For faster shipping choose UPS, who will ensure you get the package as soon as physically possible! In case you’re not in a rush, you can choose to have your order shipped through USPS (United States Postal Service). Customs fees are the responsibility of the customer.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel sh-6"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation-edit">Can the delivery country/region be different from the purchase country/region?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer sha-6 hide-answer"><p>
                            No, it’s not possible for us to accept this. The delivery country/region must always be the same country/region in which the purchase was made. If this causes you any difficulties, we apologize, but there’s nothing we can do about this.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq-inner" id="purchase">
            <div class="faq-first-question">
                <img src="{{ asset('frontend/assets/images/Artboard line_1@2x.png') }}" alt="purchase" />
            </div>
            <div class="faq-content">
                <div class="faq-question">
                    <span class="purchase-panel pu-1"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Is it safe to use my credit card on the website?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer purchase-answer pua-1 hide-answer"><p>
                            Yes, the data is transmitted SSL-encrypted. For payments with Visa and MasterCard only SET transactions (secure electronic transactions) are accepted. After verifying that the card is included in the SET system, the system will contact the card-issuing bank to enable the buyer to authorize the purchase. When the bank confirms the authenticity, the payment will be charged to the card. Otherwise the order will be cancelled.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel pu-2"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">What payment method can I use to make my purchase?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer pua-2 hide-answer"><p>
                            We take the following payment methods: Visa, Visa electron, MasterCard, American Express and PayPal.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel pu-3"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Where can I find my receipt?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer pua-3 hide-answer"><p>
                            Once you have ordered, you will find it attached to the notification e-mails you receive right after ordering.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel pu-4"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">How can I be sure that I've made my purchase correctly?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer pua-4 hide-answer"><p>
                            Once you have placed your order, you will receive a confirmation email. If you do not receive an email, please <span><a class="faq-cotact-link" href="{{ url('/contact') }}">Contact Us</a></span>.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="general-panel pu-5"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Can I remove items from my order?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer general-answer pua-5 hide-answer"><p>
                            Yes, without any problem. You can simply delete any unwanted items from your shopping cart before final purchase.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq-inner" id="returns">
            <div class="faq-first-question">
                <img src="{{ asset('frontend/assets/images/Artboard line_2@2x.png') }}" alt="returns" />
            </div>
            <div class="faq-content">
                <div class="faq-question">
                    <span class="returns-panel re-1"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">Do you provide refunds?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer returns-answer rea-1 hide-answer"><p>
                            Unfortunately, at this moment we’re not able to provide refunds. But that’s not because we’re terrible people! It’s just that we have a limited supply in our new company and to make sure our brand continues to grow stronger to be able to be here for you, right now, we can’t provide refunds… yet!
                            It’s important to mention one thing. With the support we’ve been getting from customers like you, soon we’ll be able to say that we can provide this. We hope you can continue to help us and that we can continue to make you a satisfied customer!</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="returns-panel re-2"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">What should I do if I receive a faulty item?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer returns-answer rea-2 hide-answer"><p>
                            We’re very confident in our product’s quality. We only sell items that are in perfect condition and we inspect each item before packing up and shipping. In the extremely rare event of receiving a faulty item, please <span><a class="faq-cotact-link" href="{{ url('/contact') }}">Contact Us</a></span>.</p>
                    </div>
                </div>
            </div>

            <div class="faq-content">
                <div class="faq-question">
                    <span class="returns-panel re-3"><i class="fa fa-sort-desc fa-2x  rotate" aria-hidden="true"></i></span>
                    <h2 class="questions foundation">What should I do if I receive an incorrect item?</h2>
                </div>
                <div class="answer-container">
                    <div class="faq-answer returns-answer rea-3 hide-answer"><p>
                            This has never happened to us before. However, accidents happen right? If you receive an item that you did not order, please <span><a class="faq-cotact-link" href="{{ url('/contact') }}">Contact Us</a></span>.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Faq Content CLOSE -->

</div>
<!-- Faq Container CLOSE -->

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

<div class="copyright faqs">
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
