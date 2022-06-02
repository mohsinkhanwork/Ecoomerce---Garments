<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.meta',[
        'meta_title'=>'Cart Urban Engima | Online Clothing Store Inspired by Cultural Diversity',
        'meta_description'=>"Our clothes embrace the urban lifestyle as a combination of many different cultures and ethnicities. We believe in being unique, not perfect. Stand out, be different by just being yourself an Enigma! Know more.",
        'meta_img'=> asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>'Cart Urban Engima | Online Clothing Store Inspired by Cultural Diversity',
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
fbq('track', 'AddToCart');
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
                <img class="logo hidden-xs" src="{{ asset('frontend/assets/images/enigma-logo.png') }}" alt="#"/>
                <img class="logo visible-xs" src="{{ asset('frontend/assets/images/enigma-logo-mobile.png') }}" alt="#"/>
            </a>
        </div>
        <!-- Logo CLOSE-->

        <!-- Navigation -->
        @include('frontend.partials.navigation')
        <!-- Navigation CLOSE -->

    </header>
    <!-- Header CLOSE -->
    <h1 class="display-none">Urban Enigma | Your Shopping Cart</h1>
    <!-- Cart Content -->
    <div class="cart-main wow fadeInDown" data-wow-duration="2s" data-wow-delay="0.3s" data-wow-offset="200" style="visibility: hidden; animation-duration: 2s; animation-delay: 0.3s; animation-name: fadeInDown;">

        @if (session('status'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ session('status') }}</strong>
        </span>
        @endif

        <div class="cart-title">
            <h3>Shopping Cart</h3>
        </div>

        <div class="cart-head">
            <div class="cart-product">
                <h3>PRODUCT</h3>
            </div>
            <div class="cart-quantity">
                <h3>QUANTITY</h3>
            </div>
            <div class="cart-total">
                <h3>TOTAL</h3>
            </div>
        </div>

        <div class="cart-body">

            @php $total = 0; @endphp
            @if(isset($scart) && !empty($scart))
            @foreach($scart as $item)
            @php
            $total += $item->price*$item->quantity;
            $item_stock = 0;
            if( $item->attributes->has('attribute_color_id') ){
              $item_stock = \App\Http\Controllers\ProductController::getColorStock($item->attributes->attribute_color_id);
            }

            @endphp
            <!-- Cart Item -->
            <div class="cart-row">

                <div class="cart-inner">

                    <!-- Cart Product -->
                    <div class="cart-product ">

                        <div class="cart-product-inner">

                            <h3 class="cart-product-name">{{$item->name}}</h3>

                            <div class="cart-product-image">
                                <img src="{{ '/img/products/drop/'.$item->attributes->attribute_color_image }}" alt="{{ $item->attributes->attribute_color_image_alt_text }}" />
                            </div>

                            <div class="cart-product-details">

                                @php $sizes = ['1' => 'One Size', 's' => 'Small', 'm' => 'Medium', 'l' => 'Large', 'xl' => 'Extra Large', '2xl' => '2 Extra Large', '3xl' => '3 Extra Large', '4xl' => '4 Extra Large']; @endphp
                                @if( $item->attributes->has('attribute_name') )
                                <div class="cart-selection">
                                    <h3>Size</h3>
                                    <div class="cart-border">
                                        <select>
                                            <option value="" selected>{{  $sizes[$item->attributes->attribute_name] }}</option>
                                        </select>
                                    </div>
                                </div>
                                  @endif
                                  @if( $item->attributes->has('attribute_color_name') )

                                <div class="cart-selection">
                                    <h3>Color</h3>
                                    <div class="cart-border">
                                      <select>
                                          <option value="" selected>{{  $item->attributes->attribute_color_name }}</option>
                                      </select>

                                    </div>
                                </div>
                                @endif

                                <div class="cart-total-mobile">
                                    @if( $item->attributes->has('attribute_name') )
                                  {{  $sizes[$item->attributes->attribute_name] }}
                                  @endif
                                <br>
                                ${{ number_format($item->price, 2) }} x {{ $item->quantity }}
                                </div>
                                <div class="mobile_qty_update" style="display:none;" id="mobile_qty_update_{{ $item->id }}">
                                  <form action="{{ route('update.cart',$item->id) }}" method="post" name="qty_m_{{ $item->id }}" id="qty_m_{{ $item->id }}">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <select name="qty" onchange="document.qty_m_{{ $item->id }}.submit()">
                                        @for($i=1;$i <= $item_stock;$i++)
                                        <option value="{{ $i }}" <?php echo ($i == $item->quantity) ? 'selected' : ''; ?> >{{ $i }}</option>
                                        @endfor
                                    </select>
                                  </form>
                              </div>
                            </div>

                        </div>

                    </div>

                    <!-- Cart Quantity -->
                    <div class="cart-quantity">
                        <div class="cart-quantity-inner">
                            <div class="cart-selection">
                                <div class="cart-border">
                                  <form action="{{ route('update.cart',$item->id) }}" method="post" name="qty_{{ $item->id }}" id="qty_{{ $item->id }}">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <select name="qty">
                                        @for($i=1;$i <= $item_stock;$i++)
                                        <option value="{{ $i }}" <?php echo ($i == $item->quantity) ? 'selected' : ''; ?> >{{ $i }}</option>
                                        @endfor
                                    </select>
                                  </form>
                                </div>
                            </div>
                            <div class="update_qty">
                              <a href="javascript:void(0);" onclick="document.qty_{{ $item->id }}.submit()">Update</a>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Total -->
                    <div class="cart-total">
                        <div class="cart-total-inner">
                            <span>${{ number_format( ($item->price*$item->quantity), 2 ) }}</span>
                        </div>
                    </div>


                </div>

                <a class="cart-update-mobile visible-xs" id="update_m_link_{{ $item->id }}" onclick="$('#mobile_qty_update_{{ $item->id }}').show();$('#update_m_link_{{ $item->id }}').css('visibility', 'hidden');" href="javascript:void(0);" >Update</a>
                <a class="cart-remove-mobile cart-remove-item-cart visible-xs" href="javascript:void(0);" data-cartid="{{ $item->id }}">X</a>
                <a class="cart-remove cart-remove-item-cart hidden-xs" href="javascript:void(0);" data-cartid="{{ $item->id }}">remove product</a>

            </div>
            <!-- Cart Item CLOSE -->
            @endforeach

            @else
                <div style="text-align: center; margin-top: 40px;">
                    <span class="empty-cart-placeholder">Your cart is empty!</span>
                </div>
            @endif

        </div>
        <!-- Cart Body CLOSE -->

        @if(isset($scart) && !empty($scart))
        <!-- Cart Checkout -->
        <div class="cart-check-container">

            <div class="cart-check-inner">

                <div class="button-bg hvr-float">
                    <a href="{{ url('/') }}">CONTINUE TO SHOP</a>
                </div>

            </div>

            <div class="cart-check-inner">

                <div class="cart-check-pull-right">

                    <div class="cart-grand">
                        <span>Grand Total:</span>
                        <span class="cart-grand-mobile">Total:</span>
                        <span id="cart-total-amount">${{ number_format( $total, 2 ) }}</span>
                    </div>

                    <div class="button-bg hvr-bob">
                        <a href="{{ route('checkout') }}">CHECK OUT</a>
                    </div>

                </div>

            </div>

        </div>
        <!-- Cart Checkout CLOSE -->
        @endif

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

<div class="copyright cart">
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
