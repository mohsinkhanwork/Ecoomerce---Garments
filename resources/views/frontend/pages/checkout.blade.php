<!DOCTYPE html>
<html lang="en">
<head>
    <title>Urban Enigma | Cart</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    @include('frontend.partials.meta')
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
fbq('track', 'InitiateCheckout');
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

    <!-- Cart Content -->
    <div class="cart-main wow fadeInDown" data-wow-duration="2s" data-wow-delay="0.3s" data-wow-offset="200" style="visibility: visible; animation-duration: 2s; animation-delay: 0.3s; animation-name: fadeInDown;">

        <div class="cart-title">
            <h3>Checkout</h3>
        </div>

        <div class="cart-head"></div>

        <div class="cart-body">

            <!-- Checkout Form -->
            @if(isset($usercart) && !empty($usercart))
            <div class="row">
                <div class="col-md-12 col-xs-12">
                        <form name="checkout-form" method="post" id="checkout-form" action="{{ route('pay') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    <div id="billing_address_container">
                                        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Billing Address</h3>

                                        <div class="form-group row">
                                            <label for="billing_fullname" class="col-sm-3 col-form-label"><i class="fa fa-user"></i> Full Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="billing_fullname" name="billing_fullname" value="{{ $customer ? $customer->billing_fullname : ''}}" placeholder="John M. Doe" autocomplete="off" maxlength="32" pattern="^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)" title="Name should only contain letters. e.g. John" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="billing_email" class="col-sm-3 col-form-label"><i class="fa fa-envelope"></i> Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="billing_email" name="billing_email" value="{{ $customer ? $customer->billing_email : '' }}" placeholder="john@example.com" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="billing_address" class="col-sm-3 col-form-label"><i class="fa fa-address-card-o"></i> Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{ $customer ? $customer->billing_address : '' }}" placeholder="542 W. 15th Street" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="billing_city" class="col-sm-3 col-form-label"><i class="fa fa-institution"></i> City</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="billing_city" name="billing_city" value="{{ $customer ? $customer->billing_city : '' }}" placeholder="New York" autocomplete="off" required>
                                            </div>

                                            <label for="billing_zip" class="col-sm-2 col-form-label"><i class="fa fa-institution"></i> Zip</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="billing_zip" name="billing_zip" value="{{ $customer ? $customer->billing_zip : '' }}" placeholder="10001" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="billing_country" class="col-sm-3 col-form-label"><i class="fa fa-globe"></i> Country</label>
                                            <div class="col-sm-4">
                                                <select name="billing_country" id="billing_country" class="form-control" required data-statesid="billing_state">
                                                    <option value=""> &mdash; Country &mdash;</option>
                                                    @if( $countries )
                                                        @foreach ( $countries as $country)
                                                            @php
                                                                $country_code = $customer ? $customer->billing_country : 'US';
                                                            @endphp
                                                            <option value="{{ $country->code }}" @if($country_code == $country->code) selected="selected" @endif>
                                                                {{$country->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <label for="billing_state" class="col-sm-2 col-form-label"><i class="fa fa-institution"></i> State</label>
                                            <div class="col-sm-3">
                                                <select name="billing_state" id="billing_state" class="form-control" required {{ !$billing_states ? 'disabled' : '' }}>
                                                    <option value=""> &mdash; State &mdash;</option>
                                                    @if( $billing_states )
                                                        @foreach ( $billing_states as $state )
                                                            @php
                                                                $state_code = $state->code;
                                                                $selected = '';
                                                                if( $customer ) {
                                                                    if( $customer->billing_country != 'US' ) {
                                                                        $state_code = $state->name;
                                                                    }

                                                                    if( $customer->billing_state == $state_code ) {
                                                                        $selected = 'selected="selected"';
                                                                    }
                                                                }
                                                            @endphp
                                                            <option value="{{ $state_code }}" {{$selected}}>{{$state->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                    </div>{{-- //#billing_address_container --}}

                                    <div class="form-group row">
                                        <div class="col-xs-12">
                                            <input type="checkbox" name="sameaddress" id="address-checkbox" value="on" />
                                            <label for="address-checkbox">Shipping address same as billing</label>
                                        </div>
                                    </div>

                                    <div id="shipping_address_container">
                                        <hr style="width: 82%;margin-left: 0; border-top: 1px solid #f0ad4e">

                                        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Shipping Address</h3>

                                        <div class="form-group row">
                                            <label for="shipping_fullname" class="col-sm-3 col-form-label"><i class="fa fa-user"></i> Full Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="shipping_fullname" name="shipping_fullname" {{ $customer ? $customer->shipping_fullname : '' }}"  placeholder="John M. Doe" autocomplete="off" maxlength="32" pattern="^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)" title="Name should only contain letters. e.g. John" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="shipping_email" class="col-sm-3 col-form-label"><i class="fa fa-envelope"></i> Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="shipping_email" name="shipping_email" {{ $customer ? $customer->shipping_email : '' }}"  placeholder="john@example.com" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="shipping_address" class="col-sm-3 col-form-label"><i class="fa fa-address-card-o"></i> Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control get-shipping-on-change" id="shipping_address" name="shipping_address" {{ $customer ? $customer->shipping_address : '' }}"  placeholder="542 W. 15th Street" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="shipping_city" class="col-sm-3 col-form-label"><i class="fa fa-institution"></i> City</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control get-shipping-on-change" id="shipping_city" name="shipping_city" {{ $customer ? $customer->shipping_city : '' }}"  placeholder="New York" autocomplete="off" required>
                                            </div><label for="shipping_zip" class="col-sm-2 col-form-label"><i class="fa fa-institution"></i> Zip</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control get-shipping-on-change" id="shipping_zip" name="shipping_zip" {{ $customer ? $customer->shipping_zip : '' }}"  placeholder="10001" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="shipping_country" class="col-sm-3 col-form-label"><i class="fa fa-globe"></i> Country</label>
                                            <div class="col-sm-4">
                                                <select name="shipping_country" id="shipping_country" class="form-control get-shipping-on-change" required data-statesid="shipping_state">
                                                    <option value=""> &mdash; Country &mdash;</option>
                                                    @if( $countries )
                                                        @foreach ( $countries as $country)
                                                            @php
                                                                $country_code = $customer ? $customer->shipping_country : 'US';
                                                            @endphp
                                                            <option value="{{ $country->code}}" @if($country_code == $country->code) selected="selected" @endif>
                                                                {{$country->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <label for="shipping_state" class="col-sm-2 col-form-label"><i class="fa fa-institution"></i> State</label>
                                            <div class="col-sm-3">
                                                <select name="shipping_state" id="shipping_state" class="form-control get-shipping-on-change" required {{ !$shipping_states ? 'disabled' : '' }}>
                                                    <option value=""> &mdash; State &mdash;</option>
                                                    @if( $shipping_states )
                                                        @foreach ( $shipping_states as $state)
                                                            @php
                                                                $state_code = $state->code;
                                                                $selected = '';
                                                                if( $customer ) {
                                                                    if( $customer->shipping_country != 'US' ) {
                                                                        $state_code = $state->name;
                                                                    }

                                                                    if( $customer->shipping_state == $state_code ) {
                                                                        $selected = 'selected="selected"';
                                                                    }
                                                                }
                                                            @endphp
                                                            <option value="{{ $state_code }}" {{$selected}}>{{$state->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <hr style="width: 100%;margin-left: 0; border-top: 1px solid #f0ad4e">

                                    <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Payment</h3>

                                    <label for="pay_with_stripe"  class="col-md-12" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">
                                            <input type="radio" name="pay_with" id="pay_with_stripe" value="stripe"> Pay with Stripe
                                        </label>
                                        <div id="pay_with_stripe_div" class="col-md-12" style="display: none;">
                                            <div class="form-group row">
                                        <label for="icons" class="col-sm-12 col-form-label">Accepted Cards</label>
                                        <div class="col-sm-12">
                                            <div class="icon-container" id="icons">
                                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cardName" class="col-sm-4 col-form-label">Name on Card</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="cardName" name="cardName" maxlength="32" placeholder="John More Doe" autocomplete="off" maxlength="32" pattern="^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cardNumber" class="col-sm-4 col-form-label">Card number</label>
                                        <div class="col-sm-6">
                                            <input type="tel" class="form-control" id="cardNumber" name="cardNumber" maxlength="20" placeholder="1234123412341234" autocomplete="cc-number" spellcheck="false" autocorrect="off" aria-invalid="false" pattern="^((67\d{2})|(4\d{3})|(5[1-5]\d{2})|(6011))(-?\s?\d{4}){3}|(3[4,7])\d{2}-?\s?\d{6}-?\s?\d{5}$">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cardExpiry" class="col-sm-4 col-form-label">Expiration</label>
                                        <div class="col-sm-2">
                                            <input type="tel" class="form-control" id="cardExpiry" name="cardExpiry" maxlength="5" placeholder="MM/YY" autocomplete="cc-exp" spellcheck="false" autocorrect="off" aria-invalid="false" pattern="^((0[1-9])|(1[0-2]))\/(\d{2})$">
                                        </div>

                                        <label for="cardCVC" class="col-sm-2 col-form-label">CVC</label>
                                        <div class="col-sm-2">
                                            <input type="tel" class="form-control" id="cardCVC" name="cardCVC" maxlength="4" placeholder="123" autocomplete="cc-csc" spellcheck="false" autocorrect="off" aria-invalid="false" pattern="^([0-9]{3,4})$">
                                        </div>
                                    </div>
                                </div>
                                <label for="pay_with_paypal" class="col-md-12" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">
                                    <input type="radio" name="pay_with" id="pay_with_paypal" value="paypal" checked> Pay with PayPal
                                </label>

                                </div>

                                <div class="col-md-6 col-md-offset-1 col-xs-12">
                                        <h4 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Cart Items
                                            <span class="price" style="color: black; float: right;">
                                              <i class="fa fa-shopping-cart"></i>
                                              <b>@php echo Cart::getTotalQuantity() @endphp</b>
                                            </span>
                                        </h4>


                                    @php $total = 0; @endphp
                                        @foreach($usercart as $cart)
                                            @php $total += $cart->price*$cart->quantity @endphp
                                            <div class="row equal-heights hidden-xs">
                                                @if(!$loop->first) <hr style="margin-left: 0; border-top: 1px solid #f0ad4e"> @endif
                                                <h4 class="col-xs-12" style="margin-bottom: 5px;">{{ $cart->product_name }}</h4>
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="vertical-middle">
                                                        <img src="{{ '/img/products/drop/'.$cart->filename }}" style="width: 100%; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-5">
                                                    <div class="vertical-middle">
                                                        <h5><span style="color: #a7a6a6;">
                                                            {{ (($cart->size == 's') ? 'Small' : (($cart->size == 'm') ? 'Medium' : (($cart->size == 'l') ? 'Large' : (($cart->size == 'xl') ? 'Extra Large' : (($cart->size == '2xl') ? '2 Extra Large' : (($cart->size == '3xl') ? '3 Extra Large' : (($cart->size == '4xl') ? '4 Extra Large' : ''))))))) }}
                                                        </span> </h5>
                                                        <h5><span style="color: #a7a6a6;">{{ $cart->color_name }}</span> </h5>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-xs-2">
                                                    <div class="vertical-middle">
                                                        <h5>${{ number_format( $cart->price, 2 ) }} x {{ $cart->quantity }}</h5>
                                                    </div>
                                                </div>
                                                    <div class="col-md-2 col-xs-2">
                                                        <div class="vertical-middle">
                                                            <h5>${{ number_format( $cart->quantity*$cart->price, 2) }}</h5>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="row equal-heights visible-xs">
                                                    @if(!$loop->first) <hr style="margin-left: 0; border-top: 1px solid #f0ad4e"> @endif
                                                    <h4 class="col-xs-12">{{ $cart->product_name }}</h4>
                                                    <div class="col-xs-6" style="padding-right: 0;">
                                                        <div class="vertical-middle">
                                                            <img src="{{ '/img/products/drop/'.$cart->filename }}" style="width: 100%; max-width: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="vertical-middle">
                                                            <h5><span style="color: #a7a6a6; font-size: 12px;">
                                                                {{ (($cart->size == 's') ? 'Small' : (($cart->size == 'm') ? 'Medium' : (($cart->size == 'l') ? 'Large' : (($cart->size == 'xl') ? 'Extra Large' : (($cart->size == '2xl') ? '2 Extra Large' : (($cart->size == '3xl') ? '3 Extra Large' : (($cart->size == '4xl') ? '4 Extra Large' : ''))))))) }}
                                                            </span> </h5>
                                                            <h5><span style="color: #a7a6a6; font-size: 12px;">{{ $cart->color_name }}</span> </h5>
                                                            <h5><span style="color: #a7a6a6; font-size: 12px;">${{ number_format($cart->price, 2) }} x {{ $cart->quantity }}</span></h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <div class="vertical-middle">
                                                            <h5>${{ number_format($cart->quantity*$cart->price, 2) }} !!!</h5>
                                                        </div>

                                                    </div>
                                                </div>

                                                <input type="hidden" name="product_id[]" value="{{ $cart->product_id }}">
                                                <input type="hidden" name="attribute_id[]" value="{{ $cart->attribute_id }}">
                                                <input type="hidden" name="color_id[]" value="{{ $cart->color_id }}">
                                                <input type="hidden" name="quantity[]" value="{{ $cart->quantity }}">
                                                <input type="hidden" name="price[]" value="{{ $cart->price }}">
                                        @endforeach

                                    <hr style="width: 100%;margin-left: 0; border-top: 1px solid #f0ad4e">

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Shippment</h3>
                                        </div>
                                        <div class="col-sm-10 text-right">
                                            <div id="shipping_rates_selection">

                                                    @php
                                                        $shipping_errors = [];
                                                        if( $validShippingAddr && $ratesObj ) {
                                                            $exceptions = false;
                                                            if( $validShippingAddr instanceof \Exception ) {
                                                                $message = json_decode( $validShippingAddr->getMessage(), true );
                                                                $exceptions = current($message);
                                                            }

                                                            if( $exceptions ) {
                                                                if( is_array($exceptions) ) {
                                                                    foreach( $exceptions as $message ) {
                                                                        $shipping_errors[] = $message;
                                                                    }
                                                                }
                                                                else {
                                                                    $shipping_errors[] = $exceptions;
                                                                }
                                                            }
                                                            elseif( $ratesObj instanceof \Exception ) {
                                                                $exceptions = json_decode( $ratesObj->getMessage(), true );
                                                                if( $exceptions && is_array( $exceptions ) ){
                                                                    foreach( $exceptions as $key => $exception ) {
                                                                        if( $exception && is_array( $exception ) ) {
                                                                            foreach( $exception as $types ){
                                                                                if( $types && is_array( $types ) ) {
                                                                                    foreach( $types as $type => $message) {
                                                                                        $shipping_errors[] = ucfirst($type) . ': ' . implode( '<br>', $message );
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            $shippingRates = $uniqueShippingRates = [];
                                                            if( count( $shipping_errors ) <= 0 ) {
                                                                foreach( $ratesObj->rates as $key => $rate ) {
                                                                    if( $customer->shipping_country != 'US' && $rate->provider == 'USPS' ) {
                                                                        continue;
                                                                    }
                                                                    $shippingRates[$key]['object_id'] = $rate->object_id;
                                                                    $shippingRates[$key]['provider'] = $rate->provider;
                                                                    $shippingRates[$key]['amount'] = $rate->amount;
                                                                }
                                                                usort($shippingRates, function($a, $b) {
                                                                    return $a['amount'] - $b['amount'];
                                                                });
                                                                if( $shippingRates && is_array( $shippingRates ) && count( $shippingRates ) > 0 ) {
                                                                    $oldProvder = [];
                                                                    foreach( $shippingRates as $shippingRate ) {
                                                                        if( in_array($shippingRate['provider'], $oldProvder) ) {
                                                                            continue;
                                                                        }

                                                                        $uniqueShippingRates[] = $shippingRate;
                                                                        $oldProvder[] = $shippingRate['provider'];
                                                                    }
                                                                }
                                                            }
                                                        }

                                                    @endphp
                                                @if( $total >= 275 )
                                                    <label for="free_shipping_rates"  class="col-md-12" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">
                                                        Free Shipping ($0.00)
                                                        <input type="radio" name="shipping_rates" id="free_shipping_rates" class="shipping-rate-control" value="0" style="margin: 0 0 0 10px;" checked>
                                                    </label>
                                                @else
                                                    @if( isset($shipping_errors) && count( $shipping_errors ) > 0 )
                                                        <strong class="red-limited">Address not found or invalid address.<br>Please correct shipping address to get shipping rates.</strong>
                                                    @endif

                                                    @if( isset($uniqueShippingRates) && count( $uniqueShippingRates ) > 0 )
                                                        @foreach ($uniqueShippingRates as $shippingRate)
                                                            <label for="{{ $shippingRate['object_id'] }}"  class="col-md-12" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">
                                                                {{ $shippingRate['provider'] }} (${{ $shippingRate['amount'] }})
                                                                <input type="radio" name="shipping_rates" id="{{ $shippingRate['object_id'] }}" class="shipping-rate-control" value="{{ $shippingRate['amount'] }}" data-provider="{{ $shippingRate['provider'] }}" style="margin: 0 0 0 10px;">
                                                            </label>
                                                        @endforeach
                                                    @endif
                                                @endif {{-- .// Free Shippgin Check --}}


                                            </div>
                                            <input type="hidden" name="shipping_provider" id="shipping_provider" value="">
                                            <input type="hidden" name="shipping_object_id" id="shipping_object_id" value="">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 35px;">
                                        <div class="col-sm-2">
                                            <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Sales Tax</h3>
                                        </div>
                                        <div id="sales_tax_rate_container" class="col-sm-10 text-right" style="padding-right: 30px; font-weight: 900; font-size: 1.1em; cursor: pointer;">
                                            @php
                                                $salesTaxAmount = 0;
                                                if( $salesTax ) {
                                                    $salesTaxAmount = ($salesTax / 100) * $total;
                                                }
                                            @endphp
                                            ${{ number_format($salesTaxAmount, 2) }}
                                        </div>
                                        <input type="hidden" name="sales_tax_rate" id="sales_tax_rate" value="{{ number_format($salesTaxAmount, 2) }}">
                                    </div>
                                    <div class="row">
                                        <div id="get_shipping_rates_response" class="col-sm-10" style="padding-top: 30px;">
                                            @if( count( $shipping_errors ) > 0 )
                                                <strong class="red-limited">
                                                    <ul>
                                                        @foreach ( $shipping_errors as $shipping_error )
                                                            <li>{{ str_replace( '__all__:', '', $shipping_error) }}</li>
                                                        @endforeach
                                                    </ul>
                                                </strong>
                                            @endif
                                        </div>
                                        <div class="col-sm-2 text-right">
                                            <a href="#" id="get_shipping_rates_action" class="btn btn-warning" style="margin-top: 20px;">Get Rates</a>
                                        </div>
                                        <?php
                                        $promo = "";
                                        $condition = Cart::getCondition('Promo Code Discount');
                                        if ($condition) {
                                            $p_attr = $condition->getAttributes();
                                            $promo = $p_attr['promo_code_text'];
                                        }
                                        ?>
                                        <div class="row mb-4">
                                    <div class="col-sm-1" style="padding-right: 0px;">
                                      @if($promo != "")
                                      <button type="button" class="btn" style="background-color: #f6912e; color: #fff; border-radius: 0px;"
                                              id="promo_code_remove">&#10006;
                                      </button>
                                      @endif
                                    </div>
                                    <div class="col-sm-8" style="padding-right: 0px;">

                                        <input type="text" value="{{ $promo }}" class="form-control" name="promo_code" id="promo_code"
                                               placeholder="Enter Promo Code"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn" style="background-color: #f6912e; color: #fff; border-radius: 0px;"
                                                id="promo_code_apply">Apply
                                        </button>
                                    </div>

                                    <div class="col-sm-12" id="msg_promo_code"></div>
                                </div>
                                    </div>

                                    <hr style="margin-left: 0; border-top: 1px solid #f0ad4e">
                                    <div class="form-group row">
                                        <div class="col-md-offset-4 col-md-8 col-xs-10 col-xs-offset-1">
                                            <input type="hidden" name="cart_amount" id="cart_amount" value="{{ $total }}">
                                            <input type="hidden" name="total_amount" id="total_amount" value="{{ number_format($total+$salesTaxAmount, 2) }}">
                                            <input type="hidden" name="session_id" value="{{ Session::get('session_id') }}">
                                            <h1 class="checkout-total">Total <span class="price" style="color:black; float: right;"><b>${{ number_format($total+$salesTaxAmount, 2) }}</b></span></h1>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-bottom: 5%;">
                                <div class="col-md-6 col-xs-12 col-md-offset-3 text-center">
                                    <input type="submit" value="Continue to checkout" class="btn btn-warning btn-lg">
                                </div>
                            </div>


                        </form>




                        <form id="paypal_checkout_form" action="" method="post" target="_self">
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="Payments-facilitator@Urban-Enigma.com">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="upload" value="1">

                            @php $total = 0; @endphp
                            @foreach($usercart as $key => $cart)
                                @php $total += $cart->price*$cart->quantity @endphp
                                <input type="hidden" name="item_name_{{$key+1}}" value="{{ $cart->product_name }}">
                                <input type="hidden" name="item_number_{{$key+1}}" value="{{ $cart->color_name }}_{{ $cart->product_id }}_{{ $cart->attribute_id }}_{{ $cart->color_id }}">
                                <input type="hidden" name="amount_{{$key+1}}" value="{{ $cart->price }}">
                                <input type="hidden" name="quantity_{{$key+1}}" value="{{ $cart->quantity }}">
                            @endforeach

                            <input type="hidden" name="item_name_{{$key+2}}" value="Shipping Charges">
                            <input type="hidden" name="item_number_{{$key+2}}" value="shipping_charges">
                            <input type="hidden" id="shipping_charges" name="amount_{{$key+2}}" value="0">
                            <input type="hidden" name="quantity_{{$key+2}}" value="1">

                            <input type="hidden" name="item_name_{{$key+3}}" value="Sales Tax">
                            <input type="hidden" name="item_number_{{$key+3}}" value="tax_rate">
                            <input type="hidden" id="tax_rate" name="amount_{{$key+3}}" value="{{number_format($salesTaxAmount, 2)}}">
                            <input type="hidden" name="quantity_{{$key+3}}" value="1">

                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="services">
                            <input type="hidden" name="no_note" value="1">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="tax_rate" value="0">
                            <input type="hidden" name="shipping" value="0">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" id="return" value="{{ url('/cart/checkout/paypal/status/success/hash_data') }}">
                            <input type="hidden" name="cancel_return" id="cancel_return" value="{{ url('/cart/checkout/paypal/status/cancel/hash_data') }}">
                            <input type="hidden" name="notify_url" id="notify_url" value="{{ url('/cart/checkout/paypal/status/notify/hash_data') }}">
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHostedGuest">
                            <input type="hidden" name="order_id" id="order_id" value="0">
                        </form>
                        {{-- <form id="paypal_checkout_form" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="Payments-facilitator@Urban-Enigma.com">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Urban Enigma">
                            <input type="hidden" name="item_number" value="urban-enigma">
                            <input type="hidden" name="amount" value="0">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="services">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="return" id="return" value="{{ url('/cart/checkout/paypal/status/success/hash_data') }}">
                            <input type="hidden" name="cancel_return" id="cancel_return" value="{{ url('/cart/checkout/paypal/status/cancel/hash_data') }}">
                            <input type="hidden" name="notify_url" id="notify_url" value="{{ url('/cart/checkout/paypal/status/notify/hash_data') }}">
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form> --}}


                </div>
            </div>

            <!-- ./Checkout Form -->

            @else
                <div style="text-align: center; margin-top: 40px;">
                    <span class="empty-cart-placeholder">Your cart is empty!</span>
                    <br />
                    <a href="{{ url('/') }}" class="btn btn-warning btn-lg">CONTINUE TO SHOP</a>
                </div>
            @endif

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

<div class="copyright checkout">
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
