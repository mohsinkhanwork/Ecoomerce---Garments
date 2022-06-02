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
<!-- Header CLOSE -->
<!-- New Arrival Title -->
<div class="container-main title-mob">
    <div class="h1-title margin-h1">
        <img src="{{ asset('frontend/assets/images/h1-new-arrivals.png') }}" class="h1-for-desktop" alt="#"/>
        <img src="{{ asset('frontend/assets/images/title-mob.png') }}" class="h1-for-mobile" alt="#"/>
    </div>
</div>

<!-- Floating Cart Container -->
<div class="floating-cart-container">

    <h1 class="display-none">Stand Out, Be Different - T-shirts, Face Mask & Caps</h1>
    <h2 class="display-none">New Arrivals by Urban Engima</h2>
    <!-- Yellow Cart -->
    {{-- <a href="{{ url('/cart') }}">
        <div class="yellow-cart hvr-wobble-horizontal"></div>
    </a> --}}

    <!-- Product Section -->
    <div class="container-main product-section clearfix">

        {{--@dd(Auth::user())--}}

        @php $j = 1; /*For Slider ID*/ @endphp

        @foreach($collections as $key => $collection)
            {{-- @php
                if( $key > 0 ) continue;
            @endphp --}}


            <!-- New Arrivals -->
            <section class="@if($loop->first) new-arrivals-section @else urban-enigma-section @endif" name="@if($loop->first) neo-link @else heart-link @endif">

                @if($collection->order == 2)
                    <div class="h1-title uncl">
                        <img src="{{ asset('frontend/assets/images/h1-urban-enigma.png') }}" class="h1-for-desktop" alt="#"/>
                        <img src="{{ asset('frontend/assets/images/h1-urban-enigma-mobile.png') }}" class="h1-for-mobile" alt="#"/>
                    </div>
                @endif

                <div class="container-inner">

                    <!-- Title for Mobile -->
                    <div class="neo-text-mobile">
                        <h2>{{ $collection->name }}</h2>
                    </div>

                    <!-- Arrow -->
                    <div class="arrows-mobile">
                        <a class="left" href="#">
                            <img src="{{ asset('frontend/assets/images/arrow-left.png') }}" alt="#"/>
                        </a>
                        <a class="right" href="#">
                            <img src="{{ asset('frontend/assets/images/arrow-right.png') }}" alt="#"/>
                        </a>
                    </div>

                    <div class="size-15">



                        @php
                            $count = $products->where('collection_id', $collection->id)->count();
                            $remaining=$count;
                            $num_of_slider=0;
                            $colCount=0;
                        @endphp

                        @foreach($products->where('collection_id', $collection->id) as $key => $product)
                            @php
                                /* if( $key > 1 ) {
                                    continue;
                                } */
                            if ($colCount==0){
                                echo '<div class="row product-row">';
                                switch ($remaining){
                                    case 1:
                                        $num_of_slider=12;
                                        $colCount=1;
                                        break;

                                    case 2:
                                        $num_of_slider=6;
                                        $colCount=2;
                                        $remaining-=2;
                                        break;

                                    case 3:
                                        if ($count!=6){
                                            $num_of_slider=6;
                                            $colCount=2;
                                            $remaining-=2;
                                        } else {
                                            $num_of_slider=4;
                                            $colCount=3;
                                            $remaining-=3;
                                        }
                                        break;

                                    case 4:
                                        $num_of_slider=isset($_GET['test'])?12:6;
                                        $colCount=2;
                                        $remaining-=2;
                                    break;

                                    default:
                                    $num_of_slider=4;
                                    $colCount=3;
                                    $remaining-=3;
                                }

                            }
                             $colCount--;
                            @endphp

                            <div rem="{{  $remaining }}" class="col-lg-{{ $num_of_slider }} col-md-{{ $num_of_slider }} col-sm-{{ $num_of_slider }} col-xs-12 phone-margine pl-1 pr-1">
                                <div id="first{{ $product->id }}" class="homepage-urbanenigma-slider sliderbox-{{$product->id}}">
                                <div href="{{ 'product/'.$product->alias }}" data-productid="{{$product->id}}" class="overlay-text hidden overlay-text-{{ $num_of_slider }}" data-slider="{{$j}}">
                                        <div class="overlay-text-before"></div>
                                        <div class="overlay-text-inner">
                                            <div class="overlay-text-inner-txt">
                                                <div>{{$product->overlay_button_text}}</div>
                                                <div style="color:white">{{$product->overlay_button_product_text}}</div>
                                            </div>
                                        </div>
                                        <div class="overlay-text-after"></div>
                                    </div>

                                    <!-- Wrapper for slides -->
                                    <div href="{{ 'product/'.$product->alias }}"  class="overlay-box hidden" data-productid="{{$product->id}}" data-slider="{{$j}}"></div>
                                    <div class="slider-inner" href="{{ 'product/'.$product->alias }}"  id="HomeSliderInner{{$j}}" data-sliderid="{{$j}}" role="listbox">
                                        @php $k = 1; @endphp
                                        @foreach($colors_images->where('product_id', $product->id) as $color_image)

                                            <div class="item  @if($loop->first) active @endif small one f-item" data-scroll1="{{!$color_image->slider_scroll_1 ? 7 : $color_image->slider_scroll_1}}" data-scroll2="{{!$color_image->slider_scroll_2 ? 7 : $color_image->slider_scroll_2}}">
                                                <a class="image-anchor" href="{{ 'product/'.$product->alias }}">
                                                    <img src="{{ '/img/products/drop/'.$color_image->filename }}" id="HomeSliderImg{{$j}}{{$k}}" alt="{{ $color_image->alt_text }}" style="max-width: 100%; width: 100%;">
                                                </a>
                                                {{-- <div class="carousel-caption capt-sm">
                                                    <a href="Javascript:;" class="fig">Quick Purchase</a>
                                                    <a class="fig" href="{{ 'product/'.$product->alias }}">Quick Purchase</a>
                                                </div> --}}
                                            </div>
                                            @php $k++; @endphp
                                        @endforeach
                                    </div>
                                    @php

                                        @endphp
                                    <div class="color-container">
                                        <!--                                <div class="color-border"></div>-->
                                        <div class="color color-col-{{ $num_of_slider }}">

                                            <div class="codCleanTopBox codCleanTopBox-{{ $num_of_slider }} clearfix">
                                                <!-- Indicators -->
                                                <div class="elements_ circleBox circleBox-{{$num_of_slider}} @php echo 'img-col-'.$k; if($k > 4) echo ' wide-col '; @endphp">
                                                    <ol class="carousel-indicators carousel-items urbanenigma-slider-indicator carousel-indicators-col-{{ $num_of_slider }}" style="bottom: unset;">
                                                        @php $counter_slide_to = 0 @endphp
                                                        @foreach($colors_images->where('product_id', $product->id) as $color_image)

                                                            <li class="@if($loop->first) active @endif" @if($color_image->Description_Slider_ID == 0 && $color_image->Category_Slider_ID == 0) style="background-color: transparent; border: 2px solid #000;" @else style="background-color: {{ $color_image->color_code }}" @endif data-slideindex="{{ $counter_slide_to }}" data-sliderid="HomeSliderInner{{$j}}"></li>

                                                            @php $counter_slide_to++ @endphp

                                                        @endforeach


                                                    </ol>

                                                </div><!--end of circleBox-->
                                                <div class=" elements_ priceBox priceBox-{{$num_of_slider}}">
                                                    <div class="color-price product-price-col-{{ $num_of_slider }}">

                                                    @foreach($products_prices->where('product_id', $product->id) as $prices)
                                                        <div class="product-inner-price-col-{{ $num_of_slider }}">
                                                        @if($prices->min_price == $prices->max_price) @money($prices->min_price) @else @money($prices->min_price) - @money($prices->max_price) @endif
                                                        </div>
                                                    @endforeach
                                                    </div><!--end of color-price-->

                                                </div><!--end of priceBox-->
                                                <div class="dropDownBox elements_ dropDownBox-{{$num_of_slider}}">
                                                    <a href="javascript:void(0);" class="myDiv" pid="{{$product->id}}"  onclick="toggleDescription('{{$product->id}}')">
                                                        <img src="/img/home_drop_down_button_4.svg" alt="" class="expand-in expand-in-col-{{ $num_of_slider }}" id="expand-in-{{$product->id}}"  />
                                                    </a>
                                                </div><!--end of dropDownBox-->


                                            </div><!--end of clearfix-->







                                        </div>
                                        <div class="titleBox hidden titleBox-{{$num_of_slider}}" data-num="{{ $num_of_slider }}" data-slider="{{$j}}" data-count="{{$colors_images->where('product_id', $product->id)->count()}}">
                                            <h2 class="product_title product-title-col-{{ $num_of_slider }}">
                                                <span id="mobile_product_title_{{ $product->id }}">
                                                    {{$product->home_title}}
                                                </span>
                                            </h2>
                                        </div><!--end of titleBox-->
                                        <div class="product_description_box collapsible-content collapsible-content--all" id="desc-{{$product->id}}">
                                            <div class="collapsible-content__inner">
                                                <div class="text-center">
                                                    <h2>{!! $product->home_title !!}</h2>
                                                </div>
                                                <h3 id="short-description-{{$product->id}}">{!! $product->short_description !!}</h3>
                                            </div>

                                        </div>
                                        <!--                                <div class="color-border"></div>-->

                                    </div>
                                    <!--                            OLD HERE-->
                                </div>


                            </div>
                            @php $j++; //For Slider ID
                    if ($colCount==0){
                        echo '</div>';
                    }
                            @endphp

                        @endforeach

                        <!-- For the bracket in the left side -->
                        <div class="groupings">
                            <div class="bracket" style="display: none;">
                                <div class="bracket-title">{{ $collection->name }}</div>
                                <div class="bracket-left-stick"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </section>


            <!-- New Arrivals CLOSE -->
        @endforeach


    </div>
    <div class="homepage-pagination-links container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-xs-11 col-xs-offset-1" style="padding-left: 0;">
                <ul>
                    <li class="hvr-backward">
                        <a href="javascript:;" data-type="prev" data-page="0" class="jplist-disabled">
                            <img src="/frontend/assets/images/Previous-2x.png" alt="arrow">
                        </a>
                    </li>
                    <li>
                        <label for="page_current_of" data-type="info">
                            <input type="number" name="page_current_of" id="page_current_of" value="1" min="1" max="1" step="1">
                            <span> of 1</span>
                        </label>
                        <ul class="jplist-holder" data-type="pages"><li class="active">
                                <a data-type="page" class="page-num jplist-selected" href="javascript:;" data-page="0" data-selected="true">1</a>
                            </li></ul>
                    </li>
                    <li class="hvr-forward">
                        <a href="javascript:;" data-type="next" data-page="0" class="jplist-disabled">
                            <img src="/frontend/assets/images/Next-2x2.png" alt="arrow">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Product Section CLOSE -->

    <!-- Start Message -->
    <div class="container message-get">
        <div class="row">
            <div class="col-xs-12 full-width">
                <div class="message-footer visible-xs">
                    <h2 class="get-stuff">Are You an Enigma?</h2>
                    <p class="footer_click_text">(click on steps to see)</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Message -->
</div>
<!-- Floating Cart Container CLOSE -->

<!-- Message BG -->
<div class="message-bg" style="background: none; padding-top: unset;">
    <div class="message-bg-mobile"></div>

    <!-- Message -->
    <div class="container-main" style="display: none;">

        <div class="message-container wow bounceInUp" data-wow-duration="2s" data-wow-delay="0.1s" data-wow-offset="160" style="visibility: visible; animation-duration: 2s; animation-delay: 0.1s; animation-name: bounceInUp;">
            <div class="message">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sollicitudin id leo eu sollicitudin. Proin in purus vel justo laoreet sollicitudin sit amet in nunc. Duis non tincidunt lacus. Quisque vulputate nulla at neque sagittis, at eleifend sapien
                placerat. Quisque vestibulum odio ex, sed vestibulum sapien elementum a. Maecenas cursus laoreet posuere. Phasellus sed nisl hendrerit, auctor est non, pharetra velit.
                <div class="puzzle"></div>
            </div>
        </div>

    </div>
    <!-- Message CLOSE -->


@include("frontend.partials.footer_old")

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
<div id="scroll-top" class="hvr-bob scroll-toop" style="display: none;">
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
<script>
    var __inTrans= false;



    function setOverlay(product_id)
        {
            $('.sliderbox-' + product_id).each(function(si, sb){
                $(sb).find(".overlay-text").each(function(i, e){
                    if($(e).hasClass("hidden"))
                    {
                        let sliderId = "HomeSliderInner" + $(e).attr("data-slider");
                        let sliderBox = document.getElementById(sliderId);
                        let totalWidth = sliderBox.offsetWidth + 30;
                        let totalHeight = sliderBox.offsetHeight;
                        $(e).removeClass("hidden");
                        $(e).addClass("hovereffect");
                        let elemWidth = $(this).outerWidth();
                        let elemHeight = $(this).outerHeight();
                        let gapFactor = ((4 * totalWidth) / 100);
                        let width = ((totalWidth - elemWidth) / 2) - (gapFactor * 2.1);
                        $(e).attr("style", "opacity: 1; -ms-transform:scale(1); -webkit-transform:scale(1); transform:scale(1); top:" + ((totalHeight / 2.0) - (elemHeight / 2.0)).toFixed(0) + "px; left:" + ((totalWidth / 2.0) - (elemWidth / 2.0)).toFixed(0) + "px");

                        if(!$(sliderBox).hasClass("slider-box-layered"))
                        {
                            $(sliderBox).addClass("slider-box-layered")
                        }

                        $(e).find(".overlay-text-before").each(function(bi, be){
                            $(be).attr("style", "left: " + ((width * -1) - (gapFactor/2)) + "px; width: " + width + "px");
                        });
                        $(e).find(".overlay-text-after").each(function(bi, be){
                            $(be).attr("style", "right: " + ((width * -1) - (gapFactor/2)) + "px; width: " + width + "px");
                        });
                    }
                })
                $(sb).find(".overlay-box").each(function(i,e){
                    if($(e).hasClass("hidden"))
                    {
                        let sliderId = "HomeSliderInner" + $(e).attr("data-slider");
                        let sliderBox = document.getElementById(sliderId);
                        let totalWidth = sliderBox.offsetWidth;
                        let totalHeight = sliderBox.offsetHeight;
                        $(e).removeClass("hidden");
                        $(e).addClass("hovereffect");
                        $(e).attr("style", "opacity: 0.54; -ms-transform:scale(1); -webkit-transform:scale(1); transform:scale(1);  width: " + totalWidth + "px; height: " + totalHeight + "px");
                    }
                })
            });
        }

        function removeOverlay(product_id)
        {
            $('.sliderbox-' + product_id).each(function(si, sb){
                $(sb).find(".overlay-text").each(function(i, e){
                    if(!$(e).hasClass("hidden"))
                    {
                        let sliderId = "HomeSliderInner" + $(e).attr("data-slider");
                        let sliderBox = document.getElementById(sliderId);
                        $(e).removeClass("hovereffect");
                        $(e).addClass("hidden");
                        $(e).attr("style", "opacity: 0;");
                        if($(sliderBox).hasClass("slider-box-layered"))
                        {
                            $(sliderBox).removeClass("slider-box-layered")
                        }
                    }
                })
                $(sb).find(".overlay-box").each(function(i,e){
                    if(!$(e).hasClass("hidden"))
                    {
                        $(e).removeClass("hovereffect");
                        $(e).addClass("hidden");
                        $(e).attr("style", "opacity: 0;");
                    }
                })
            });
        }

    function toggleDescription(product_id){
        if(__inTrans) return false;
        __inTrans = true;
        //hiding all elements except this one
        $(".myDiv").each(function(index,element){
            let productId = $(this).attr("pid");
            if(parseInt(productId) !== parseInt(product_id)){
                let ele = "#desc-"+productId;
                let inner_desc = "#inner-desc-"+productId;
                let short_description = "#short-description-"+productId;
                let mobile_product_title_ = "#mobile_product_title_"+productId;
                let expandIn = "#expand-in-"+productId;
                var isOpen = $(ele).hasClass("is-open");
                if(isOpen){
                    $(ele).animate({
                        height: '0'
                    }, {
                        duration: 100
                    });
                    $(mobile_product_title_).show();
                    $(expandIn).removeClass('expand-off');

                    //$(ele).fadeOut('slow');
                    $(ele).removeClass('is-open');
                    // $(ele).height('0');
                    setTimeout( function() {
                        setBracketHeight();
                    }, 500);
                }
                removeOverlay(productId);
            }
        });
        //end of hiding all element except this one

        let ele = "#desc-"+product_id;
        let inner_desc = "#inner-desc-"+product_id;
        let short_description = "#short-description-"+product_id;
        let mobile_product_title_ = "#mobile_product_title_"+product_id;
        let expandIn = "#expand-in-"+product_id;

        var hidden = $(ele).is(":hidden");
        var isOpen = $(ele).hasClass("is-open");
        var short_description_height = $(short_description).innerHeight();
        // console.log("short_description_height",short_description_height);
        // $(ele).slideToggle('slow');
        //if(!hidden){
        if(isOpen){
            $(ele).animate({
                height: '0'
            }, {
                duration: 100
            });
            $(mobile_product_title_).show();
            $(expandIn).removeClass('expand-off');

            //$(ele).fadeOut('slow');
            $(ele).removeClass('is-open');
            // $(ele).height('0');
            setTimeout( function() {
                setBracketHeight();
            }, 500);

            removeOverlay(product_id);

        }else{
            /*$(ele).animate({
                height: short_description_height+'px'
            }, {
                duration: 100
            });*/
            $(mobile_product_title_).hide();
            $(expandIn).addClass('expand-off');

            //$(ele).fadeIn('slow');
            $(ele).addClass('is-open');
            $(ele).height('auto');
            setTimeout( function() {
                setBracketHeight();
            }, 100);

            setOverlay(product_id);
        }



        setTimeout(() => {__inTrans = false; }, 500);
    }
    function setBracketHeight(){
        var rows = document.getElementsByClassName('size-15');
        var brackets = document.getElementsByClassName('bracket');
        for (var k = 0; k < rows.length; k++) {
            var rowsHeight = rows[k].offsetHeight + 45;
            brackets[k].setAttribute("style", "height:" + rowsHeight + "px");
            brackets[k].classList.add('bracket-bounce-in-left')
        }
    }
    function setTitleWidth(){
        var rows = document.getElementsByClassName('codCleanTopBox');
        //var brackets = document.getElementsByClassName('bracket');
        for (var k = 0; k < rows.length; k++) {
            var remaingWidth = rows[k].offsetWidth;
            var computedStyle = getComputedStyle(rows[k])
            remaingWidth -= parseInt(computedStyle.paddingLeft) + parseInt(computedStyle.paddingRight);
            var elements_ = rows[k].getElementsByClassName('elements_')
            for (var j = 0; j < elements_.length; j++) {
                remaingWidth -= elements_[j].offsetWidth;
            }
        }

        $(".titleBox").each(function(i, e){
            let sliderId = "HomeSliderInner" + $(e).attr("data-slider");
            let colorCount = parseInt($(e).attr("data-count"));
            let colWidth = parseInt($(e).attr("data-num"));
            let sliderBox = document.getElementById(sliderId);
            let totalWidth = sliderBox.offsetWidth;
            let totalHeight = sliderBox.offsetHeight;
            let addFactor = document.getElementById("homepage").offsetWidth < 768 ? 0 : 5;
            let leftFactor = (document.getElementById("homepage").offsetWidth < 768 && colorCount >= 3) ? "30px" : ((document.getElementById("homepage").offsetWidth >= 768 && colWidth < 6 && colorCount >= 3) ? "42px" : "0px");
            $(e).attr("style", "width: " + totalWidth + "px; top: " + (addFactor) + "px; padding-left: " + leftFactor);
            $(e).removeClass("hidden")
        })
    }
    window.addEventListener('resize', function(event) {
        setHeightOfElements();
    }, true);

    $(document).ready(function(){

        setTimeout( function() {
            setHeightOfElements();
        }, 2000);




        $(document.body).click( function() {
            hideProductDescription()
        });
        $(".myDiv").click(function(e) {
            e.stopPropagation(); // This is the preferred method.
            return false;        // This should not be used unless you do not want
                                 // any click events registering inside the div
        });

        /*$(document).on("mouseover", ".homepage-urbanenigma-slider", function(e){
            $(this).find(".overlay-text").each(function(i, e){
                if($(e).hasClass("hidden"))
                {
                    let sliderId = "HomeSliderInner" + $(e).attr("data-slider");
                    let sliderBox = document.getElementById(sliderId);
                    let totalWidth = sliderBox.offsetWidth + 30;
                    let totalHeight = sliderBox.offsetHeight;
                    $(e).removeClass("hidden");
                    let elemWidth = $(this).outerWidth();
                    let elemHeight = $(this).outerHeight();
                    $(e).attr("style", "top:" + ((totalHeight / 2.0) - (elemHeight / 2.0)).toFixed(0) + "px; left:" + ((totalWidth / 2.0) - (elemWidth / 2.0)).toFixed(0) + "px");
                    if(!$(sliderBox).hasClass("slider-box-layered"))
                    {
                        $(sliderBox).addClass("slider-box-layered")
                    }
                }
            })
        });
        $(document).on("mouseout", ".homepage-urbanenigma-slider", function(e){
            $(this).find(".overlay-text").each(function(i, e){
                if(!$(e).hasClass("hidden"))
                {
                    let sliderId = "HomeSliderInner" + $(e).attr("data-slider");
                    let sliderBox = document.getElementById(sliderId);
                    $(e).addClass("hidden");
                    if($(sliderBox).hasClass("slider-box-layered"))
                    {
                        $(sliderBox).removeClass("slider-box-layered")
                    }
                }
            })
        });*/
    });
    function setHeightOfElements(){
        setTimeout(function(){
            setBracketHeight();

        },1500);

        setTitleWidth();
    }

    $(document).on("click touchstart tap",".overlay-text, .overlay-box, .slider-inner",function(e){


        e.preventDefault();
        e.stopPropagation();
        let product_id = $(this).attr("data-productid");
        const href = $(this).attr("href");
        toggleDescription(product_id);
        window.location=href;
    });
    var imgs = document.images,
        len = imgs.length,
        counter = 0;

    [].forEach.call( imgs, function( img ) {
        if(img.complete){
            incrementCounter();
        }else{
            img.addEventListener( 'load', incrementCounter, false );
        }

    } );

    function incrementCounter() {
        counter++;
        if ( counter === len ) {
            console.log( 'All images loaded!' );
            setHeightOfElements();
        }
    }
    function hideProductDescription(){
        let ele ='.collapsible-content--all';
        $(ele).animate({
            height: '0'
        }, {
            duration: 100
        });
        //$(ele).height('0')
        $(ele).removeClass('is-open');
        setTimeout( function() {
            setBracketHeight();
        }, 100);

        $(".myDiv").each(function(index,element){
            let productId = $(this).attr("pid");
            removeOverlay(productId);
            $(element).find(".expand-off").each(function(ei, eImg){
                $(eImg).removeClass("expand-off");
            })
        });
    }
</script>
</html>
