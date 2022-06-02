@component('mail::message')
# Thank You!

Dear {{ $customer['name'] }}

Your order has been placed, below is your receipt detail.

Your order number is: {{ $customer['order_no'] }}

@component('mail::table')
@if(isset($usercart) && !empty($usercart))
@php $total = 0; @endphp
| Product               | Size   | Color    | Quantity           | Price           |
| --------------------- | :----: | :------: | :----------------: | --------------: |
@foreach($usercart as $cart)
    @php $total += $cart->price*$cart->quantity @endphp
| {{ $cart->product_name }} | {{ $cart->size }} | {{ $cart->color_name }} | ${{ $cart->price }} x {{ $cart->quantity }} | ${{ $cart->quantity*$cart->price }}.00 |
@endforeach
| &nbsp;   | &nbsp;   | &nbsp;   | <b>Item Total</b> | <b>${{ number_format( $customer['cart_amount'], 2 ) }} </b> |
| &nbsp;   | &nbsp;   | &nbsp;   | Shipping Charges | ${{ number_format( $customer['shipping_rates'], 2 ) }}  |
| &nbsp;   | &nbsp;   | &nbsp;   | Sales Tax | ${{ number_format( $customer['sales_tax_rate'], 2 ) }}  |
| &nbsp;   | &nbsp;   | &nbsp;   | <b>Grand Total</b> | <b>${{ number_format( $customer['total_amount'], 2 ) }} </b> |
@endif
@endcomponent

@component('mail::button', ['url' => ''])
    Track Your Order
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent