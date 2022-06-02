<div class="addtocart-screen" id="cart-screen" @if(!isset($scart) || empty($scart)) style="height: 250px;" @endif>
    <div class="addtocart-screen-scroll">
        <div class="fixed-header">
            <div class="col-md-8 col-xs-8">
                <div class="cart-shiping">
                    <img src="{{ asset('frontend/assets/images/cart-shiping.png') }}" alt="cart">
                </div>
            </div>
            <div class="col-md-3 col-xs-3 col-xs-offset-1 col-md-offset-1">
                <div class="close-cart-shiping">
                    <img src="{{ asset('frontend/assets/images/close-cart.png') }}" alt="cart">
                </div>
            </div>
            <hr>
        </div>

        @php $total = 0; @endphp
        @if(isset($scart) && !empty($scart))
            @foreach($scart as $item)
                @php $total += $item->price*$item->quantity @endphp
                <div class="floating-cart-item col-md-12 col-xs-12 @if($loop->first) first-item-in @endif">
                    <div class="row">
                        <div class="col-md-10 col-xs-10">
                            <h4 class="title-incart">{{$item->name}}</h4>
                        </div>
                        <div class="col-md-2 col-xs-2 text-right">
                            <a class="cart-remove cart-remove-item" href="javascript:void(0);" data-cartid="{{ $item->id }}">X</a>
                        </div>
                        <div class="col-md-8 col-xs-8 incart-container">
                            <img src="{{ '/img/products/drop/'.$item->attributes->attribute_color_image }}" alt="item-in-cart">
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <div class="detail-incart">
                                <div class="details">
                                  <h5>
                                  @php $sizes = ['1' => 'One Size', 's' => 'Small', 'm' => 'Medium', 'l' => 'Large', 'xl' => 'Extra Large', '2xl' => '2 Extra Large', '3xl' => '3 Extra Large', '4xl' => '4 Extra Large']; @endphp

                                  @if( $item->attributes->has('attribute_color_name') )
                                    {{  $item->attributes->attribute_color_name }}
                                  @endif

                                  </h5>
                                  <h5>
                                    @if( $item->attributes->has('attribute_name') )
                                      {{  $sizes[$item->attributes->attribute_name] }}
                                    @endif
                                    </h5>
                                    <h5> Quantity:  {{ $item->quantity }} </h5>
                                    <h3>Total Price: ${{ number_format($item->price*$item->quantity, 2) }}</h3>
                                </div>
                            </div>
                            {{--<form method="post" action="">
                                <div class="cart-buttons-cont">
                                    <div class="dec button-cart">-</div>
                                    <input type="text" name="french-hens" id="quantity" value="{{ $item->quantity }}" disabled>
                                    <div class="inc button-cart">+</div>
                                </div>
                            </form>--}}
                        </div>

                    </div>
                </div>
            @endforeach

        @else
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    <div style="text-align: center; margin-top: 115px;">
                        <span class="empty-cart-placeholder">Your cart is empty!</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-12 col-xs-12 checkout-subtotal" @if(!isset($scart) || empty($scart)) style="display: none;" @endif>
            <div class="row">
                <hr>
                <div class="col-md-4 col-xs-4 in-subtotal">
                    <h2>SUBTOTAL</h2>
                </div>
                <div class="col-md-6 col-xs-6 pull-right text-right incart-total">
                    <h3>$ {{ number_format($total, 2) }}</h3>
                </div>
                <div class="col-md-12 col-xs-12">
                    <p>Shipping and taxes calculated at checkout</p>
                </div>
                <div class="col-md-12 col-xs-12 checkout-img hvr-forward">
                    <a href="{{ route('checkout') }}">
                        <img src="{{ asset('frontend/assets/images/check-out-shipping.png') }}" alt="checkout">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
