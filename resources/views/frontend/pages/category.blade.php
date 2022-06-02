<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.meta',[
        'meta_title'=>'Urban Engima Collection | Snapback Hat, Filter Mask, Cotton Tee, Socks, Stickers',
        'meta_description'=>"The Urban Engima collection is a series of designs that are inspired by the urban lifestyle. From snapback hats to cotton tees and filter masks, we've got it all. Visit our website today!",
        'meta_img'=> asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>'Shop latest collection of T-shirts, Hats, stickers and more',
        ])
    <style>
    .filter_items > div {
        height: 150px;
        width: 150px;
        margin: 0 auto;
    }
    @media only screen and (min-width: 1661px) {
      .main-cat{
        max-width: 80%;
        padding: 0 45px 0 132px;
        margin: 0;
      }
      .side.jplist-panel{
        position: relative;
      }
    }

    @media only screen and (max-width: 780px) {
      .filter_row{
      	margin: 0;
      	padding-left: 20px;
      }
    }

    </style>
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
<body id="category" oncontextmenu="return false;">

<div id="preloader" style="display: none"></div>

<!-- Category Container -->
<div class="category-container">

    <!-- Header BG -->
    <div class="header-bg"></div>
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


    </header>
    <!-- Header CLOSE -->

    <!-- Category Content -->

    <div class="container-fluid main-cont">

        <div class="row">
            <!-- start Filter -->

            <div class="col-lg-2 col-md-4 col-xs-11 side jplist-panel">
                <div class="item-log"><img src="{{ asset('frontend/assets/images/Artboard 14.png') }}" alt="item"/>
                </div>
                <h1 class="display-none">Buy Urban Enigma Luxury Fashion Clothing Online</h1>
                <div class="row category-sidebar">
                    <div class="col-md-12 remove-padding">
                        <div class="row filter_row">
                          @foreach($filter_cat as $filter_item)

                          <div class="col-lg-6 col-xs-6 filter_items remove-padding">
                              <div class="shirt-log first-shirt">
                                  <input type="checkbox" id="category_filter-{{ $filter_item->id }}" style="visibility: hidden;" data-jplist-control="checkbox-text-filter" data-group="group1" data-name="name{{ $filter_item->id }}" data-path=".filtercategoryid" value="{{ $filter_item->id }}"/>
                                  <label for="category_filter-{{ $filter_item->id }}">
                                  <img class="non-selected" src="{{ asset('frontend/assets/images/'.$filter_item->filter_image) }}"
                                       alt="shirt"/>
                                  <img class="selected" src="{{ asset('frontend/assets/images/'.$filter_item->filter_image_selected) }}"
                                       alt="shirt"/>
                                  </label>
                              </div>
                          </div>

                          @endforeach
                        </div>
                    </div>


                </div>

                <div class="cloth-log"><img src="{{ asset('frontend/assets/images/Artboard 15.png') }}" alt="item"/>
                </div>

                <div class="descrip-size">
                    <div class="sort-by-collections">
                        @foreach($collections as $collection)
                        <h5>
                            <input class="category-collection-checkbox" data-collectionid="{{ $collection->id }}" type="checkbox" id="urban-{{ $collection->id }}" data-jplist-control="checkbox-text-filter" data-group="group1" data-name="name{{ $collection->id }}" data-path=".filtercollectionid" data-or="filtercollectionid-filters" value="{{ $collection->id }}" />
                            <label for="urban-{{ $collection->id }}">
                                <span>{{ $collection->name }}</span>
                            </label>
                        </h5>
                        @endforeach
                    </div>
                </div>

                <button
                    type="button"
                    id="reset_jplist_filter"
                    class="reset-jplist-filter hvr-bounce-out">
                        <span data-jplist-control="reset"
                        data-group="group1"
                        data-name="reset">Reset Filters</span>
                </button>
            </div>

            <div class="col-xs-2 visible-xs cat-side" id="filter_slide">
                <div class="tab-container">
                    <img src="{{ asset('frontend/assets/images/tab-cat.png') }}" alt="tab"/>
                </div>
                <div class="tab-arrow" id="filter_tab_arrow">
                    <i class="fa fa-arrow-right fa-2x" aria-hidden="true"></i>
                </div>
            </div>
            <!-- Filter -->

            <!-- COL 8 -->
            <div class="col-lg-10 col-md-8 col-xs-10 main-cat">
                <div class="ue-sorting-pagination-jplist row border-bottom-2px-aaa">
                    <div class="main-column col-xl-4 col-xl-offset-4  col-lg-5 col-lg-offset-3 col-xs-11 col-xs-offset-1">
                        <div class="ue-sorting-jplist">
                            <label for="jplist_select_sort">
                                <span>Sort by:</span>
                                <div class="orange-border">
                                    <select id="jplist_select_sort" class="cat-select" data-jplist-control="select-sort" data-group="group1" data-name="sort">
                                        <option value="0" data-path="default" data-name="sort"> --Select-- </option>
                                        <option value="1" data-path=".sortprice" data-name="sort" data-order="asc" data-type="number"> Price: Low - High</option>
                                        <option value="2" data-path=".sortprice" data-name="sort" data-order="desc" data-type="number"> Price: High - Low</option>
                                        <option value="3" data-path=".sortproductid" data-name="sort" data-order="desc" data-type="number"> Newest</option>
                                    </select>
                                </div>
                            </label>
                        </div>{{-- //.ue-sorting-jplist --}}
                        <div class="ue-paginatoin-jplist"
                                data-jplist-control="pagination"
                                data-group="group1"
                                data-items-per-page="16"
                                data-current-page="0"
                                data-name="pagination1">
                            <ul>
                                <li class="hvr-backward">
                                    <a href="javascript:;" data-type="prev">
                                        <img src="{{ asset('frontend/assets/images/back-cat.png') }}" alt="arrow"/>
                                        <span>Previous</span>
                                    </a>
                                </li>
                                <li>
                                    <label for="page_current_of_top" data-type="info">
                                        <input type="number" name="page_current_of_top" id="page_current_of_top" value="{pageNumber}" min="1" max="{pagesNumber}" step="1" onblur="goToPageJPList(this)">
                                        <span> of {pagesNumber}</span>
                                    </label>
                                    <ul class="jplist-holder" data-type="pages">
                                        <li>
                                            <a data-type="page" class="page-num" href="javascript:;">{pageNumber}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hvr-forward">
                                    <a href="javascript:;" data-type="next">
                                        <span>Next</span>
                                        <img src="{{ asset('frontend/assets/images/next-cat.png') }}" alt="arrow"/>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Sort -->

            <!-- Category Content -->
                <div class="row">
                    <!-- jplist Start -->
                    <div data-jplist-group="group1" class="items-container col-sm-12 equal-heights" style="display: none;">

                @foreach($category_colorwise_products as $key => $colorwise_product)

                    @php $colors_images = $category_slider_images->where('color_id', $colorwise_product->id) @endphp

                    @php $product_size = $category_colorwise_size_stock->where('color_id', $colorwise_product->id) @endphp

                        <!-- Category Item -->
                        <div data-jplist-item class="col-lg-3 col-md-3 col-sm-6 col-xs-6 cat-padding category-item-box animate-category-item-box collection-{{ $colorwise_product->collection_id }}" data-collectionid="{{ $colorwise_product->collection_id }}" data-collectionname="{{ $colorwise_product->collection_name }}" id="colorwise-product-{{$key}}-{{ $colorwise_product->collection_id }}">
                            <div class="sortprice" style="display: none;">{!! (int) str_replace('.00','',$product_size->pluck('price')->first()) + 0  !!}</div>
                            <div class="sortproductid" style="display: none;">{{ $colorwise_product->product_id }}</div>
                            <div class="filtercollectionid" style="display: none;">{{ $colorwise_product->collection_id }}</div>
                            <div class="filtercategoryid" style="display: none;">@php
                                $category = \App\Category::find( $colorwise_product->category_id );
                                echo $category->parent_id > 0 ? $category->parent_id : $category->id;
                            @endphp</div>
                            <div class="category-items">

                                <!-- Item -->
                                <div id="cat-thumb-{{ $colorwise_product->id }}" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
                                    <figure>
                                        <div class="carousel-inner cat-carousel thumb-cat" role="listbox"
                                             style="height: auto;">

                                            <div class="item active" style="">
                                                <div class="fig-image-bg">
                                                    <img class="cat-item"
                                                         src="{{ '/img/products/drop/'.$colors_images[$colors_images->keys()->all()[0]]->filename }}"
                                                         alt="{{ $colors_images[$colors_images->keys()->all()[0]]->alt_text }}">
                                                    <div class="cat-details">
                                                        <div class="item-info">
                                                          <img class="cat-enlarge cat-op" src="{{ asset('frontend/assets/images/Thumbnail button-150 ppi-02.png') }}" alt="enlarge" data-cid="{{ $colorwise_product->id }}">
                                                            <!-- <i class="fa fa-arrows-alt fa-lg cat-enlarge" data-cid="{{ $colorwise_product->id }}"></i> -->
                                                            <a href="{{ route('product.detail',["pid"=>$colorwise_product->alias,"color"=>strtolower($colorwise_product->color_name)]) }}">
                                                              <img class="cat-enlarge cat-op" src="{{ asset('frontend/assets/images/Details button-150 dpi-02.png') }}" alt="details">
                                                              <!-- <i class="fa fa-paperclip fa-lg"></i> -->
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <figcaption><p class="captt">
                                                        <span>{{ $colorwise_product->product_name }}</span></p>
                                                </figcaption>
                                            </div>

                                            <div class="item">
                                                <div class="fig-image-bg">
                                                    @if( isset( $colors_images->keys()->all()[1] ) )
                                                    <img class="cat-item"
                                                         src="{{ '/img/products/drop/'.$colors_images[$colors_images->keys()->all()[1]]->filename }}"
                                                         alt="{{ $colors_images[$colors_images->keys()->all()[1]]->alt_text }}">
                                                    @endif
                                                    <div class="cat-details">
                                                        <div class="item-info">
                                                            <img class="cat-enlarge cat-op" src="{{ asset('frontend/assets/images/Thumbnail button-150 ppi-02.png') }}" alt="enlarge" data-cid="{{ $colorwise_product->id }}">
                                                              <!-- <i class="fa fa-arrows-alt fa-lg cat-enlarge" data-cid="{{ $colorwise_product->id }}"></i> -->
                                                              <a href="{{ route('product.detail',["pid"=>$colorwise_product->alias,"color"=>strtolower($colorwise_product->color_name)]) }}">
                                                                <img class="cat-enlarge cat-op" src="{{ asset('frontend/assets/images/Details button-150 dpi-02.png') }}" alt="details">
                                                                <!-- <i class="fa fa-paperclip fa-lg"></i> -->
                                                              </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <figcaption><p class="captt">
                                                        <span>{{ $colorwise_product->product_name }}</span></p>
                                                </figcaption>

                                            </div>
                                        </div>

                                        <!-- Indicators -->
                                        <ol class="carousel-indicators thumb-indicators">
                                            <li data-target="#cat-thumb-{{ $colorwise_product->id }}" data-slide-to="0"
                                                class="active">
                                                <div class="thumbnail-container thumb-cont ">
                                                    <img src="{{ '/img/products/drop/'.$colors_images[$colors_images->keys()->all()[0]]->filename }}"
                                                         alt="{{ $colors_images[$colors_images->keys()->all()[0]]->alt_text }}">
                                                </div>
                                            </li>
                                            <li data-target="#cat-thumb-{{ $colorwise_product->id }}" data-slide-to="1"
                                                class="">
                                                <div class="thumbnail-container thumb-cont thumb-cont">
                                                    @if( isset( $colors_images->keys()->all()[1] ) )
                                                    <img src="{{ '/img/products/drop/'.$colors_images[$colors_images->keys()->all()[1]]->filename }}"
                                                         alt="{{ $colors_images[$colors_images->keys()->all()[1]]->alt_text }}">
                                                    @endif
                                                </div>
                                            </li>
                                        </ol>
                                        <!-- Wrapper for slides -->

                                    </figure>
                                </div>


                                <!--surround the select box within a "custom-select" DIV element.
                                Remember to set the width:-->
                                 @php $sizes = ['1' => 'onesize',
                                                's' => 'small',
                                                'm' => 'medium',
                                                'l' => 'large',
                                                'xl' => 'xlarge',
                                                '2xl' => 'xxlarge',
                                                '3xl' => 'xxxlarge',
                                                '4xl' => 'xxxxlarge'
                                            ];
                                @endphp


                                <ul class="cat-size hidden-xs">
                                    @php
                                    $d_count = 0;
                                    $pre_price = 0;
                                    $same_price = true;
                                    @endphp
                                    @foreach ( $sizes as $size_key => $size_value )
                                        @if($product_size->contains('size', $size_key))
                                            @php
                                                $color_stock = $product_size->where('size', $size_key)->pluck('color_stock')->get(0);
                                                $max_cart_qty = $product_size->where('size', $size_key)->pluck('max_cart_qty')->get(0);

                                                if($max_cart_qty != 0 && $max_cart_qty < $color_stock){
                                                  $color_stock = $max_cart_qty;
                                                }

                                                $attrid = $product_size->where('size', $size_key)->pluck('pa_id')->get(0);
                                                $price = $product_size->where('size', $size_key)->pluck('price')->get(0);
                                                $pacid = $product_size->where('size', $size_key)->pluck('pac_id')->get(0);
                                                $cart_stock = 0;
                                                $get_cart_item = \Cart::get($colorwise_product->product_id ."_".$attrid."_".$pacid);
                                                if($get_cart_item){
                                                  $cart_stock = $get_cart_item->quantity;
                                                }
                                                if($d_count == 0){
                                                  $pre_price = $price;
                                                }else{

                                                  if($pre_price != $price && $same_price === true){
                                                    $same_price = false;
                                                  }

                                                  $pre_price = $price;

                                                }
                                                $d_count++;
                                            @endphp
                                            <li id="desktop_{{$attrid}}_{{$pacid}}" data-aid="{{ $attrid }}" data-pacid="{{ $pacid }}" data-sizes="{{$size_key}}" data-sizel="{{$size_value}}" class="{{$size_value}}-img @if(($color_stock-$cart_stock) == 0 || empty(($color_stock-$cart_stock))) out-of-stock @endif" data-toggle="tooltip" data-placement="top" title="${{ $price }}">
                                                <img
                                                    @if(($color_stock-$cart_stock) > 0 && !empty(($color_stock-$cart_stock)))
                                                        src="{{ asset('frontend/assets/images/'.$size_value.'.png') }}"
                                                    @else
                                                        src="{{ asset('frontend/assets/images/'.$size_value.'_out.png') }}"
                                                    @endif
                                                    alt="{{$size_value}}" style="max-width: 100%;">
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                                <!-- Item CLOSE -->

                                <div class="custom-select visible-xs" style="width:100%;">
                                    <select>
                                        <option value="0" style="color: #565455;">Size</option>
                                        @foreach ($sizes as $size_key => $size_value )
                                            @if($product_size->contains('size',$size_key))
                                                @php
                                                    $color_stock = $product_size->where('size', $size_key)->pluck('color_stock')->get(0);
                                                    $max_cart_qty = $product_size->where('size', $size_key)->pluck('max_cart_qty')->get(0);

                                                    if($max_cart_qty != 0 && $max_cart_qty < $color_stock){
                                                      $color_stock = $max_cart_qty;
                                                    }                                                    $paid = $product_size->where('size', $size_key)->pluck('pa_id')->get(0);
                                                    $price = $product_size->where('size', $size_key)->pluck('price')->get(0);
                                                    $pacid = $product_size->where('size', $size_key)->pluck('pac_id')->get(0);
                                                    $cart_stock = 0;
                                                    $get_cart_item = \Cart::get($colorwise_product->product_id ."_".$attrid."_".$pacid);
                                                    if($get_cart_item){
                                                      $cart_stock = $get_cart_item->quantity;
                                                    }
                                                    $stock_left = ($color_stock - $cart_stock) <= 0 ? 0 : $color_stock - $cart_stock;
                                                @endphp
                                                <option id="mobile_{{ $paid . '_' . $pacid}}" value="{{ $paid .'-'. $pacid .'-'.$stock_left }}" data-sizes="{{$size_key}}" data-sizel="{{$size_value}}" data-colorstock="{{ $stock_left }}" @if($d_count > 1) data-price="{{ $price }}" @endif >{{ $size_key == 1 ? 'One Size' : strtoupper($size_key)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Add to Cart -->
                                <div class="add-to-cart-container">
                                    <div class="car-cont">
                                        <img data-pid="{{ $colorwise_product->product_id }}"
                                             data-cid="{{ $colorwise_product->id }}"
                                             data-pname="{{ $colorwise_product->product_name }}"
                                             class="add-cart"
                                             src="{{ asset('frontend/assets/images/Add-highreso.png') }}"
                                             alt="add-to-cart">
                                    </div>
                                    <span class="price-fig">@if($d_count > 1 && $same_price !== true)<small class="hidden-xs">Starting At:</small> <small class="visible-xs-block">Starts At:</small>@else <div class="margin_top_div"></div> @endif<span data-price="{{ $product_size->pluck('price')->first() }}">{{ '$'.$product_size->pluck('price')->first() }}</span></span>
                                </div>
                                <!-- Add to Cart CLOSE -->

                            </div>
                        </div>
                        <!-- Category Item CLOSE -->

                @endforeach
                    </div>
                    <!-- jplist Close -->

                    <!-- Category Content CLOSE -->
                </div> <!-- //.row -->
                <div class="row">
                <div class="col-sm-12 border-top-2px-aaa">
                    <div class="ue-sorting-pagination-jplist bottom row">
                        <div class="main-column col-xl-4 col-xl-offset-4  col-lg-5 col-lg-offset-3 col-xs-12">
                            <div class="ue-paginatoin-jplist"
                                    id="hidden-pagination-control" data-jplist-control="pagination"
                                    data-group="group1"
                                    data-items-per-page="16"
                                    data-current-page="0"
                                    data-name="pagination1">
                                <ul>
                                    <li class="hvr-backward">
                                        <a href="javascript:;" data-type="prev">
                                            <img src="{{ asset('frontend/assets/images/back-cat.png') }}" alt="arrow"/>
                                            <span>Previous</span>
                                        </a>
                                    </li>
                                    <li>
                                        <label for="page_current_of" data-type="info">
                                            <input type="number" name="page_current_of" id="page_current_of" value="{pageNumber}" min="1" max="{pagesNumber}" step="1" onblur="goToPageJPList(this)">
                                            <span> of {pagesNumber}</span>
                                        </label>
                                        <ul class="jplist-holder" data-type="pages">
                                            <li>
                                                <a data-type="page" class="page-num" href="javascript:;">{pageNumber}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="hvr-forward">
                                        <a href="javascript:;" data-type="next">
                                            <span>Next</span>
                                            <img src="{{ asset('frontend/assets/images/next-cat.png') }}" alt="arrow"/>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- COL 8 CLOSE -->

            </div>

        </div>

        <!-- Category Content CLOSE -->
    </div>

</div>
<!-- Category Container CLOSE -->

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

    <div class="copyright category hidden-xs">
        <p class="text-center text-md-left">Copyright &copy; {{ date('Y') }} Urban Enigma. All rights reserved.</p>
    </div>
</div>
<!-- Footer Inner Page CLOSE-->

<div class="copyright category visible-xs">
    <p class="text-center text-md-left">Copyright &copy; {{ date('Y') }} Urban Enigma. All rights reserved.</p>
</div>
<div id="nav-mobile"></div>

<div class="popup-overlay"></div>

<!-- Register Popup -->
@include('frontend.partials.register')
<!-- Register Popup CLOSE -->

<!-- Image enlarger -->
<div class="gallery-enlarger enlarge-position">
    <div class="image-enlarger">
        <div class="gallery-dd-close">
            <span class="close-big"></span>
        </div>

        <div id="cat" class="carousel slide" data-ride="carousel" data-interval="false">
            <!-- Indicators -->
            <ol class="carousel-indicators cat-indicators category-gallery-image-ol">
                {{--<li data-target="#cat" data-slide-to="0" class="active">
                    <div class="thumbnail-container thumb-cont">
                        <img src="{{ asset('frontend/assets/images/category-item.png') }}" alt="thumb">
                    </div>
                </li>
                <li data-target="#cat" data-slide-to="1">
                    <div class="thumbnail-container thumb-cont">
                        <img src="{{ asset('frontend/assets/images/qp-7.jpg') }}" alt="thumb">
                    </div>
                </li>
                <li data-target="#cat" data-slide-to="2">
                    <div class="thumbnail-container thumb-cont">
                        <img src="{{ asset('frontend/assets/images/qp-4.jpg') }}" alt="thumb">
                    </div>
                </li>--}}
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner cat-carousel category-gallery-image-item" role="listbox">
                {{--<div class="item active">
                    <img src="{{ asset('frontend/assets/images/category-item.png') }}" alt="thumb">
                    <div class="carousel-caption capt-cat">
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('frontend/assets/images/qp-7.jpg') }}" alt="thumb">
                    <div class="carousel-caption capt-cat">
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('frontend/assets/images/qp-4.jpg') }}" alt="thumb">
                    <div class="carousel-caption capt-cat">
                    </div>
                </div>--}}

            </div>
        </div>
    </div>
</div>

<!-- Search Box Popup -->
<div class="search-box-container">
<span>
<a href="javascript:;">x</a>
</span>
    <input id="searchBox" type="text" placeholder="Search..."/>
</div>
<!-- Search Box Popup -->

<!-- start scroll to top -->
<div id="scroll-top" class="hvr-bob scroll-toop blog-top" style="display: none;">
    <i class="fa fa-chevron-up fa-3x"></i>
</div>
<!-- end scroll to top -->

<div class="col-xs-2 visible-xs reposition" id="cart-xs">
    <img src="{{ asset('frontend/assets/images/quick-purchase-cart.png') }}" alt="basket">
    <div class="cart-badge">
        @php echo Cart::getTotalQuantity() @endphp
    </div>
</div>

<!-- start Cart Function -->
@include('frontend.partials.cart')
<!-- End Cart Function -->

<!-- Start Add To Cart Function -->
<div class="popup-bg"></div>
<div class="fixed-popup">
    <div class="col-md-12 col-xs-12 pop-up-cat">
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
                    <h4>Quantity:<span> 1</span></h4>
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
<!-- End Add To Cart Function -->

@include('frontend.partials.msg-modal')
{{-- Re-generate the files if any change made in any JS file by visiting this URL: BASE_URL/minify/save --}}

@include('frontend.partials.script')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
</body>
</html>
