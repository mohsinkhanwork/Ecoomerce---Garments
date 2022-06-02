<?php

namespace App\Http\Controllers;

use App\User;
use App\Customer;
use App\Order;
use App\Product;
use App\OrdersDetail;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderMailable;
use App\TaxRate;
use App\PromoCode;
use App\WebsiteSetting;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use App\Cart;
use Illuminate\Support\Carbon;
use Cart as SCart;
use Shippo;
use Shippo_Address;
use Shippo_Shipment;
use Shippo_Transaction;
use TaxJar\Client as TaxJarClient;

use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

class CheckoutController extends Controller
{

    public function __construct()
    {
        if( env('SHIPPO_MODE') == 'test' ) {
            Shippo::setApiKey(env('SHIPPO_PRIVATE_TEST'));
        }
        else {
            Shippo::setApiKey(env('SHIPPO_PRIVATE_LIVE'));
        }

    }

    public function getCartData($order_id){

      $cart_content = SCart::getContent();

      $data = [];

      foreach ($cart_content as $item) {


        $data['items'][] =
            [
                'name' => $item->name,
                'price' => (float)$item->price,
                'qty' => (int)$item->quantity
            ];

      }




      $data['invoice_id'] = $order_id;
      $data['invoice_description'] = "#{$data['invoice_id']} Invoice";
      $data['return_url'] = route('checkout.success.paypal');
      $data['cancel_url'] = route('checkout');

      $subtotal = 0;
      foreach($data['items'] as $item) {
          $subtotal += $item['price']*$item['qty'];
      }

      $data['subtotal'] = $subtotal;
      $data['shipping'] = 0;
      $data['tax'] = 0;
      $data['shipping_discount'] = 0;

      foreach(SCart::getConditions() as $condition){

        if($condition->getType() == 'shipping'){
          $data['shipping'] = round($condition->getCalculatedValue($subtotal), 2);
        }

        if($condition->getType() == 'tax'){
          $data['tax'] = round($condition->getCalculatedValue($subtotal), 2);

        }

        if($condition->getType() == 'promo'){
          $data['shipping_discount'] = round($condition->getCalculatedValue($subtotal), 2);
        }

      }

      $data['total'] = $data['subtotal'] + $data['tax'] + $data['shipping'];
      return $data;
    }

  public function checkoutPaypal($order_id){

    $provider = new ExpressCheckout;      // To use express checkout.

$options = [
  'BRANDNAME' => 'URBAN ENIGMA',
  'LOGOIMG' => url('/frontend/assets/images/about-logo.png'),
  'CHANNELTYPE' => 'Merchant'
];

$data = $this->getCartData($order_id);

$response = $provider->addOptions($options)->setExpressCheckout($data);
// This will redirect user to PayPal
//dd($response['paypal_link']);
return $response['paypal_link'];

  }


  /* PAYPAL CHECOUT */

  public function paypalSaveOrder( Request $request ) {

      if( $request->price && is_array( $request->price ) ) {
          $total_amount = 0;
          foreach( $request->price as $price ) {
              $total_amount += $price;
          }
      }

      $cart_content = SCart::getContent();

      $data = [];
      $subtotal = 0;
      foreach ($cart_content as $item) {
        $subtotal += (float)$item->price*(int)$item->quantity;
      }

      $data['shipping'] = 0;
      $data['tax'] = 0;
      $data['shipping_discount'] = 0;

      foreach(SCart::getConditions() as $condition){

        if($condition->getType() == 'shipping'){
          $data['shipping'] = round($condition->getCalculatedValue($subtotal), 2);
          $attributes = $condition->getAttributes();

          $data['object_id'] = $attributes['object_id'];
          $data['provider'] = $attributes['provider'];
          $data['amount'] = $attributes['amount'];
        }

        if($condition->getType() == 'tax'){
          $data['tax'] = round($condition->getCalculatedValue($subtotal), 2);

        }

        if($condition->getType() == 'promo'){
          $data['shipping_discount'] = round($condition->getCalculatedValue($subtotal), 2);
        }

      }

      $charge = [
          'id' => '',
          'status' => 'pending',
          'description' => 'Paid with PayPal.',
          'currency' => 'USD',
          'shipping_rates' => $data['shipping'],
          'sales_tax_rate' => $data['tax'],
          'cart_amount' => $request->cart_amount,
          'total_amount' => $request->total_amount,
          'amount' => ($request->total_amount - $data['shipping_discount'])  * 100,
          'source' => [
              'brand' => 'PayPal',
              'country' => $request->shipping_country
          ]
      ];



      $order = $this->__saveOrder( $request->all(), $charge );
      $hash_data = base64_encode(
                      json_encode(
                          array_merge(
                              ['order_id' => $order->id],
                              ['attributes' => $request->attribute_id],
                              ['colors' => $request->color_id],
                              ['products' => $request->product_id],
                              ['quantity' => $request->quantity],
                              ['provider' => $request->shipping_provider],
                              ['object_id' => $request->shipping_object_id]
                          )
                      )
                  );
                  //$this->checkoutPaypal($order->id);
      return response()->json(['id' => $order->id, 'hash_data' => $hash_data], 200, []);
  }

  public function paypalSaveOrderNew() {

      $cart_content = SCart::getContent();

      $data = [];
      $subtotal = 0;
      foreach ($cart_content as $item) {
        $subtotal += (float)$item->price*(int)$item->quantity;
      }

      $data['shipping'] = 0;
      $data['tax'] = 0;
      $data['shipping_discount'] = 0;

      foreach(SCart::getConditions() as $condition){

        if($condition->getType() == 'shipping'){
          $data['shipping'] = round($condition->getCalculatedValue($subtotal), 2);
          $attributes = $condition->getAttributes();

          $data['object_id'] = $attributes['object_id'];
          $data['provider'] = $attributes['provider'];
          $data['amount'] = $attributes['amount'];
        }

        if($condition->getType() == 'tax'){
          $data['tax'] = round($condition->getCalculatedValue($subtotal), 2);

        }

        if($condition->getType() == 'promo'){
          $data['shipping_discount'] = round($condition->getCalculatedValue($subtotal), 2);
        }

      }

      $charge = [
          'id' => '',
          'status' => 'pending',
          'description' => 'Paid with PayPal.',
          'currency' => 'USD',
          'shipping_rates' => $data['shipping'],
          'sales_tax_rate' => $data['tax'],
          'cart_amount' => $request->cart_amount,
          'total_amount' => $request->total_amount,
          'amount' => ($request->total_amount - $data['shipping_discount']) * 100,
          'source' => [
              'brand' => 'PayPal',
              'country' => $request->shipping_country
          ]
      ];



      $order = $this->__saveOrder( $request->all(), $charge );
      $hash_data = base64_encode(
                      json_encode(
                          array_merge(
                              ['order_id' => $order->id],
                              ['attributes' => $request->attribute_id],
                              ['colors' => $request->color_id],
                              ['products' => $request->product_id],
                              ['quantity' => $request->quantity],
                              ['provider' => $request->shipping_provider],
                              ['object_id' => $request->shipping_object_id]
                          )
                      )
                  );
                  //$this->checkoutPaypal($order->id);
      return response()->json(['id' => $order->id, 'hash_data' => $hash_data], 200, []);
  }

  public function checkoutPaypalDemo()
  {
    $provider = new ExpressCheckout;      // To use express checkout.

    $options = [
      'BRANDNAME' => 'Urban Enigma',
      'LOGOIMG' => url('/frontend/assets/images/about-logo.png'),
      'CHANNELTYPE' => 'Merchant',
	  'SOLUTIONTYPE' => 'Sole'
  ];

  $data = [];
  $data['items'] = [
      [
          'name' => 'Product 1',
          'price' => 9.99,
          'qty' => 1
      ],
      [
          'name' => 'Product 2',
          'price' => 4.99,
          'qty' => 2
      ]
  ];

  $data['invoice_id'] = 12354;
  $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
  $data['return_url'] = url('/payment/success');
  $data['cancel_url'] = url('/cart/checkout');

  $subtotal = 0;
  foreach($data['items'] as $item) {
      $subtotal += $item['price']*$item['qty'];
  }
  //give a discount of 10% of the order amount
  $data['tax'] = 27.25;
  $data['shipping'] = 16.25;

  $data['subtotal'] = $subtotal;
  $data['total'] = $subtotal+ $data['tax'] + $data['shipping'];


  $data['shipping_discount'] = round((10 / 100) * $subtotal, 2);

  $response = $provider->addOptions($options)->setExpressCheckout($data);

  //dd($response['paypal_link']);
    // This will redirect user to PayPal
  return redirect($response['paypal_link']);

  }

/**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
		$cartCount = SCart::getTotalQuantity();

		if((!$request->PayerID || !$request->token) || $cartCount <= 0){
			return redirect()->route('index');
		}
		$provider = new ExpressCheckout;      // To use express checkout.

        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        // Verify Express Checkout Token
        $response = $provider->getExpressCheckoutDetails($token);

          if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {


            $data = $this->getCartData($response['INVNUM']);

          $data['invoice_id'] = $response['INVNUM'];
          $data['invoice_description'] = "#{$data['invoice_id']} Invoice";


                // Perform transaction on PayPal
                $payment_status = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

                if($payment_status['ACK'] == "Success"){


                  $request_data = Session::get('address_data');

                  $charge = [
                      'id' => $payment_status['PAYMENTINFO_0_TRANSACTIONID'],
                      'status' => 'succeeded',
                      'description' => 'Paid with PayPal.',
                      'currency' => 'USD',
                      'shipping_rates' => $data['shipping'],
                      'sales_tax_rate' => $data['tax'],
                      'cart_amount' => $data['subtotal'],
                      'total_amount' => $data['subtotal'] + $data['shipping'] + $data['tax'],
                      'promocode_discount_amount' => $data['shipping_discount'],
                      'promocode_applied_text' => NULL,
                      'amount' => ($payment_status['PAYMENTINFO_0_AMT']-$data['shipping_discount']) * 100,
                      'source' => [
                          'brand' => 'PayPal',
                          'country' => (isset($request_data['billing_country']))?$request_data['billing_country']:$request_data['shipping_country']
                      ]
                  ];



                  $order = $this->__saveOrder( $request_data, $charge );



                  $cart_content = SCart::getContent();

                  $data = [];
                  $subtotal = 0;
                  foreach ($cart_content as $item) {
                    $subtotal += (float)$item->price*(int)$item->quantity;
                  }



                  $data['shipping'] = 0;
                  $data['tax'] = 0;
                  $data['shipping_discount'] = 0;
                  $data['promo_code_text'] = NULL;

                  foreach(SCart::getConditions() as $condition){

                    if($condition->getType() == 'shipping'){
                      $data['shipping'] = round($condition->getCalculatedValue($subtotal), 2);

                      $attributes = $condition->getAttributes();
                      $data['object_id'] = $attributes['object_id'];
                      $data['provider'] = $attributes['provider'];
                      $data['amount'] = $attributes['amount'];

                    }

                    if($condition->getType() == 'tax'){
                      $data['tax'] = round($condition->getCalculatedValue($subtotal), 2);



                    }

                    if($condition->getType() == 'promo'){
                      $data['shipping_discount'] = round($condition->getCalculatedValue($subtotal), 2);
                      $attributes = $condition->getAttributes();
                      $data['promo_code_text'] = $attributes['promo_code_text'];
                    }

                  }

                  $order = Order::find( $order->id );
                  if( $order ) {

                      $order->shippo_provider = $data['provider'];
                      $order->shippo_object_id = $data['object_id'];
                      $order->promocode_discount_amount = $data['shipping_discount'];
                      $order->promocode_applied_text = $data['promo_code_text'];
                      $order->session_id = Session::getId();
                      $order->save();


                      $this->__emailOrder( $order );
                  }

                  SCart::clear();
				  SCart::clearCartConditions();

              Session::put('session_id', '');
              return view('frontend.pages.thankyou');


                }elseif($payment_status['ACK'] == "SuccessWithWarning"){

					SCart::clear();
					SCart::clearCartConditions();

              Session::put('session_id', '');
              return view('frontend.pages.thankyou');
			  }else {

                  $payment_status = 'Cancelled';
                  $status_id = 4;

                  $orderArray = array(
              'type' => $response['L_SEVERITYCODE0'],
              'short_message' => $response['L_SHORTMESSAGE0'],
              'long_message' => $response['L_LONGMESSAGE0']
              );

                  return view('frontend.pages.fail_payment',compact('order_array'));


                }


        }else {

          $payment_status = 'Cancelled';
          $status_id = 4;


          $orderArray = array(
      'type' => $response['L_SEVERITYCODE0'],
      'short_message' => $response['L_SHORTMESSAGE0'],
      'long_message' => $response['L_LONGMESSAGE0']
      );


      \Session::put(['order_array' => $orderArray]);

      return view('frontend.pages.fail_payment',compact('order_array'));



        }

    }

    public function paypalUpdateOrderStatus(Request $request, $status, $hash_data) {
        $json = base64_decode($hash_data);
        $data = json_decode($json, true);

        if($hash_data) {
            switch ($status) {
                case 'success':
                $payment_status = 'Succeeded';

                    if( is_array($data) && $data['products'] ) {
                        foreach ($data['products'] as $key => $val) {
                            DB::table('products_attributes_color')
                                ->where([
                                    'attribute_id' => $data['attributes'][$key],
                                    'color_id' => $data['colors'][$key]
                                ])->decrement('color_stock', $data['quantity'][$key]);
                        }
                    }
                    // $this->__createShippoTransection(  $data['object_id'] );
                    $status_id = 2;
                    break;
                case 'cancel':
                default:
                    $payment_status = 'Cancelled';
                    $status_id = 4;
                    break;
            }

            $order = Order::find( $data['order_id'] );
            if( $order ) {
                $order->payment_status = $payment_status;
                $order->order_status = $status_id;
                $order->shippo_provider = $data['provider'];
                $order->shippo_object_id = $data['object_id'];
                $order->order_status = $status_id;
                $order->session_id = Session::getId();
                $order->save();

                $this->__emailOrder( $order );
            }
        }
        Session::put('session_id', '');
        return view('frontend.pages.thankyou');
    }



    /*
    |--------------------------------------------------------------------------
    |                               View Checkout Method
    |--------------------------------------------------------------------------
    */
    public function viewCheckout()
    {


        $session_id = Session::get('session_id');

        if(isset($session_id) && !empty($session_id)) {

            $cartCount = Cart::where('session_id', $session_id)->count();
            if( $cartCount <= 0 ) {
                return redirect('/cart');
            }
            $shipping_states = $billing_states = false;
            $validShippingAddr = $ratesObj = $salesTax = false;
            $customer = false;
            if( Auth::Check() ) {
                $customer = Auth::User()->customer;
                if( $customer ) {
                    $cartTotal = DB::table('products_attributes')
                                    ->join('cart', 'products_attributes.id', '=', 'cart.attribute_id')
                                    ->where('cart.session_id', $session_id)
                                    ->sum('products_attributes.price');
                    if( $cartTotal < 275 ) {
                        $validShippingAddr = $this->validateAddress( false, $customer );
                        $ratesObj = $this->getShippoRates( false, $customer );
                    }
                    $shipping_country = \App\Country::where('code', $customer->shipping_country)->first();
                    $billing_country = \App\Country::where('code', $customer->billing_country)->first();
                    if( $shipping_country ) {
                        $shipping_states = \App\State::where('country_id', $shipping_country->id)->orderBy('name', 'asc')->get();
                    }
                    if( $billing_country ) {
                        $billing_states = \App\State::where('country_id', $billing_country->id)->orderBy('name', 'asc')->get();
                    }
                    $request = new Request;
                    $salesTax = $this->getSalesTaxRates( $request, $customer );
                }
            }

            if( !$shipping_states || $shipping_states->count() <= 0 ) {
                $shipping_states = \App\State::where('country_id', 231)->orderBy('name', 'asc')->get();
            }
            if( !$billing_states || $billing_states->count() <= 0 ) {
                $billing_states = \App\State::where('country_id', 231)->orderBy('name', 'asc')->get();
            }

            $countries = \App\Country::orderBy('name', 'asc')->get();
            return view('frontend.pages.checkout', compact('customer', 'validShippingAddr', 'ratesObj', 'salesTax', 'countries', 'shipping_states', 'billing_states'));

        } else {
            return redirect('/cart');
        }
    }
    public function viewCheckoutNew()
    {


        $session_id = Session::get('session_id');
        if(isset($session_id) && !empty($session_id)) {
            $cartCount = SCart::getTotalQuantity();
            if( $cartCount <= 0 ) {
                return redirect('/cart');
            }
            $shipping_states = $billing_states = false;
            $customer = false;

            if( Auth::Check() ) {
                $customer = Auth::User()->customer;
                if( $customer ) {
                    $shipping_country = \App\Country::where('code', $customer->shipping_country)->first();
                    $billing_country = \App\Country::where('code', $customer->billing_country)->first();
                    if( $shipping_country ) {
                        $shipping_states = \App\State::where('country_id', $shipping_country->id)->orderBy('name', 'asc')->get();
                    }
                    if( $billing_country ) {
                        $billing_states = \App\State::where('country_id', $billing_country->id)->orderBy('name', 'asc')->get();
                    }

                }
            }

            if( !$shipping_states || $shipping_states->count() <= 0 ) {
                $shipping_states = \App\State::where('country_id', 231)->orderBy('name', 'asc')->get();
            }
            if( !$billing_states || $billing_states->count() <= 0 ) {
                $billing_states = \App\State::where('country_id', 231)->orderBy('name', 'asc')->get();
            }

            $countries = \App\Country::orderBy('name', 'asc')->get();
            return view('frontend.pages.checkout-new', compact('customer', 'countries', 'shipping_states', 'billing_states'));

        } else {
            return redirect('/cart');
        }
    }
    /******************** ./View Checkout Method ********************/

    public function getAddress( $request, $customer, $type ) {
      $name = WebsiteSetting::where('key','shipping_from_name')->get()->first();
      $company = WebsiteSetting::where('key','shipping_from_company')->get()->first();
      $street1 = WebsiteSetting::where('key','shipping_from_street1')->get()->first();
      $city = WebsiteSetting::where('key','shipping_from_city')->get()->first();
      $state = WebsiteSetting::where('key','shipping_from_state')->get()->first();
      $zip = WebsiteSetting::where('key','shipping_from_zip')->get()->first();
      $country = WebsiteSetting::where('key','shipping_from_country')->get()->first();
      $phone = WebsiteSetting::where('key','shipping_from_phone')->get()->first();
      $email = WebsiteSetting::where('key','shipping_from_email')->get()->first();

        $fromAddress = [
            'object_purpose' => 'PURCHASE',
            'name' => $name->value,
            'company' => $company->value,
            'street1' => $street1->value,
            'city' => $city->value,
            'state' => $state->value,
            'zip' => $zip->value,
            'country' => $country->value,
            'phone' => $phone->value,
            'email' => $email->value
        ];
        $toAddress = false;
        if( $request ) {
            $toAddress['object_purpose'] = 'PURCHASE';
            if( ! empty( $request->name ) ) {
                $toAddress['name'] = 'name';
            }
            if( ! empty( $request->company ) ) {
                $toAddress['company'] = $request->company;
            }
            if( ! empty( $request->street1 ) ) {
                $toAddress['street1'] = $request->street1;
            }
            if( ! empty( $request->street2 ) ) {
                $toAddress['street2'] = $request->street2;
            }
            if( ! empty( $request->city ) ) {
                $toAddress['city'] = $request->city;
            }
            if( ! empty( $request->state ) ) {
                $toAddress['state'] = $request->state;
            }
            if( ! empty( $request->country ) ) {
                $toAddress['country'] = $request->country;
            }
            if( ! empty( $request->zip ) ) {
                $toAddress['zip'] = $request->zip;
            }
            if( ! empty( $request->phone ) ) {
                $toAddress['phone'] = $request->phone;
            }
            if( ! empty( $request->email ) ) {
                $toAddress['email'] = $request->email;
            }
            $toAddress['validate'] = true;
        }
        if( $customer ) {
            $toAddress = [
                'object_purpose' => 'PURCHASE',
                'name' => $customer->shipping_fullname,
                'company' => '',
                'street1' => $customer->shipping_address,
                'street2' => '',
                'city' => $customer->shipping_city,
                'state' => $customer->shipping_state,
                'zip' => $customer->shipping_zip,
                'country' => !empty( $customer->shipping_country ) ? $customer->shipping_country : 'US',
                'phone' => '',
                'email' => $customer->shipping_email,
                'validate' => true
            ];
        }

        switch( $type ) {
            case "to":
                return $toAddress;
                break;
            case "from":
                return $fromAddress;
                break;
        }
    }

    public function getParcels( $request, $customer ) {

        $session_id = Session::get('session_id');
        $cart_content = SCart::getContent();


        $lb = 0;
        $cat_names = [];
        $shirts = $hats = 0;
        if( $cart_content ) {
            foreach( $cart_content as $key => $item ) {

                $product = Product::where('id',$item->attributes->product_id)->with('category')->get()->first();
                $catData = $product->category;

                $weight = 0;
                $weight2 = 0;
                $weight_unit = 'lb';
                $weight_unit2 = 'oz';
                if( str_replace('\'', '', $catData->weight ) != '' ){
                    list( $weight, $weight_unit, $weight2, $weight_unit2 ) = explode( '_', $catData->weight );
                }
                $lb += ($weight_unit == 'kg' ? $weight * 2.2046 : $weight);
                $lb += $weight2 * 0.0625;

                $cat_name = $catData->name;
                $filtercat = $catData->filter_cat;
                if( $catData->parent_id != 0 ) {
                    $category = \App\Category::find($catData->parent_id);
                    if( $category ) {
                        $cat_name = $category->name;
                        $filtercat = $category->filter_cat;
                    }
                }

                /* if( strpos( strtolower($cat_name), 'shirt' ) !== FALSE ) {
                    $shirts++;
                } */
                /* if( strpos( strtolower($cat_name), 'cap' ) !== FALSE ) {
                    $caps++;
                } */
                if( $filtercat == 'hats' ) {
                    $hats++;
                }
                else {
                    $shirts++;
                }
            }
        }

        if( $shirts <= 3 && $hats <= 0 ) {
            $parcels[] = [
                'length'=> round('10', 2),
                'width'=> round('13', 2),
                'height'=> round('0.25', 2),
                'distance_unit'=> 'in',
                'weight'=> round($lb, 2),
                'mass_unit'=> 'lb',
            ];
        }
        else {
            $parcels[] = [
                'length'=> round('9.5', 2),
                'width'=> round('9.5', 2),
                'height'=> round('8', 2),
                'distance_unit'=> 'in',
                'weight'=> round($lb, 2),
                'mass_unit'=> 'lb',
            ];
        }

        return $parcels;
    }

    /**
     * Validate an address through Shippo service
     *
     * @param User $user
     * @return Shippo_Adress
     */
    public function validateAddress( $request, $customer )
    {
        try {
          return Shippo_Address::create($this->getAddress( $request, $customer, 'to' ) );
        }
        catch( \Exception $e ) {
            return $e;
            // return false;
        }
    }

    /**
     * Create a Shippo shipping rates
     *
     * @param User $user
     * @param Product $product
     * @return Shippo_Shipment
     */
    public function getShippoRates( $request, $customer )
    {
        try {
            return Shippo_Shipment::create([
                'object_purpose'=> 'PURCHASE',
                'address_from'=> $this->getAddress( $request, $customer, 'from' ),
                'address_to'=> $this->getAddress( $request, $customer, 'to' ),
                'parcels'=> $this->getParcels( $request, $customer ),
                'async'=> false
            ]);
        }
        catch( \Exception $e ) {
            return $e;
            // return false;
        }
    }

    public function addShippingRatesToCart( Request $request ) {

      $unique_shipping_rates = Session::get('unique_shipping_rates');

      if(is_array($unique_shipping_rates)){

        foreach ($unique_shipping_rates as $key => $value) {
          if($value['object_id'] == $request->shipping_object_id){

            $shippingCharge = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Shipping Charges',
                'type' => 'shipping',
                'target' => 'subtotal',
                'value' => '+'.$value['amount'],
                'attributes' => array( // attributes field is optional
                	'object_id' => $value['object_id'],
                	'provider' => $value['provider'],
                	'amount' => $value['amount']
                )
            ));

            SCart::condition($shippingCharge);

          }
        }


        $condition = SCart::getCondition('Promo Code Discount');

        if($condition){

          $attributes = $condition->getAttributes();

          if($attributes['type'] == "shipping"){
            $discount = $this->calculateShippingDiscount($attributes['discount_type'],$attributes['discount_amount']);

            $cartCondition2 = new \Darryldecode\Cart\CartCondition([
                'name' => 'Promo Code Discount',
                'type' => 'promo',
                'target' => 'total',
                'value' => $discount,
                'attributes' => array(
                    'description' => 'Promocode Applied.',
                    'discount_type' => $attributes['discount_type'],
                    'type' => $attributes['type'],
                    'discount_amount' => $attributes['discount_amount'],
                    'promo_code_name' => $attributes['promo_code_name'],
                    'promo_code_text' => $attributes['promo_code_text']
                )
            ]);

            SCart::condition($cartCondition2);

          }

        }

        $data = $this->getCartData("101");

        return response()->json(['total' => $data['total'], 'subtotal' => $data['subtotal'], 'shipping' => $data['shipping'], 'tax' => $data['tax'],'discount' => $data['shipping_discount']], 200 );


      }else {
        return response()->json(['error' => 'somethin wrong.'], 400 );
      }


    }
    public function getShippingRatesFromShippo( Request $request ) {


        if( $request->ajax() ) {
            $uniqueShippingRates = array();
            if( $request->total >= 275 ) {
              $shippingCharge = new \Darryldecode\Cart\CartCondition(array(
                  'name' => 'Shipping Charges',
                  'type' => 'shipping',
                  'target' => 'subtotal',
                  'value' => '+0',
                  'attributes' => array( // attributes field is optional
                  	'object_id' => 'free_shipping_rates',
                  	'provider' => '',
                  	'amount' => 0
                  )
              ));

              SCart::condition($shippingCharge);
                return response()->json( 'Free Shipping', 200 );
            }

            $validShippingAddr = $this->validateAddress( $request, false );



            if( $validShippingAddr instanceof \Exception ) {
                $return_response = [];
                $message = json_decode( $validShippingAddr->getMessage(), true );

                if( isset( $message['__all__'] ) ) {
                    $return_response = $message['__all__'];
                }
                elseif( isset($message['detail']) ) {
                    $return_response[] = $message['detail'];
                }

                return response()->json( $return_response , 400);
            }
            if( !$validShippingAddr->is_complete ) {
                $errors = [];
                foreach( $validShippingAddr->validation_results['messages'] as $message ) {
                    $errors[] = $message['text'];
                }
                return response()->json( $errors, 400);
            }

            $ratesObj = $this->getShippoRates( $request, false );

            if( $ratesObj instanceof \Exception ) {
                $exceptions = json_decode( $ratesObj->getMessage(), true );
                $errors = [];
                if( $exceptions && is_array( $exceptions ) ){
                    foreach( $exceptions as $key => $exception ) {
                        if( $exception && is_array( $exception ) ) {
                            foreach( $exception as $types ){
                                if( $types && is_array( $types ) ) {
                                    foreach( $types as $type => $message) {
                                        $errors[] = ucfirst($type) . ': ' . implode( '<br>', $message );
                                    }
                                }
                            }
                        }
                    }
                }

                return response()->json( $errors, 400);
            }

            $shippingRates = $uniqueShippingRates = [];
            foreach( $ratesObj->rates as $key => $rate ) {
                //if( $request->country != 'US' && $rate->provider == 'USPS' ) {
                //    continue;
              //  }
                $shippingRates[$key]['object_id'] = $rate->object_id;
                $shippingRates[$key]['provider'] = $rate->provider;
                $shippingRates[$key]['amount'] = $rate->amount;
            }
            usort($shippingRates, function($a, $b) {
                return $a['amount'] - $b['amount'];
            });
            /* usort($shippingRates, function($a, $b) {
                return strcasecmp($a['provider'], $b['provider']);
            }); */

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

            Session::put('unique_shipping_rates', $uniqueShippingRates);

            return response()->json( $uniqueShippingRates, 200 );
        }
    }
    public function getShippingRatesFromShippoNew( Request $request ) {


        if( $request->ajax() ) {


          $cart_content = SCart::getContent();

          if(count($cart_content) == 0  ){
            return response()->json( "Your cart is empty!" , 420);
          }

          $subtotal = 0;
          foreach ($cart_content as $item) {
            $subtotal += (float)$item->price*(int)$item->quantity;
          }

          $state = \App\State::where('code', $request->state)->first();
          $country = \App\Country::where('code', $request->country)->first();
          if( $country && $state ) {
              $taxRate = TaxRate::where('status', 1)->where('state_id', $state->id)->where('country_id', $country->id)->first();
              if( $taxRate ) {
                $rate = $taxRate->rate;
              }else {
                $rate = 0;
              }

          $condition = new \Darryldecode\Cart\CartCondition(array(
          'name' => 'Sales Tax',
          'type' => 'tax',
          'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
          'value' => $rate.'%',
          'attributes' => array( // attributes field is optional
            'description' => 'Sales Tax '.$rate.'%',
            'state_id' => $state->id,
            'country_id' => $country->id
          )
        ));

        SCart::condition($condition);

        }

        $isValidFreeShipping = false;
        $enable_free_shipping = WebsiteSetting::where('key','enable_free_shipping')->get()->first();
        $free_shipping_from = WebsiteSetting::where('key','free_shipping_from')->get()->first();
        $free_shipping_to = WebsiteSetting::where('key','free_shipping_to')->get()->first();
        $free_shipping_cart_amount = WebsiteSetting::where('key','free_shipping_cart_amount')->get()->first();

        $now = Carbon::now();
        $from = Carbon::parse($free_shipping_from->value);
        $to = Carbon::parse($free_shipping_to->value);

        $checkExpiration = $now->between($from, $to);

        if ($enable_free_shipping->value == "yes" && $checkExpiration) {
            $isValidFreeShipping = true;
        }

        $shippingRates = $uniqueShippingRates = [];

            if( $subtotal >= $free_shipping_cart_amount->value || $isValidFreeShipping) {
              $shippingCharge = new \Darryldecode\Cart\CartCondition(array(
                  'name' => 'Shipping Charges',
                  'type' => 'shipping',
                  'target' => 'subtotal',
                  'value' => '+0',
                  'attributes' => array( // attributes field is optional
                  	'object_id' => 'free_shipping_rates',
                  	'provider' => '',
                  	'amount' => 0
                  )
              ));

              SCart::condition($shippingCharge);
              Session::put('unique_shipping_rates', $uniqueShippingRates);
                return response()->json( 'Free Shipping', 200 );
            }

            $validShippingAddr = $this->validateAddress( $request, false );



            if( $validShippingAddr instanceof \Exception ) {
                $return_response = [];
                $message = json_decode( $validShippingAddr->getMessage(), true );

                if( isset( $message['__all__'] ) ) {
                    $return_response = $message['__all__'];
                }
                elseif( isset($message['detail']) ) {
                    $return_response[] = $message['detail'];
                }

                return response()->json( $return_response , 400);
            }
            if( !$validShippingAddr->is_complete ) {
                $errors = [];
                foreach( $validShippingAddr->validation_results['messages'] as $message ) {
                    $errors[] = $message['text'];
                }
                return response()->json( $errors, 400);
            }

            $ratesObj = $this->getShippoRates( $request, false );

            //print_r($ratesObj);die;

            if( $ratesObj instanceof \Exception ) {
                $exceptions = json_decode( $ratesObj->getMessage(), true );
                $errors = [];
                if( $exceptions && is_array( $exceptions ) ){
                    foreach( $exceptions as $key => $exception ) {
                        if( $exception && is_array( $exception ) ) {
                            foreach( $exception as $types ){
                                if( $types && is_array( $types ) ) {
                                    foreach( $types as $type => $message) {
                                        $errors[] = ucfirst($type) . ': ' . implode( '<br>', $message );
                                    }
                                }
                            }
                        }
                    }
                }

                return response()->json( $errors, 400);
            }


            foreach( $ratesObj->rates as $key => $rate ) {
                //if( $request->country != 'US' && $rate->provider == 'USPS' ) {
                //    continue;
              //  }
                $shippingRates[$key]['object_id'] = $rate->object_id;
                $shippingRates[$key]['provider'] = $rate->provider;
                $shippingRates[$key]['amount'] = $rate->amount;
            }
            usort($shippingRates, function($a, $b) {
                return $a['amount'] - $b['amount'];
            });
            /* usort($shippingRates, function($a, $b) {
                return strcasecmp($a['provider'], $b['provider']);
            }); */

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
            Session::put('unique_shipping_rates', $uniqueShippingRates);
            return response()->json( $uniqueShippingRates, 200 );
        }
    }

    public function getSalesTaxRates( Request $request, $customer = false ) {
        if( $request && $request->ajax() ) {
            $state = \App\State::where('code', $request->state)->first();
            $country = \App\Country::where('code', $request->country)->first();
            if( $country && $state ) {
                $taxRate = TaxRate::where('status', 1)->where('state_id', $state->id)->where('country_id', $country->id)->first();
                if( $taxRate ) {
                  $condition = new \Darryldecode\Cart\CartCondition(array(
                  'name' => 'Sales Tax',
                  'type' => 'tax',
                  'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                  'value' => $taxRate->rate.'%',
                  'attributes' => array( // attributes field is optional
                    'description' => 'Sales Tax '.$taxRate->rate.'%',
                    'state_id' => $state->id,
                    'country_id' => $country->id
                  )
                ));

                SCart::condition($condition);
                    return response()->json( $taxRate->rate, 200 );
                }
            }
            return response()->json(0, 200);
        }
        else {
            $state = \App\State::where('code', $customer->shipping_state)->first();
            $country = \App\Country::where('code', $customer->shipping_country)->first();
            if( $country && $state ) {
                $taxRate = TaxRate::where('status', 1)->where('state_id', $state->id)->where('country_id', $country->id)->first();
                if( $taxRate ) {
                    return $taxRate->rate;
                }
            }
            return 0;
        }
    }

    public function getStatesByCountryCode( Request $request ) {
        if( $request->ajax() ) {
            $country = \App\Country::where('code', $request->country_code)->select('id')->first();
            $states = false;
            if( $country ) {
                $states = \App\State::where('country_id', $country->id)->get();
            }
            return response()->json( $states, 200 );
        }
    }

    /*
    |--------------------------------------------------------------------------
    |                               Pay Checkout Method
    |--------------------------------------------------------------------------
    */
    public function payCheckout(Request $request)
    {
        if (isset($request) && $request->isMethod('post')) {
            $request->validate([
                'cardNumber' => 'required|max:20',
                'cardExpiry' => 'required|max:7',
                'cardCVC' => 'required|max:4',
                //'amount' => 'required',
            ]);

            $stripe = Stripe::make(env('STRIPE_SECRET'));

            try {

                $raw_expiry = explode('/', $request->get('cardExpiry'));
                $ccExpiryMonth = $raw_expiry[0];
                $ccExpiryYear = $raw_expiry[1];

                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('cardNumber'),
                        'exp_month' => $ccExpiryMonth,
                        'exp_year' => $ccExpiryYear,
                        'cvc' => $request->get('cardCVC'),
                    ],
                ]);

                if (!isset($token['id'])) {
                    return redirect()->route('checkout');
                }
                $amount = SCart::getTotal();
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $amount,
                    'description' => 'Add in wallet',
                ]);

                if ($charge['status'] == 'succeeded') {
                    $data = $request->all();

                    //$is_registered  = User::all()->contains('email', $data['billing_email']);;

                    $charge['shipping_rates'] = $request->shipping_rates;
                    $charge['sales_tax_rate'] = $request->sales_tax_rate;
                    $charge['cart_amount'] = $request->cart_amount;
                    $charge['total_amount'] = $request->total_amount;

                    $order = $this->__saveOrder( $data, $charge );
                    // $this->__createShippoTransection( $request->shipping_object_id );

                    if ($order) {



                        $cart_content = SCart::getContent();

                        $data = [];
                        $subtotal = 0;
                        foreach ($cart_content as $item) {
                          $subtotal += (float)$item->price*(int)$item->quantity;
                        }



                        $data['shipping'] = 0;
                        $data['tax'] = 0;
                        $data['shipping_discount'] = 0;

                        foreach(SCart::getConditions() as $condition){

                          if($condition->getType() == 'shipping'){
                            $data['shipping'] = round($condition->getCalculatedValue($subtotal), 2);

                            $attributes = $condition->getAttributes();
                            $data['object_id'] = $attributes['object_id'];
                            $data['provider'] = $attributes['provider'];
                            $data['amount'] = $attributes['amount'];

                          }

                          if($condition->getType() == 'tax'){
                            $data['tax'] = round($condition->getCalculatedValue($subtotal), 2);



                          }

                          if($condition->getType() == 'promo'){
                            $data['shipping_discount'] = round($condition->getCalculatedValue($subtotal), 2);
                          }

                        }



                        $order = Order::find( $order->id );
                        if( $order ) {
                            $order->shippo_provider = $data['provider'];
                            $order->shippo_object_id = $data['object_id'];
                            $order->save();

                        }


                        $this->__emailOrder( $order );
                        SCart::clear();
						SCart::clearCartConditions();

                        Session::put('session_id', '');
                        return view('frontend.pages.thankyou');

                    } else {
                        Session::put('error', 'Something missing in order details!!');
                        return redirect()->route('checkout');
                    }

                } else {
                    Session::put('error', 'Money not add in wallet!!');
                    return redirect()->route('checkout');
                }
            } catch (Exception $e) {
                Session::put('error', $e->getMessage());
                return redirect()->route('checkout');
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error', $e->getMessage());
                return redirect()->route('checkout');
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error', $e->getMessage());
                return redirect()->route('checkout');
            }

        } else {
            return abort(404);
        }

    }
    public function payCheckoutNew(Request $request)
    {

        $cart_content = SCart::getContent();

        if(count($cart_content) == 0  ){
          return redirect()->route('cart')->withError("Your Shopping Cart is Empty.");
        }
        $order_data = [];
        $subtotal = 0;
        foreach ($cart_content as $item) {
          $subtotal += (float)$item->price*(int)$item->quantity;
        }

        $order_data['shipping'] = 0;
        $order_data['tax'] = 0;
        $order_data['shipping_discount'] = 0;
        $order_data['promo_code_text'] = "";

        foreach(SCart::getConditions() as $condition){

          if($condition->getType() == 'shipping'){
            $order_data['shipping'] = round($condition->getCalculatedValue($subtotal), 2);

            $attributes = $condition->getAttributes();
            $order_data['object_id'] = $attributes['object_id'];
            $order_data['provider'] = $attributes['provider'];
            $order_data['amount'] = $attributes['amount'];

          }

          if($condition->getType() == 'tax'){
            $order_data['tax'] = round($condition->getCalculatedValue($subtotal), 2);
          }

          if($condition->getType() == 'promo'){
            $order_data['shipping_discount'] = round($condition->getCalculatedValue($subtotal), 2);
            $attributes = $condition->getAttributes();
            $order_data['promo_code_text'] = $attributes['promo_code_text'];
          }

        }

        $order_data['total'] = $subtotal + $order_data['tax'] + $order_data['shipping'] - $order_data['shipping_discount'];


        if (isset($request) && $request->isMethod('post') && $request->pay_with == "stripe") {
            $request->validate([
                'cardNumber' => 'required|max:20',
                'cardExpiry' => 'required|max:9',
                'cardCVC' => 'required|max:4',
                //'amount' => 'required',
            ]);

            $stripe = Stripe::make(env('STRIPE_SECRET'));

            try {

                $raw_expiry = explode('/', $request->get('cardExpiry'));
                $ccExpiryMonth = $raw_expiry[0];
                $ccExpiryYear = $raw_expiry[1];

                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('cardNumber'),
                        'exp_month' => $ccExpiryMonth,
                        'exp_year' => $ccExpiryYear,
                        'cvc' => $request->get('cardCVC'),
                    ],
                ]);

                if (!isset($token['id'])) {
                    return redirect()->route('checkout');
                }
                $amount = $order_data['total'];

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $amount,
                    'description' => 'Add in wallet',
                ]);


                if ($charge['status'] == 'succeeded') {
                    $data = $request->all();

                    //$is_registered  = User::all()->contains('email', $data['billing_email']);;

                    $charge['shipping_rates'] = $order_data['shipping'];
                    $charge['sales_tax_rate'] = $order_data['tax'];
                    $charge['cart_amount'] = $subtotal;
                    $charge['total_amount'] = $subtotal + $order_data['shipping'] + $order_data['tax'];
                    $charge['promocode_discount_amount'] = $order_data['shipping_discount'];
                    $charge['promocode_applied_text'] = $order_data['promo_code_text'];

                    $order = $this->__saveOrder( $data, $charge );
                    // $this->__createShippoTransection( $request->shipping_object_id );

                    if ($order) {

                        $order = Order::find( $order->id );
                        if( $order ) {
                            $order->shippo_provider = $order_data['provider'];
                            $order->shippo_object_id = $order_data['object_id'];
                            $order->save();

                        }


                        $this->__emailOrder( $order );

                        SCart::clear();
						            SCart::clearCartConditions();

                        Session::put('session_id', '');
                        return view('frontend.pages.thankyou');

                    } else {
                        return redirect()->route('checkout')->withError('Something missing in order details!!');
                    }

                } else {
                    return redirect()->route('checkout')->withError('Money not add in wallet!!');
                }
            } catch (Exception $e) {
                return redirect()->route('checkout')->withError($e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('checkout')->withError($e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('checkout')->withError($e->getMessage());
            }

        } elseif(isset($request) && $request->isMethod('post') && $request->pay_with == "paypal") {

          $data = $request->all();

          Session::put('address_data', $data);

          $link = $this->checkoutPaypal(Session::get('session_id'));

          return redirect()->to($link);



        }else {
            return abort(404);
        }

    }
    /******************** ./Pay Checkout Method ********************/

    private function __saveOrder( $data, $charge ) {

      //dd($charge);
        $email_check = (isset($data['billing_email']))?$data['billing_email']:$data['shipping_email'];
        $is_customer    = Customer::all()->contains('billing_email', $email_check);
        if(isset($data['usesameaddress'])){
          $data['sameaddress'] = $data['usesameaddress'];

        }
        $customer_id = null;

        if($is_customer) {
            $update_customer = Customer::where('billing_email',$email_check)->first();

            if( Auth::Check() ) {
                $update_customer->user_id = Auth::User()->id;
            }
            else {
                $update_customer->user_id = 0;
            }

            $update_customer->shipping_fullname = $data['shipping_fullname'];
            $update_customer->shipping_email = $data['shipping_email'];
            $update_customer->shipping_address = $data['shipping_address'];
            $update_customer->shipping_city = $data['shipping_city'];
            $update_customer->shipping_state = $data['shipping_state'];
            $update_customer->shipping_zip = $data['shipping_zip'];
            $update_customer->shipping_country = $data['shipping_country'];
            $update_customer->shipping_phone = (isset($data['shipping_phone']))?$data['shipping_phone']:"";


            if (!isset($data['sameaddress'])  || $data['sameaddress'] != 'on' ) {
                $update_customer->same_address = 'No';
                $update_customer->billing_fullname = $data['billing_fullname'];
                $update_customer->billing_email = $data['billing_email'];
                $update_customer->billing_address = $data['billing_address'];
                $update_customer->billing_city = $data['billing_city'];
                $update_customer->billing_state = $data['billing_state'];
                $update_customer->billing_zip = $data['billing_zip'];
                $update_customer->billing_country = $data['billing_country'];
                $update_customer->billing_phone = (isset($data['billing_phone']))?$data['billing_phone']:"";
            }
            else {
              $update_customer->billing_fullname = $data['shipping_fullname'];
              $update_customer->billing_email = $data['shipping_email'];
              $update_customer->billing_address = $data['shipping_address'];
              $update_customer->billing_city = $data['shipping_city'];
              $update_customer->billing_state = $data['shipping_state'];
              $update_customer->billing_zip = $data['shipping_zip'];
              $update_customer->billing_country = $data['shipping_country'];
              $update_customer->billing_phone = (isset($data['shipping_phone']))?$data['shipping_phone']:"";
            }
            $update_customer->save();
            $customer_id = $update_customer->id;
        }
        else {
            $new_customer = new Customer();

            if( Auth::Check() ) {
                $new_customer->user_id = Auth::User()->id;
            }
            else {
                $new_customer->user_id = 0;
            }
            $new_customer->shipping_fullname = $data['shipping_fullname'];
            $new_customer->shipping_email = $data['shipping_email'];
            $new_customer->shipping_address = $data['shipping_address'];
            $new_customer->shipping_city = $data['shipping_city'];
            $new_customer->shipping_state = $data['shipping_state'];
            $new_customer->shipping_zip = $data['shipping_zip'];
            $new_customer->shipping_country = $data['shipping_country'];
            $new_customer->shipping_phone = (isset($data['shipping_phone']))?$data['shipping_phone']:"";

            if (!isset($data['sameaddress']) || $data['sameaddress'] == 'off') {
                $new_customer->same_address = 'No';
                $new_customer->billing_fullname = $data['billing_fullname'];
                $new_customer->billing_email = $data['billing_email'];
                $new_customer->billing_address = $data['billing_address'];
                $new_customer->billing_city = $data['billing_city'];
                $new_customer->billing_state = $data['billing_state'];
                $new_customer->billing_zip = $data['billing_zip'];
                $new_customer->billing_country = $data['billing_country'];
                $new_customer->billing_phone = (isset($data['billing_phone']))?$data['billing_phone']:"";
            }
            else {
                $new_customer->same_address = 'Yes';
                $new_customer->billing_fullname = $data['shipping_fullname'];
                $new_customer->billing_email = $data['shipping_email'];
                $new_customer->billing_address = $data['shipping_address'];
                $new_customer->billing_city = $data['shipping_city'];
                $new_customer->billing_state = $data['shipping_state'];
                $new_customer->billing_zip = $data['shipping_zip'];
                $new_customer->billing_country = $data['shipping_country'];
                $new_customer->billing_phone = (isset($data['shipping_phone']))?$data['shipping_phone']:"";
            }
            $new_customer->save();
            $customer_id = $new_customer->id;
        }

        $order = new Order();
        $order->customer_id = $customer_id;
        if( $charge ) {
            $order->payment_charge_id = $charge['id'];
            $order->payment_status = $charge['status'];
            $order->description = $charge['description'];
            $order->currency = $charge['currency'];
            $order->shipping_rates = $charge['shipping_rates'];
            $order->sales_tax_rate = $charge['sales_tax_rate'];
            $order->cart_amount = $charge['cart_amount'];
            $order->total_amount = $charge['total_amount'];
            $order->promocode_discount_amount = $charge['promocode_discount_amount'];
            $order->promocode_applied_text = $charge['promocode_applied_text'];
            $order->paid_amount = $charge['amount']/100;
            $order->brand = $charge['source']['brand'];
            $order->country = $charge['source']['country'];
            $order->order_status = $charge['status'] == 'succeeded' ? '2' : '1';
        }

        $order->session_id = Session::get('session_id');
        $order->save();

        $cart_content = SCart::getContent();
        foreach ($cart_content as $item) {

          $order_detail = new OrdersDetail();
          $order_detail->order_id = $order->id;
          $order_detail->product_id = $item->attributes->product_id;
          $order_detail->attribute_id = $item->attributes->attribute_id;
          $order_detail->color_id = $item->attributes->color_id;
          $order_detail->quantity = (int)$item->quantity;
          $order_detail->price = (float)$item->price;
          $order_detail->save();

          DB::table('products_attributes_color')
              ->where([
                  'attribute_id' => $item->attributes->attribute_id,
                  'color_id' => $item->attributes->color_id
              ])->decrement('color_stock', $item->quantity);

        }


        return $order;
    }

    private function __createShippoTransection( $object_id ) {
        if( $object_id ) {
            try {
                $transection = Shippo_Transaction::create([
                    'rate' => $object_id,
                    'label_file_type' => "PDF",
                    'async' => false
                ]);
            }catch(\Exception $e) {
                return $e;
            }
        }
    }

    private function __emailOrder( $order ) {

        $customer = Customer::find( $order->customer_id );

        $email_data = [];
        $email_data['name'] = $customer->billing_fullname;
        $email_data['customer_detail'] = $customer;
        $email_data['order_detail'] = $order;
        $email_data['email'] = $customer->billing_email;
        $email_data['order_no'] = $order->id;
        $email_data['shipping_rates'] = $order->shipping_rates;
        $email_data['sales_tax_rate'] = $order->sales_tax_rate;
        $email_data['cart_amount'] = $order->cart_amount;
        $email_data['total_amount'] = $order->total_amount;

        try {
        Mail::to($customer->billing_email, $customer->billing_fullname)->send(new OrderMailable($email_data));
        } catch (Exception $e) {
        report($e);

        }


    }


    public function promoCodeRemove(Request $request)
    {
      SCart::removeCartCondition("Promo Code Discount");

      $data = $this->getCartData("101");

      return response()->json(['message'=>'Promo code has been removed.','discount_amount' => 0, 'total' => $data['total']], 200, []);
    }
    public function calculateShippingDiscount($type,$amount)
    {
      $data = $this->getCartData("101");

      if ($type == 'percentage') {

            $discount = -($data['shipping']*$amount)/100;

        } elseif ($type == 'fixed') {

            if($data['shipping'] < $amount){
              $discount = -$data['shipping'];
            }else {
              $discount = -$amount;
            }

        }

        return $discount;


    }
    public function promoCode(Request $request)
    {

      $cart_content = SCart::getContent();

      if(count($cart_content) == 0  ){
        return response()->json( "Your cart is empty!" , 400);
      }

        $data = $this->getCartData("101");

        $response = array();
        $isValid = false;
        $isValidUserSpecific = false;
        $isValidProductSpecific = false;
        $isValidExpiry = false;



        $promoCode = $request->get('promo_code');

        $promoExist = (new PromoCode())->where('promo_code', '=', $promoCode)->where('status', '=', 1)->first();



        if ($promoExist) {
            $now = Carbon::now();
            $from = Carbon::parse($promoExist->valid_from);
            $to = Carbon::parse($promoExist->valid_to);

            $checkCodeExpiration = $now->between($from, $to);



            if ($checkCodeExpiration) {
                $isValidExpiry = true;
            } else {
                return response()->json( "Promo code expired.", 400 );
            }


            if($promoExist->type == 'shipping'){

              $condition = SCart::getConditionsByType('shipping');

              if(count($condition)){
                $discount = $this->calculateShippingDiscount($promoExist->discount_type,$promoExist->discount_amount);
              }else {
                return response()->json( "Please complete the shipping step to apply this promocode.", 400 );
              }

            }else {
              if ($promoExist->discount_type == 'percentage') {
                    $discount = -$promoExist->discount_amount . '%';
                } elseif ($promoExist->discount_type == 'fixed') {

                  if($data['subtotal'] < $promoExist->discount_amount){
                    $discount = -$data['subtotal'];
                  }else {
                    $discount = -$promoExist->discount_amount;
                  }

                }
            }

                $cartCondition = new \Darryldecode\Cart\CartCondition([
                    'name' => 'Promo Code Discount',
                    'type' => 'promo',
                    'target' => 'total',
                    'value' => $discount,
                    'attributes' => array(
                        'description' => 'Promocode Applied.',
                        'discount_type' => $promoExist->discount_type,
                        'type' => $promoExist->type,
                        'discount_amount' => $promoExist->discount_amount,
                        'promo_code_name' => $promoExist->name,
                        'promo_code_text' => $promoCode
                    )
                ]);

                SCart::condition($cartCondition);

                $data = $this->getCartData("101");

                return response()->json(['message'=>'Your promo code discount has been applied.','discount_amount' => $data['shipping_discount'], 'total' => $data['total']-$data['shipping_discount'],'discount_text' => $promoExist->name], 200, []);

        }else{
            return response()->json( "Promo code is not valid!", 400 );
        }
    }





}
