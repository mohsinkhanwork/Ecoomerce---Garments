<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.meta',[
        'meta_title'=>'Checkout Urban Engima | Online Clothing Store Inspired by Cultural Diversity',
        'meta_description'=>"Our clothes embrace the urban lifestyle as a combination of many different cultures and ethnicities. We believe in being unique, not perfect. Stand out, be different by just being yourself an Enigma! Know more.",
        'meta_img'=> asset('frontend/assets/images/enigma-puzzle.png'),
        'meta_tags'=>'Checkout Urban Engima | Online Clothing Store Inspired by Cultural Diversity',
        ])
    <!-- Include SmartWizard CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/smartwizard/css/smart_wizard.css') }}">

    <!-- Optional SmartWizard theme -->
    <link href="{{ asset('frontend/assets/smartwizard/css/smart_wizard_theme_circles.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/assets/smartwizard/css/smart_wizard_theme_arrows.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/assets/smartwizard/css/smart_wizard_theme_dots.css') }}" rel="stylesheet" type="text/css" />
<style>

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


    <div class="container" style="width:100%;" id="checkout_steps_container">
  <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12 steps-container">
      <div class="step_container">
        <div class="toggle_cart_summery visible-xs">
          <div class="row">
            <div class="col-xs-9 text-left">
              <button id="toogle_cart_s_btn" onclick="toggleCartSummery()"><span class="s_h_text">Show</span> Order Summery <i class="fa fa-caret-down" aria-hidden="true"></i></buttom>
            </div>
            <div class="col-xs-3 text-right total_amount">
              {{ "$".number_format($scart_subtotal,2)}}
            </div>
          </div>
          <div class="" id="t_cart_m" style="display:none;">

              <?php
              $promo = "";
              $condition = Cart::getCondition('Promo Code Discount');
              if ($condition) {
                  $p_attr = $condition->getAttributes();
                  $promo = $p_attr['promo_code_text'];
                  $promo_code_name = $p_attr['promo_code_name'];
                  $promo_discount = round($condition->getCalculatedValue($scart_subtotal), 2);
              }
              ?>
              <div class="row mb-4 promo_container">
                @if($promo != "")
          <div class="col-sm-1 col-xs-2" style="padding-right: 0px;">

            <button type="button" class="btn"
                    id="promo_code_remove_m">&#10006;
            </button>

          </div>
          <div class="col-sm-8 col-xs-7" style="padding-right: 0px;">

              <input style="border: 1px solid #aba9a9;" type="text" value="{{ $promo }}" class="form-control" name="promo_code" id="promo_code_m"
                     placeholder="Enter Promo Code" autocomplete="off"/>
          </div>
          <div class="col-sm-3 col-xs-3">
              <button type="button" class="btn"
                      id="promo_code_apply_m">Apply
              </button>
          </div>
          @else
          <div class="col-sm-8 col-xs-8" style="padding-right: 0px;">

              <input style="border: 1px solid #aba9a9;" type="text" value="{{ $promo }}" class="form-control" name="promo_code" id="promo_code_m"
                     placeholder="Enter Promo Code" autocomplete="off"/>
          </div>
          <div class="col-sm-4 col-xs-4">
              <button type="button" class="btn"
                      id="promo_code_apply_m">Apply
              </button>
          </div>
          @endif


        </div>


        <div class="row subtotal_row">
          <div class="col-sm-12">
            <hr style="width: 100%;margin-left: 0; border-top: 1px solid #666">
          </div>
            <div class="col-sm-8 col-xs-8">
                <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Sub Total</h3>
            </div>
            <div class="col-sm-4 col-xs-4 text-right">
              {{ "$".number_format($scart_subtotal,2)}}
            </div>
        </div>

        <div class="row shipping_row">
            <div class="col-sm-12">
              <hr style="width: 100%;margin-left: 0; border-top: 1px solid #666">
            </div>
            <div class="col-sm-8 col-xs-8">
                <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Shipping</h3>
                <span class="free_shipping_text text-danger" style="display:none;">(Free Shipping)</span>
            </div>
            <div class="col-sm-4 col-xs-4 text-right shipping_amount">
              Will be Calculated in the next step.
            </div>
        </div>

        <div class="row tax_row" style="display:none;">
            <div class="col-sm-8 col-xs-8">
                <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Sales Tax</h3>
            </div>
            <div class="col-sm-4 col-xs-4 text-right tax_amount">
            </div>
        </div>
        @if($condition)
        <div class="row promo_row">
            <div class="col-sm-8 col-xs-8">
                <h3 style="font-weight: 600; font-size: larger; margin-bottom: 2%;">Promo Discount</h3>
                <span class="promo_code_name text-danger">({{ $promo_code_name }})</span>
            </div>
            <div class="col-sm-4 col-xs-4 text-right discount_amount text-danger">
              -{{ "$".number_format($promo_discount,2)}}
            </div>
        </div>
        @else
        <div class="row promo_row" style="display:none;">
            <div class="col-sm-8 col-xs-8">
                <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Promo Discount</h3>
                <span class="promo_code_name text-danger"></span>
            </div>
            <div class="col-sm-4 col-xs-4 text-right discount_amount text-danger">
              0
            </div>
        </div>
        @endif

        <div class="row total_row">
          <div class="col-sm-12 ">
            <hr style="width: 100%;margin-left: 0; border-top: 1px solid #666">
          </div>
            <div class="col-sm-8 col-xs-8">
                <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Total</h3>
            </div>
            <div class="col-sm-4 col-xs-4 text-right total_amount">
              {{ "$".number_format($scart_total,2)}}
            </div>
        </div>
        <hr style="width: 100%;margin-left: 0; border-top: 1px solid #666">

        <div class=" cart_container">

            @foreach($scart as $item)
            <div class="row cart_row">
            <div class="col-sm-3 col-xs-4">
              <div class="cart_img">
                <span class="cart_qty_circle">{{$item->quantity}}</span>
              <img src="{{ '/img/products/drop/'.$item->attributes->attribute_color_image }}" alt="{{ $item->attributes->attribute_color_image_alt_text }}" style="width: 100%; max-width: 100%;">
            </div>
            </div>
            <div class="col-sm-6 col-xs-4">
              {{$item->name}}<br>
              @if( $item->attributes->has('attribute_color_name') )
                {{  $item->attributes->attribute_color_name }}
              @endif


            </div>
            <div class="col-sm-3 col-xs-4">
                {{ "$".number_format($item->price,2)}}
            </div>
          </div>
            @endforeach
        </div>


          </div>

        </div>
        <form action="{{ route('pay.checkout.new') }}" id="myForm" method="post" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- SmartWizard html -->
        <div id="smartwizard">

            <ul>
                <li><a href="#cart" onclick="window.location.href ='{{ route('cart') }}';showLoader();return false;" ><small>Cart</small></a></li>
                <li><a href="#information-checkout"><small>Information</small></a></li>
                <li><a href="#shiping-checkout"><small>Shipping</small></a></li>
                <li><a href="#payment-checkout"><small>Payment</small></a></li>

            </ul>


            <div>

<div id="cart">
</div>
<div id="information-checkout">


                  <div id="form-step-1" role="form" data-toggle="validator">
                    <div id="information_container">




  <div class="row">
     <div class="pad15">
        @if(!Auth::Check())
       <div class="guest_row">

       <div class="col-sm-6 col-xs-6">
         <a class="btn btn-default pull-right guest_btn" onclick="checkoutTypeSelected('guest')">Guest Checkout</a>
       </div>

       <div class="col-sm-6 col-xs-6">
         <div id="or_div">
           OR
         </div>
         <a class="btn btn-default click-register login_btn" onclick="checkoutTypeSelected('login')">Login Checkout</a>
       </div>

       <input type="hidden" value="" id="checkout_type" name="checkout_type">
     </div>
     @else
     <input type="hidden" value="login" id="checkout_type" name="checkout_type">
      @endif

       <div class="col-sm-12 email_component">
       <div class="md-input">
           <input class="md-form-control" required="" type="email" id="shipping_email" name="shipping_email" value="{{ $customer ? $customer->shipping_email : '' }}"  placeholder="" autocomplete="on" >
           <span class="highlight"></span>
           <span class="bar"></span>
           <label>Email</label>
       </div>
       </div>



                            <div class="col-sm-12">
                              <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Shipping Address</h3>

                              <div class="md-input">
                                  <input class="md-form-control" required="" type="text" id="shipping_fullname" name="shipping_fullname" value="{{ $customer ? $customer->shipping_fullname : '' }}"  placeholder="" autocomplete="on" maxlength="32" pattern="^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)" title="Name should only contain letters. e.g. John">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Full Name</label>
                              </div>
                              </div>


                              <div class="col-sm-12">
                              <div class="md-input">
                                  <input class="md-form-control" required="" type="text" id="shipping_phone" name="shipping_phone" value="{{ $customer ? $customer->shipping_phone : '' }}"  placeholder="" autocomplete="on" >
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Phone</label>
                              </div>
                              </div>
                              <div class="col-sm-12">
                              <div class="md-input">
                                  <input class="md-form-control" required="" type="text" id="shipping_address" name="shipping_address" value="{{ $customer ? $customer->shipping_address : '' }}"  placeholder="" autocomplete="on">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Address</label>
                              </div>
                              </div>


                              <div class="col-sm-6">
                                <div class="md-input">
                                    <input class="md-form-control" required="" type="text" id="shipping_city" name="shipping_city" value="{{ $customer ? $customer->shipping_city : '' }}"  placeholder="" autocomplete="on" >
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>City</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="md-input">
                                    <input class="md-form-control" required="" type="text" id="shipping_zip" name="shipping_zip" value="{{ $customer ? $customer->shipping_zip : '' }}"  placeholder="" autocomplete="on" >
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Zip</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="md-input">
                                  <select name="shipping_country" id="shipping_country" class="md-form-control " required data-statesid="shipping_state">
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
                                  </select>                                      <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Country</label>
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <div class="md-input">
                                  <select name="shipping_state" id="shipping_state" class="md-form-control" required {{ !$shipping_states ? 'disabled' : '' }}>
                                      <option value=""></option>
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
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>State</label>
                                </div>
                              </div>




  </div>
</div>





                  </div>

                  <div class="row">
                       <div class="col-sm-12">

                         <a class="hidden-xs pull-left btn btn-secondary cart-return"  href="{{ route('cart') }}">Return To Cart</a>

                         <button class="pull-right btn btn-secondary sw-btn-next" type="button">Continue to Shipping</button>

                         <a class="visible-xs btn btn-secondary cart-return"  href="{{ route('cart') }}">Return To Cart</a>

                         </div>
                  </div>




              </div>
              </div>

                <div id="shiping-checkout">
                    <div class="previous_data">
                      <div class="row information_p">
                        <div class="col-sm-2 col-xs-6 text-left section_p">
                          Contact
                        </div>
                        <div class="col-sm-2 col-xs-6 visible-xs text-right change_p">
                          <a href="#information-checkout" class="link_p" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_email').focus();return false;">Change</a>
                        </div>
                        <div class="col-sm-8 col-xs-12 text-left data_p contact_p">
                        </div>
                        <div class="col-sm-2 col-xs-3 hidden-xs text-right change_p">
                          <a href="#information-checkout" class="link_p" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_email').focus();return false;">Change</a>
                        </div>
                      </div>

                      <div class="row ship_to_p">
                        <div class="col-sm-2 col-xs-6 text-left section_p">
                          Ship To
                        </div>
                        <div class="col-sm-2 col-xs-6 visible-xs text-right change_p">
                          <a href="#!" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_address').focus();return false;" class="link_p">Change</a>
                        </div>
                        <div class="col-sm-8 col-xs-12 text-left data_p address_p">
                        </div>
                        <div class="col-sm-2 col-xs-6 hidden-xs text-right change_p">
                          <a href="#!" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_address').focus();return false;" class="link_p">Change</a>
                        </div>
                      </div>
                    </div>

                    <div class="stem_h">
                      <h2>Shipping Method</h2>
                    </div>

                    <div id="form-step-2" role="form" data-toggle="validator">
                      <div class="col-sm-12 col-xs-12 text-right">
                          <div id="shipping_rates_selection">
                          </div>
                          <input type="hidden" name="shipping_provider" id="shipping_provider" value="">
                          <input type="hidden" name="shipping_object_id" id="shipping_object_id" value="">
                      </div>
                      <div class="col-sm-12 col-xs-12 text-left" style="margin: 20px 0;font-weight: 700;">
                      <p>
                        Please allow 2-4 business days for your order to be processed before shipping. These are estimated shipping times and seperate from processing times. Please keep that in mind when choosing your shipping option.
                         For any questions or concerns please email us: <a href="mailto:contact@Urban-Enigma.com">contact@Urban-Enigma.com</a>
                      </p>
                      </div>

                      <div class="col-sm-12 col-xs-12" >
                        <button class="hidden-xs btn btn-secondary sw-btn-prev pull-left disabled" type="button">Return Information</button>

                        <button class="btn btn-secondary sw-btn-next pull-right" type="button">Continue to Payment</button>
                        <button class=" visible-xs btn btn-secondary sw-btn-prev pull-left disabled" type="button">Return Information</button>

                      </div>

                    </div>

                </div>
                <div id="payment-checkout">

                  <div class="previous_data">
                    <div class="row information_p">
                      <div class="col-sm-2 col-xs-6 text-left section_p">
                        Contact
                      </div>
                      <div class="col-sm-2 col-xs-6 visible-xs text-right change_p">
                        <a href="#information-checkout" class="link_p" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_email').focus();return false;">Change</a>
                      </div>
                      <div class="col-sm-8 col-xs-12 text-left data_p contact_p">
                      </div>
                      <div class="col-sm-2 col-xs-6 hidden-xs text-right change_p">
                        <a href="#information-checkout" class="link_p" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_email').focus();return false;">Change</a>
                      </div>
                    </div>

                    <div class="row ship_to_p">
                      <div class="col-sm-2 col-xs-6 text-left section_p">
                        Ship To
                      </div>
                      <div class="col-sm-2 col-xs-6 visible-xs text-right change_p">
                        <a href="#!" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_address').focus();return false;" class="link_p">Change</a>
                      </div>
                      <div class="col-sm-8 col-xs-12 text-left data_p address_p">
                      </div>
                      <div class="col-sm-2 col-xs-6 hidden-xs text-right change_p">
                        <a href="#!" onclick="$('#smartwizard').smartWizard('goToStep',1);$('#shipping_address').focus();return false;" class="link_p">Change</a>
                      </div>
                    </div>

                    <div class="row ship_method_p">
                      <div class="col-sm-2 col-xs-6 text-left section_p">
                        Method
                      </div>
                      <div class="col-sm-2 col-xs-6 visible-xs text-right change_p">
                        <a href="#!" onclick="$('#smartwizard').smartWizard('goToStep',2);return false;" class="link_p">Change</a>
                      </div>
                      <div class="col-sm-8 col-xs-12 text-left data_p method_p">
                      </div>
                      <div class="col-sm-2 col-xs-6 hidden-xs text-right change_p">
                        <a href="#!" onclick="$('#smartwizard').smartWizard('goToStep',2);return false;" class="link_p">Change</a>
                      </div>
                    </div>
                  </div>

                  <div class="stem_h">
                    <h2>Payment</h2>
                  </div>

                    <div id="form-step-3" role="form" data-toggle="validator">

                      <div class="payment_method_section">
                      <label for="pay_with_stripe"  class="radio_container col-md-12 payment_method_inputs" style="border-bottom: 1px solid #bab2a8;">
                              <input type="radio" name="pay_with" id="pay_with_stripe" value="stripe" checked> &nbsp;Pay with Stripe
                              <span class="checkmark"></span>
                          </label>
                          <div id="pay_with_stripe_div" class="col-md-12 payment_info" >
                              <div class="form-group row">
                          <div class="col-sm-12">
                              <div class="icon-container" id="icons">
                                  <i class="fa fa-cc-visa" style="color:navy;"></i>
                                  <i class="fa fa-cc-amex" style="color:blue;"></i>
                                  <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                  <i class="fa fa-cc-discover" style="color:orange;"></i>
                              </div>
                          </div>
                      </div>

                      <div class="row">

                        <div class="col-sm-12">
                          <div class="md-input">
                              <input class="md-form-control" required  type="text" id="cardName" name="cardName" autocomplete="off" maxlength="32" pattern="^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)" title="Please Enter a valid Name.">
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label>Name on Card</label>
                          </div>
                          </div>

                        <div class="col-sm-12">
                          <div class="md-input">
                              <input class="md-form-control" required type="tel" id="cardNumber" name="cardNumber" autocomplete="cc-number" spellcheck="false" autocorrect="off" aria-invalid="false" pattern="^((67\d{2})|(4\d{3})|(5[1-5]\d{2})|(6011))(-?\s?\d{4}){3}|(3[4,7])\d{2}-?\s?\d{6}-?\s?\d{5}$" title="Please Enter a valid Card Number.">
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label>Card Number</label>
                          </div>
                          </div>

                        <div class="col-sm-6">
                          <div class="md-input">
                              <input class="md-form-control" autocomplete="off" required  type="tel" id="cardExpiry" name="cardExpiry" maxlength="9" autocomplete="cc-exp" spellcheck="false" autocorrect="off" aria-invalid="false" pattern="^((0[1-9])|(1[0-2]))\/(\d{4})$" title="Please Enter a valid Date.">
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label>Expiration(MM/YYYY)</label>
                          </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="md-input">
                                <input class="md-form-control" required  type="text" id="cardCVC" name="cardCVC" maxlength="4" autocomplete="cc-csc" spellcheck="false" autocorrect="off" aria-invalid="false" pattern="^([0-9]{3,4})$" title="Please Enter a valid Code.">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>CVC</label>
                            </div>
                            </div>




                      </div>

                  </div>
                  <label for="pay_with_paypal" class="radio_container col-md-12 payment_method_inputs" style="border-bottom: 1px solid #bab2a8;">
                      <input type="radio" name="pay_with" id="pay_with_paypal" value="paypal" > &nbsp;Pay with PayPal
                      <span class="checkmark"></span>
                  </label>
                  <div id="pay_with_paypal_div" class="col-md-12 payment_info" style="border-bottom: 0;border-radius: 5px;display: none;">
                    <div class="text-center">
                      <i class="fa fa-external-link" aria-hidden="true" style="font-size: 100px;color: #bab2a8;"></i>
                      <p>After clicking “Pay Now”, you will be redirected to PayPal to complete your purchase securely.</p>
                    </div>
                  </div>
                </div>


                  <div class="form-group row">

                      <div class="col-xs-12" style="margin-top: 30px;">

                        <label class="checkbox_container same_add_radio">Billing address same as Shipping
                          <input type="radio" checked="checked" name="usesameaddress" value="on">
                          <span class="checkmark"></span>
                        </label>

                      </div>
                      <div class="col-xs-12" style="margin-bottom: 30px;">
                          <label class="checkbox_container same_add_radio">
                            Use different Billing address
                            <input type="radio" name="usesameaddress" value="off" />
                            <span class="checkmark"></span>
                          </label>
                      </div>
                  </div>
                  <div class="" id="billing_address_container" style="display:none;">

                    <div class="row">
                       <div class="pad15">

                         <div class="col-sm-12">
                           <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Billing Address</h3>
                         <div class="md-input">
                             <input class="md-form-control" required="" type="email" id="billing_email" name="billing_email" value="{{ $customer ? $customer->billing_email : '' }}"  placeholder="" autocomplete="on" >
                             <span class="highlight"></span>
                             <span class="bar"></span>
                             <label>Email</label>
                         </div>
                       </div>



                                              <div class="col-sm-12">


                                                <div class="md-input">
                                                    <input class="md-form-control" required="" type="text" id="billing_fullname" name="billing_fullname" value="{{ $customer ? $customer->billing_fullname : '' }}"  placeholder="" autocomplete="on" maxlength="32" pattern="^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)" title="Name should only contain letters. e.g. John">
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label>Full Name</label>
                                                </div>
                                                </div>


                                                <div class="col-sm-12">
                                                <div class="md-input">
                                                    <input class="md-form-control" required="" type="text" id="billing_phone" name="billing_phone" value="{{ $customer ? $customer->billing_phone : '' }}"  placeholder="" autocomplete="on" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label>Phone</label>
                                                </div>
                                                </div>
                                                <div class="col-sm-12">
                                                <div class="md-input">
                                                    <input class="md-form-control" required="" type="text" id="billing_address" name="billing_address" value="{{ $customer ? $customer->billing_address : '' }}"  placeholder="" autocomplete="on">
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label>Address</label>
                                                </div>
                                                </div>


                                                <div class="col-sm-6">
                                                  <div class="md-input">
                                                      <input class="md-form-control" required="" type="text" id="billing_city" name="billing_city" value="{{ $customer ? $customer->billing_city : '' }}"  placeholder="" autocomplete="on" >
                                                      <span class="highlight"></span>
                                                      <span class="bar"></span>
                                                      <label>City</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="md-input">
                                                      <input class="md-form-control" required="" type="text" id="billing_zip" name="billing_zip" value="{{ $customer ? $customer->billing_zip : '' }}"  placeholder="" autocomplete="on" >
                                                      <span class="highlight"></span>
                                                      <span class="bar"></span>
                                                      <label>Zip</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="md-input">
                                                    <select name="billing_country" id="billing_country" class="md-form-control" required data-statesid="billing_state">
                                                        <option value=""> &mdash; Country &mdash;</option>
                                                        @if( $countries )
                                                            @foreach ( $countries as $country)
                                                                @php
                                                                    $country_code = $customer ? $customer->billing_country : 'US';
                                                                @endphp
                                                                <option value="{{ $country->code}}" @if($country_code == $country->code) selected="selected" @endif>
                                                                    {{$country->name}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>                                      <span class="highlight"></span>
                                                      <span class="bar"></span>
                                                      <label>Country</label>
                                                  </div>
                                                </div>

                                                <div class="col-sm-6">
                                                  <div class="md-input">
                                                    <select name="billing_state" id="billing_state" class="md-form-control " required {{ !$billing_states ? 'disabled' : '' }}>
                                                        <option value=""></option>
                                                        @if( $billing_states )
                                                            @foreach ( $billing_states as $state)
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
                                                      <span class="highlight"></span>
                                                      <span class="bar"></span>
                                                      <label>State</label>
                                                  </div>
                                                </div>




                    </div>
                  </div>

                  </div>


                  <div class="row">
                  <div class="col-sm-12 col-xs-12" >
                    <button class="hidden-xs btn btn-secondary sw-btn-prev disabled pull-left" type="button">Return To Shipping</button>
                    <button class="btn btn-secondary pull-right pay_now_btn" type="submit">Pay Now</button>
                    <button class=" visible-xs btn btn-secondary sw-btn-prev disabled pull-left" type="button">Return To Shipping</button>

                  </div>
                  </div>

                    </div>



                </div>

            </div>
        </div>

        </form>

    </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 cart_total_container hidden-xs">

      <div class="row mb-4 promo_container">
        @if($promo != "")
  <div class="col-sm-1 col-xs-2" style="padding-right: 0px;">

    <button type="button" class="btn"
            id="promo_code_remove">&#10006;
    </button>

  </div>
  <div class="col-sm-8 col-xs-7" style="padding-right: 0px;">

      <input style="border: 1px solid #aba9a9;" type="text" value="{{ $promo }}" class="form-control" name="promo_code" id="promo_code"
             placeholder="Enter Promo Code" autocomplete="off"/>
  </div>
  <div class="col-sm-3 col-xs-3">
      <button type="button" class="btn"
              id="promo_code_apply">Apply
      </button>
  </div>
  @else
  <div class="col-sm-9 col-xs-7" style="padding-right: 0px;">

      <input style="border: 1px solid #aba9a9;" type="text" value="{{ $promo }}" class="form-control" name="promo_code" id="promo_code"
             placeholder="Enter Promo Code" autocomplete="off"/>
  </div>
  <div class="col-sm-3 col-xs-3">
      <button type="button" class="btn"
              id="promo_code_apply">Apply
      </button>
  </div>
  @endif
</div>


<div class="row subtotal_row">
  <div class="col-sm-12">
    <hr style="width: 100%;margin-left: 0; border-top: 3px solid #666">
  </div>
    <div class="col-sm-8 col-xs-8">
        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Sub Total</h3>
    </div>
    <div class="col-sm-4 col-xs-4 text-right">
      {{ "$".number_format($scart_subtotal,2)}}
    </div>
</div>

<div class="row shipping_row">
    <div class="col-sm-8 col-xs-8">
        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;display: inline;">Shipping</h3>
        <span class="free_shipping_text text-danger" style="display:none;">(Free Shipping)</span>

    </div>
    <div class="col-sm-4 col-xs-4 text-right shipping_amount">
      Will be Calculated in the next step.
    </div>
</div>

<div class="row tax_row" style="display:none;">
    <div class="col-sm-8 col-xs-8">
        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Sales Tax</h3>
    </div>
    <div class="col-sm-4 col-xs-4 text-right tax_amount">
    </div>
</div>
@if($condition)
<div class="row promo_row">
    <div class="col-sm-8 col-xs-8">
        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;display: inline;">Promo Discount</h3>
        <span class="promo_code_name text-danger">({{ $promo_code_name }})</span>
    </div>
    <div class="col-sm-4 col-xs-4 text-right discount_amount text-danger">
      -{{ "$".number_format($promo_discount,2)}}
    </div>
</div>
@else
<div class="row promo_row" style="display:none;">
    <div class="col-sm-8 col-xs-8">
        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;display: inline;">Promo Discount</h3>
        <span class="promo_code_name text-danger"></span>
    </div>
    <div class="col-sm-4 col-xs-4 text-right discount_amount text-danger">
      0
    </div>
</div>
@endif

<div class="row total_row">
  <div class="col-sm-12 ">
    <hr style="width: 100%;margin-left: 0; border-top: 3px solid #666">
  </div>
    <div class="col-sm-8 col-xs-8">
        <h3 style="font-weight: 600; font-size: larger; margin-bottom: 5%;">Total</h3>
    </div>
    <div class="col-sm-4 col-xs-4 text-right total_amount">
      {{ "$".number_format($scart_total,2)}}
    </div>
</div>
<hr style="width: 100%;margin-left: 0; border-top: 3px solid #666">

<div class=" cart_container">

    @foreach($scart as $item)
    <div class="row cart_row">
    <div class="col-sm-3 col-xs-4">
      <div class="cart_img">
        <span class="cart_qty_circle">{{$item->quantity}}</span>
      <img src="{{ '/img/products/drop/'.$item->attributes->attribute_color_image }}" alt="{{ $item->attributes->attribute_color_image_alt_text }}" style="width: 100%; max-width: 100%;">
    </div>
    </div>
    <div class="col-sm-6 col-xs-4">
      {{$item->name}}<br>
      @php $sizes = ['1' => 'One Size', 's' => 'Small', 'm' => 'Medium', 'l' => 'Large', 'xl' => 'Extra Large', '2xl' => '2 Extra Large', '3xl' => '3 Extra Large', '4xl' => '4 Extra Large']; @endphp

      @if( $item->attributes->has('attribute_name') )
        {{  $sizes[$item->attributes->attribute_name] }},
      @endif

      @if( $item->attributes->has('attribute_color_name') )
        {{  $item->attributes->attribute_color_name }}
      @endif


    </div>
    <div class="col-sm-3 col-xs-4">
        {{ "$".number_format($item->price,2)}}
    </div>
  </div>
    @endforeach
</div>



    </div>
  </div>
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
<!-- Include jQuery Validator plugin -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>-->
<script type="text/javascript" src="{{ asset('frontend/assets/smartwizard/js/jquery.smartWizard.min.js') }}"></script>
<!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->



<script type="text/javascript">
        $(document).ready(function(){


          // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){
                                                    if( !$(this).hasClass('disabled')){
                                                        var elmForm = $("#myForm");
                                                        if(elmForm){

                                                            alert('Great! we are ready to submit form');
                                                                elmForm.submit();


                                                        }
                                                    }
                                                });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){
                                                    $('#smartwizard').smartWizard("reset");
                                                    $('#myForm').find("input, textarea").val("");
                                                });



            // Smart Wizard
            $('#smartwizard').smartWizard({
                    selected: 1,
                    theme: 'dots',
                    transitionEffect:'fade',
                    useURLhash: false,
                    showStepURLhash: false,
                    toolbarSettings: {toolbarPosition: 'bottom',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    },
                    anchorSettings: {
                                markDoneStep: true, // add done css
                                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                            }
                 });


                 $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                // Enable finish button only on last step
                if(stepNumber == 2){
                    $('.btn-finish').removeClass('disabled');
                }else{
                    $('.btn-finish').addClass('disabled');
                }
            });


            $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                var elmForm = $("#form-step-" + stepNumber);
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward' && stepNumber == 1 ){

                  var name = '',
                      company = '',
                      street1 = '',
                      street2 = '',
                      city = '',
                      state = '',
                      zip = '',
                      country = '',
                      phone = '',
                      email = '';
                      var status = false;

                      name = $("#form-step-" + stepNumber +' #shipping_fullname').val();
                      email = $("#form-step-" + stepNumber +' #shipping_email').val();
                      street1 = $("#form-step-" + stepNumber +' #shipping_address').val();
                      city = $("#form-step-" + stepNumber +' #shipping_city').val();
                      state = $("#form-step-" + stepNumber +' #shipping_state').val();
                      zip = $("#form-step-" + stepNumber +' #shipping_zip').val();
                      country = $("#form-step-" + stepNumber +' #shipping_country').val();
                      phone = $("#form-step-" + stepNumber +' #shipping_phone').val();
                      checkout_type = $("#form-step-" + stepNumber +' #checkout_type').val();

                      if(checkout_type == ""){

                        status = false;
                        Swal.fire(
                      'Please choose login or guest checkout.',
                      '',
                      'error'
                    );
                        return status;

                      }

                      var email_re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                      var is_email = email_re.test(email);
                      if(!is_email){
                        status = false;
                        Swal.fire(
                      'Please Enter a Valid Email.',
                      '',
                      'error'
                    );
                        return status;
                      }

                      var name_re = /^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/;
                    	var is_name = name_re.test(name);
                    	if(!is_name){
                        status = false;
                        Swal.fire(
                      'Please Enter a Valid Full Name.',
                      '',
                      'error'
                    );
                        return status;
                      }


                      if(name != "" && email!=""&& street1!=""&& city!=""&& state!=""&& zip!=""&& country!="" && phone!=""){

                        $.ajax({
                            type: "POST",
                            url: "/cart/checkout/get_shipping_rates_new",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'name': name,
                                'company': company,
                                'street1': street1,
                                'street2': street2,
                                'city': city,
                                'state': state,
                                'country': country,
                                'zip': zip,
                                'phone': phone,
                                'email': email
                            },
                            dataType: "json",
                            async: !1,
                            beforeSend: function() {
                              showLoader();
                            },
                            success: function(response) {
                                if (response == 'Free Shipping') {
                                    html = '<label for="free_shipping_rates"  class="col-md-12 radio_container" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">' + ' Free Shipping ($0.00) ' + '<input type="radio" name="shipping_rates" id="free_shipping_rates" class="shipping-rate-control" value="0" style="margin: 0 0 0 10px;" checked><span class="checkmark"></span>' + '</label>'
                                    addShippingText(0,"Free Shipping");
                                    $('.free_shipping_text').show();
                                } else {
                                    var html = '';
                                    $(response).each(function(idx, el) {
                                      function_name = "'"+el.provider+"'";
                                        html = html + '<label for="' + el.object_id + '"  class="col-md-12 radio_container" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">' + el.provider + ' (' + el.amount + ')' + '<input type="radio" onchange="addShippingText(' + el.amount + ',' + function_name + ')" name="shipping_rates" id="' + el.object_id + '" class="shipping-rate-control" value="' + el.amount + '" data-provider="' + el.provider + '"><span class="checkmark"></span>' + '</label>'
                                    })
                                }

                                $('#get_shipping_rates_response').html('');
                                $.when($('#shipping_rates_selection').html(html)).then(function() {
                                });
                                $('.contact_p').html(email);
                                $('.address_p').html(street1 + "," +city+ "," +state+ "," +zip);

                                status = true;
                            },
                            error: function(xhr,err) {
                              console.log(xhr.status);
                                if(xhr.status == 419){

                                  Swal.fire(
                                'Session Expired.',
                                '',
                                'error'
                              );


                            }else if (xhr.status == 420) {
                              Swal.fire(
                            xhr.responseText,
                            '',
                            'error'
                          );
                          window.location.href = '<?php echo route('cart') ?>';
                            }else{


                                var errors = $.parseJSON(xhr.responseText);
                                var errorHtml = '<ul style="list-style-type:none;">';
                                $(errors).each(function(idx, error) {
                                    errorHtml = errorHtml + '<li class="red-limited">' + error + '</li>'
                                });
                                errorHtml = errorHtml + '</ul>';

                                    Swal.fire(
                                  errorHtml,
                                  '',
                                  'error'
                                );
                                }
                                status = false;

                            },
                            complete: function() {
                              hideLoader();

                            }
                        });

                      }else {

                            Swal.fire(
                          "All fields are required.",
                          '',
                          'error'
                          )

                        status = false;
                      }


                      return status;

                }

                if(stepDirection === 'forward' && stepNumber == 2 ){
                  var object_id = $("#form-step-2 input[name=shipping_rates]:checked").attr('id');
                  var status = false;

                  if(typeof object_id !== "undefined"){
                    $.ajax({
                        type: "POST",
                        url: "/cart/checkout/add_shipping_rates",
                        data: {
                            '_method': 'POST',
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'shipping_object_id': object_id
                        },
                        dataType: "json",
                        async: !1,
                        beforeSend: function() {
                          showLoader();
                        },
                        success: function(response) {
                          $('.shipping_amount').html('$'+ parseFloat(response.shipping).toFixed(2));
                          $('.tax_amount').html('$'+ parseFloat(response.tax).toFixed(2));
                          $('.total_amount').html('$'+ parseFloat(response.total).toFixed(2));
                          $('.discount_amount').html('-$'+ parseFloat(response.discount).toFixed(2));
                          $('.shipping_row').show();
                          $('.tax_row').show();
                          $('.total_row').show();
                          status = true;
                        },
                        error: function() {

                              Swal.fire(
                            "Something Went Wrong",
                            '',
                            'error'
                            )

                          status = true;
                        },
                        complete: function() {
                            hideLoader();
                        }
                    });

                  }else {

                    Swal.fire(
                  "Please Select Shipping.",
                  '',
                  'error'
                  )

                    status = false;
                  }

                  return status;


                }

            });



        });
        $('#billing_address_container').hide('500');
        $('#billing_address_container').find('input, select').attr('disabled', !0);

        $('input[name=usesameaddress]').change(function() {
            var status = $(this).prop('checked');

            if (this.value == 'on') {
                $('#billing_address_container').hide('500');
                $('#billing_address_container').find('input, select').attr('disabled', !0);

            } else {
                $('#billing_address_container').show('500');
                $('#billing_address_container').find('input, select').attr('disabled', !1);
            }
        });

        function addShippingText(amount,provider){


          var subtotal = <?php echo $scart_subtotal ?>;
          var promo = <?php echo $scart_promo_discount ?>;
          var shipping = amount;

          var total = (+subtotal)+(+promo)+(+shipping);
          $('.shipping_amount').html("$"+shipping.toFixed(2));
          $('.total_amount').html("$"+total.toFixed(2));

          $('.method_p').html(provider+"("+"$"+shipping.toFixed(2)+")");

        }

        function toggleCartSummery(){
          $('#t_cart_m').slideToggle("slow");
          $("#toogle_cart_s_btn i").toggleClass("fa-caret-down");
          $("#toogle_cart_s_btn i").toggleClass("fa-caret-up");

          html = $('.s_h_text').html();
          if(html == "Show"){
            $('.s_h_text').html("Hide");
          }
          if(html == "Hide"){
            $('.s_h_text').html("Show");
          }
        }
        $("#myForm .md-form-control").blur(function() {
          if($(this).val() != ""){
            $(this).addClass("blur");
          }else {
            $(this).removeClass("blur");
          }
        });

        function checkoutTypeSelected(type){


          if(type == "guest"){
            $('#checkout_type').val(type);

            $('.guest_btn').addClass('type_selected');
            $('.login_btn').removeClass('type_selected');
          }else {
            $('#checkout_type').val("");
            $('.guest_btn').removeClass('type_selected');
            $('.login_btn').addClass('type_selected');

          }


        }


        $("#promo_code_apply").click(function() {
    promoCode("")
});
$("#promo_code_apply_m").click(function() {
    promoCode("m")
});
$("#promo_code_remove").click(function() {
    removePromoCode()
});
$("#promo_code_remove_m").click(function() {
    removePromoCode()
});

function removePromoCode() {
    $.ajax({
        url: "/promo_code_remove",
        type: 'post',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log(response);
            Swal.fire(response.message, '', 'success');
            $('.promo_row .col-sm-4.col-xs-4.text-right').html('-$' + parseFloat(response.discount_amount).toFixed(2));
            $('.total_amount').html('$' + parseFloat(response.total).toFixed(2));
            $('.promo_row').hide();
            $('#promo_code_remove').hide();
            $('#promo_code').val("");
            $('#promo_code_m').val("")
        },
        error: function(xhr, status, error) {
            Swal.fire(xhr.responseText, '', 'error')
        }
    })
}

function promoCode(id) {
    if (id == "m") {
        var promoCode = $("#promo_code_" + id).val()
    } else {
        var promoCode = $("#promo_code").val()
    }
    if (promoCode != '') {
        $.ajax({
            url: "/promo_code",
            type: 'post',
            data: {
                'promo_code': promoCode,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                Swal.fire(response.message, '', 'success');
                $('.promo_row .col-sm-4.col-xs-4.text-right').html('-$' + parseFloat(response.discount_amount).toFixed(2));
                $('.promo_code_name').html('('+response.discount_text+')');
                $('.total_amount').html('$' + parseFloat(response.total).toFixed(2));
                $('.promo_row').show()
            },
            error: function(xhr, status, error) {
                Swal.fire(xhr.responseText, '', 'error')
            }
        })
    } else {
        Swal.fire("Please Enter a Promocode.", '', 'error')
    }
}


input_credit_card = function(input)
{
    var format_and_pos = function(char, backspace)
    {
        var start = 0;
        var end = 0;
        var pos = 0;
        var separator = " ";
        var value = input.value;

        if (char !== false)
        {
            start = input.selectionStart;
            end = input.selectionEnd;

            if (backspace && start > 0) // handle backspace onkeydown
            {
                start--;

                if (value[start] == separator)
                { start--; }
            }
            // To be able to replace the selection if there is one
            value = value.substring(0, start) + char + value.substring(end);

            pos = start + char.length; // caret position
        }

        var d = 0; // digit count
        var dd = 0; // total
        var gi = 0; // group index
        var newV = "";
        var groups = /^\D*3[47]/.test(value) ? // check for American Express
        [4, 6, 5] : [4, 4, 4, 4];

        for (var i = 0; i < value.length; i++)
        {
            if (/\D/.test(value[i]))
            {
                if (start > i)
                { pos--; }
            }
            else
            {
                if (d === groups[gi])
                {
                    newV += separator;
                    d = 0;
                    gi++;

                    if (start >= i)
                    { pos++; }
                }
                newV += value[i];
                d++;
                dd++;
            }
            if (d === groups[gi] && groups.length === gi + 1) // max length
            { break; }
        }
        input.value = newV;

        if (char !== false)
        { input.setSelectionRange(pos, pos); }
    };

    input.addEventListener('keypress', function(e)
    {
        var code = e.charCode || e.keyCode || e.which;

        // Check for tab and arrow keys (needed in Firefox)
        if (code !== 9 && (code < 37 || code > 40) &&
        // and CTRL+C / CTRL+V
        !(e.ctrlKey && (code === 99 || code === 118)))
        {
            e.preventDefault();

            var char = String.fromCharCode(code);

            // if the character is non-digit
            // OR
            // if the value already contains 15/16 digits and there is no selection
            // -> return false (the character is not inserted)

            if (/\D/.test(char) || (this.selectionStart === this.selectionEnd &&
            this.value.replace(/\D/g, '').length >=
            (/^\D*3[47]/.test(this.value) ? 15 : 16))) // 15 digits if Amex
            {
                return false;
            }
            format_and_pos(char);
        }
    });

    // backspace doesn't fire the keypress event
    input.addEventListener('keydown', function(e)
    {
        if (e.keyCode === 8 || e.keyCode === 46) // backspace or delete
        {
            e.preventDefault();
            format_and_pos('', this.selectionStart === this.selectionEnd);
        }
    });

    input.addEventListener('paste', function()
    {
        // A timeout is needed to get the new value pasted
        setTimeout(function(){ format_and_pos(''); }, 50);
    });

    input.addEventListener('blur', function()
    {
    	// reformat onblur just in case (optional)
        format_and_pos(this, false);
    });
};

input_credit_card(document.getElementById('cardNumber'));


//For Date formatted input
        var expDate = document.getElementById('cardExpiry');
        expDate.onkeyup = function (e) {

          var inputChar = String.fromCharCode(event.keyCode);
    var code = event.keyCode;
    var allowedKeys = [8];
    if (allowedKeys.indexOf(code) !== -1) {
      return;
    }

    event.target.value = event.target.value.replace(
      /^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
    ).replace(
      /^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
    ).replace(
      /^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
    ).replace(
      /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
    ).replace(
      /^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
    ).replace(
      /[^\d \/]|^[\/ ]*$/g, '' // To allow only digits and `/`
    ).replace(
      /\/\//g, '/' // Prevent entering more than 1 `/`
    );
  }
    </script>
</body>
</html>
