<div class="row">
    <div class="col-sm-12">
        <h5>Detail</h5>
    </div>
    <div class="col-sm-6">
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <th>Order ID</th>
                    <td> {{ $order->id }} </td>
                </tr>
                <tr>
                    <th>Payment Charge ID</th>
                    <td> {!! $order->brand == 'PayPal' ? '<small><em>not stripe transection</em></small>' : $order->payment_charge_id !!} </td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td> {{ ucfirst( $order->payment_status ) }} </td>
                </tr>
                <tr>
                    <th>Order Status</th>
                    <td>@php
                        switch ($order->order_status) {
                            case 1:
                                echo 'Pending';
                                break;

                            case 2:
                                echo 'In Process';
                                break;

                            case 3:
                                echo 'Dispatched';
                                break;

                            case 4:
                                echo 'Cancelled';
                                break;
                            default:
                                echo 'Pending';
                                break;
                        }
                    @endphp</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td> {{ $order->description }} </td>
                </tr>
                <tr>
                    <th>Created</th>
                    <td> {{ $order->created_at }} </td>
                </tr>
                <tr>
                    <th>Updated</th>
                    <td> {{ $order->updated_at }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <th>Currency</th>
                    <td> {{ strtoupper($order->currency) }} </td>
                </tr>
                <tr>
                    <th>Paid With</th>
                    <td> {{ $order->brand }} </td>
                </tr>
                <tr>
                    <th>Cart Amount</th>
                    <td> ${{ number_format($order->cart_amount, 2) }} </td>
                </tr>
                <tr>
                    <th>Sales Tax</th>
                    <td> ${{ number_format($order->sales_tax_rate, 2) }} ({{ number_format(($order->sales_tax_rate/$order->cart_amount)*100, 2) }}%) </td>
                </tr>
                @if($order->promocode_applied_text !== NULL && $order->promocode_discount_amount != 0)
                <tr>
                    <th>PromoCode Discount</th>
                    <td> -${{ number_format($order->promocode_discount_amount, 2) }} ({{ $order->promocode_applied_text }}) </td>
                </tr>
                @endif
                <tr>
                    <th>Shipping Total</th>
                    <td> ${{ number_format($order->shipping_rates, 2) }} </td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td> ${{ number_format($order->total_amount, 2) }} </td>
                </tr>
                <tr>
                    <th>Paid Amount</th>
                    <td> ${{ number_format($order->paid_amount, 2) }} </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h5>Products</h5>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @if( $order_details )
                    @foreach ( $order_details as $detail )
                        <tr>
                            <td> {{ $detail->product_id }} </td>
                            <td> {{ $detail->product->product_name }} </td>
                            <td> {{ $detail->product->color_image->find( $detail->color_id )->color_name }} </td>
                            <td>@php
                                switch( $detail->product->attributes->find( $detail->attribute_id )->size ) {
                                    case 's':
                                        echo 'Small';
                                        break;
                                    case 'm':
                                        echo 'Medium';
                                        break;
                                    case 'l':
                                        echo 'Large';
                                        break;
                                    case 'xl':
                                        echo 'Extra Large';
                                        break;
                                    case '2xl':
                                        echo '2 Extra Large';
                                        break;
                                    case '3xl':
                                        echo '3 Extra Large';
                                        break;
                                    case '4xl':
                                        echo '4 Extra Large';
                                        break;
                                }
                            @endphp</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>${{ number_format( $detail->product->attributes->find( $detail->attribute_id )->price, 2 ) }}</td>
                        </tr>
                    @endforeach
                @else
                    <p class="text-center"><em>no product data found.</em></p>
                @endif
            </tbody>
        </table>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <h5>Billing Address</h5>
        @if( $customer )
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <th>Full Name</th>
                    <td>{{ $customer->billing_fullname }}</td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td>{{ $customer->billing_email }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $customer->billing_address }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $customer->billing_city }}</td>
                </tr>
                <tr>
                    <th>State</th>
                    <td>{{ $customer->billing_state }}</td>
                </tr>
                <tr>
                    <th>State</th>
                    <td>{{ $customer->billing_zip }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $customer->billing_country ? $customer->billing_country : $order->country }}</td>
                </tr>
            </tbody>
        </table>
        @else
            <p class="text-left"><em>no billing address found.</em></p>
        @endif
    </div>
    <div class="col-sm-6">
        <h5>Shipping Address</h5>
        @if( $customer )
            @if( $customer->same_address == 'Yes' )
                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $customer->billing_fullname }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $customer->billing_email }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $customer->billing_address }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $customer->billing_city }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $customer->billing_state }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $customer->billing_zip }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $customer->billing_country ? $customer->billing_country : $order->country }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $customer->shipping_fullname }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $customer->shipping_email }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $customer->shipping_address }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $customer->shipping_city }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $customer->shipping_state }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $customer->shipping_zip }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $customer->shipping_country ? $customer->shipping_country : $order->country }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @else
            <p class="text-left"><em>no shipping address found.</em></p>
        @endif
    </div>
</div>
