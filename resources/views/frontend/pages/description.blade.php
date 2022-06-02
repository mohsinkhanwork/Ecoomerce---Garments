<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('frontend.partials.meta',[
        'meta_title'=>$product->meta_title??$product->product_name,
        'meta_description'=>$product->meta_description,
        'meta_img'=> (count($description_slider))?url('img/products/drop/'.$description_slider->first()->filename):asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>$product->meta_keywords,
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
<body id="description" oncontextmenu="return false;">

<div id="preloader" style="display: none"></div>

<!-- Description Container -->
<div class="description-container">

    <!-- Header BG -->

    <!-- Header -->
    <header>

        <!-- Logo -->
        <div class="logo-container">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{ asset('frontend/assets/images/enigma-logo.png') }}" alt="#"/>
                {{-- <img class="logo visible-xs" src="{{ asset('frontend/assets/images/enigma-logo-mobile.png') }}" alt="#"/> --}}
            </a>
        </div>
        <!-- Logo CLOSE-->

        <button class="c-hamburger c-hamburger--htla top burger-menu-top">
            <span>toggle menu</span>
        </button>

        <!-- Navigation -->
        @include('frontend.partials.navigation')
        <!-- Navigation CLOSE -->

    </header>
    <!-- Header CLOSE -->

    <!-- Description Content -->
    <div class="description-main">

        <div class="row">

            {{--@dd($description_slider)--}}
                {{--@foreach($colors_images as $color_image)--}}
                {{--<div class="col-lg-6 col-md-6 col-sm-6 description-img @if(!$loop->first) description-slider-hidden @endif description-slider-{{ $color_image->id }}">--}}
                    <div class="col-lg-6 col-md-6 col-sm-6 description-img">

                    @foreach($description_slider as $slider_image)
                        <img src="{{ '/img/products/drop/'.$slider_image->filename }}" class="slide-image" data-scroll1="{{ $slider_image->slider_scroll_1 }}" alt="{{ $slider_image->alt_text }}"/>
                    @endforeach

                    {{--<img src="{{ asset('frontend/assets/images/desc-img-2.png') }}" alt="#"/>
                    <img src="{{ asset('frontend/assets/images/desc-img-3.png') }}" alt="#"/>--}}

                </div>
                {{--@endforeach--}}

            <div class="description-mobile-arrows">
                <!--<div class="desc-arrow-inner">
                    <a class="desc-arrow-left" href="javascript:;">
                        <img src="images/desc-arrow-left-mobile.png" />
                    </a>
                    <a class="desc-arrow-right" href="javascript:;">
                        <img src="images/desc-arrow-right-mobile.png" />
                    </a>
                </div>-->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 description-content">

                <h2 class="visible-xs">{{ $product->product_name }}</h2>
                <h1 class="wow fadeInRight hidden-xs" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="200" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">{{ $product->product_name }}</h1>

                <div class="visible-xs">
                    <p>
					{!! nl2br($product->description) !!}
                    </p>
                </div>
                <div class="description-item wow fadeInRight hidden-xs" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="200" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInRight;">
                    <p>
                        {!! nl2br($product->description) !!}
                    </p>
                </div>

                <div class="color-container">
                    <div class="color">

                        @foreach($products_prices as $prices)
                            <span>@if($prices->min_price == $prices->max_price) @money($prices->min_price) @else @money($prices->min_price) - @money($prices->max_price) @endif</span>
                        @endforeach

                        {{--{{request()->route('pid')}}--}}
                        @foreach($colors_images as $color_image)
                            {{--@dd($color_image)--}}
                            {{--<a href="javascript:;" class="description-color-btn" data-cid="{{ $color_image->id }}">--}}
                                <div class="color-circle" style="background-color: {{ $color_image->color_code }}; border: 1px solid black;"></div>
                            {{--</a>--}}
                        @endforeach

                    </div>
                </div>

                <div class="description-options-inner">

                    <!--<div class="description-arrows">
                        <a href="javascript:;">
                            <img src="images/desc-arrow-left.png" />
                        </a>
                        <img src="images/desc-arrow-circle.png" />
                        <a href="javascript:;">
                            <img src="images/desc-arrow-right.png" />
                        </a>
                    </div>-->

                    <div class="description-options">

                        <form id="add-to-cart-form" method="post" action="{{ url('/add-cart') }}">

                        <input type="hidden" name="product_id" value="{{ request()->route('pid') }}"/>

                        <div class="quick-selection">
                            <h3>Color</h3>
                            <div class="quick-border">
                                <select name="description-color-attribute-color-id" id="description-color-dropdown" required>
                                    <option value="">--Color--</option>
                                    @foreach($product_colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="quick-selection disabled">
                            <h3>Size</h3>
                            <div class="quick-border">
                                <select name="description-size-attribute-id" id="description-size-dropdown" required disabled>
                                    <option value="">--Select Size--</option>
                                </select>
                            </div>
                        </div>

                        <div class="quick-selection disabled">
                            <h3>Quantity</h3>
                            <div class="quick-border">
                                <input type="hidden" id="attribute-id"/>
                                <select name="description-quantity" id="description-quantity-dropdown" required disabled>
                                    <option value="">--Quantity--</option>
                                </select>
                            </div>
                        </div>

                        <div class="quick-selection disabled">
                            <h3>Total</h3>
                            <div class="quick-border">
                                <input type="hidden" name="description-color-image" id="description-color-image"/>
                                <input type="hidden" name="description-color-image-alt" id="description-color-image-alt"/>
                                <input type="hidden" name="description-price" id="description-total-price"/>
                                <input type="text" id="description-qty-price" placeholder="Price" readonly required disabled />
                            </div>
                        </div>

                        <span class="loader" style="visibility: hidden"><i class="fa fa-spinner fa-3x fa-spin"></i></span>

                        <div class="button-bg quick-add-to-cart hvr-bounce-out" id="btn-add-to-cart-description">
                            <input type="submit" value="ADD TO CART" />
                        </div>

                        </form>

                    </div>

                </div>

                <div class="description-tab">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#desc-tab1" class="desc-tab1-anchor">Size Chart</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#desc-tab2" class="desc-tab2-anchor">Materials / Care Instruction</a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div id="desc-tab1" class="tab-pane fade in active">
                            @php
                                $desktopImageName = $mobileImageName = '';
                                if( !empty( $description_sizechart_material[0]->size_chart_image ) ) {
                                    $size_chart_images = @unserialize($description_sizechart_material[0]->size_chart_image);
                                    if( $size_chart_images !== false && is_array( $size_chart_images  ) ) {
                                        $desktopImageName = isset( $size_chart_images['desktop'] ) && !empty( $size_chart_images['desktop'] ) ? $size_chart_images['desktop'] : '';
                                        $mobileImageName = isset( $size_chart_images['mobile'] ) && !empty( $size_chart_images['mobile'] ) ? $size_chart_images['mobile'] : '';
                                    }
                                }
                            @endphp
                            @if( $desktopImageName )
                                <img src="{{ '/img/products/drop/'.$desktopImageName }}" class="{{ ( $mobileImageName ? 'hidden-xs' : '' ) }}" style="width: 100%" alt="#"/>
                            @endif
                            @if( $mobileImageName )
                                <img src="{{ '/img/products/drop/'.$mobileImageName }}" class="{{ ( $desktopImageName ? 'visible-xs' : '' ) }}" style="width: 100%" alt="#"/>
                            @endif
                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
                            @if( !$desktopImageName && !$mobileImageName )
                                <p>No size chart is available</p>
                            @endif
                        </div>

                        <div id="desc-tab2" class="tab-pane fade">
                            {{--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}
                            @if(!empty($description_sizechart_material[0]->material_care_instruction))
                                <p>{!! nl2br($description_sizechart_material[0]->material_care_instruction) !!}</p>
                            @else
                                <p>No materials / care instruction is available</p>
                            @endif
                        </div>

                    </div>

                </div>

                <div class="copyright description visible-xs">
                    <p class="text-center text-md-left">Copyright &copy; {{ date('Y') }} Urban Enigma. All rights reserved.</p>
                </div>

            </div>

        </div>

    </div>

    <!-- Description Content CLOSE -->

</div>
<!-- Description Container CLOSE -->

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

<!-- Start Add To Cart Function -->
<div class="popup-bg"></div>
<div class="fixed-popup">
    <div class="col-md-12 col-xs-12 pop-up-cat description-page">
        <div class="row">
            <div class="close-popup">
                x
            </div>
            <div class="col-md-6 col-xs-6 img-incart">
                <h4 class="added-success-word">
                    Added to cart successfully!
                </h4>
                <div id="category-add-cart-popup" class="item-succcess">

                </div>
                <div class="incart-item-title">
                    <h4 id="category-add-cart-popup-product-name"></h4>
                </div>
                <div class="incart-item-qty">
                    <h4>Quantity:<span id="category-add-cart-popup-quantity"> 1</span></h4>
                </div>
                <div class="incart-item-total">
                    <h4>TOTAL PRICE:<span id="category-add-cart-popup-total-price"></span></h4>
                </div>
            </div>

            <div class="col-md-6 col-xs-6 mobile-remove-padd">
                <div class="allincart-items">
                    <h4>
                        There are <span id="category-add-cart-popup-total-items"></span> Items in your cart
                    </h4>
                </div>
                <div class="incartsub-total">
                    <h2>SUBTOTAL: <span id="category-add-cart-popup-subtotal-price"></span></h2>
                </div>
                <hr>
                <div class="continueshopping-incart">
                    {{--<a href="javascript:location.reload();">--}}
                    <a href="javascript:void(0);">
                        <img src="{{ asset('frontend/assets/images/continue-shopping.png') }}" alt="continue">
                    </a>
                </div>
                <div class="view-cart-incart">
                    <a href="{{ url('/cart') }}">
                        <img src="{{ asset('frontend/assets/images/view-cart.png') }}" alt="view-cart">
                    </a>
                </div>
                <div class="check-out-shipping-incart hvr-forward">
                    <a href="{{ route('checkout') }}">
                        <img src="{{ asset('frontend/assets/images/check-out-shipping.png') }}" alt="checkout">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Re-generate the files if any change made in any JS file by visiting this URL: BASE_URL/minify/save --}}
@include('frontend.partials.script')
<script>
@if($selected_color_id != '')
$('#description-color-dropdown')
    .val('{{ $selected_color_id }}')
    .trigger('change');
@endif
</script>
</body>
</html>
