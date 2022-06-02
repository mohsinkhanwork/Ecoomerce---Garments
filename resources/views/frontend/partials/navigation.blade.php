<div class="nav-container">

    <div class="nav-inner">

        <div class="home-button-mobile">
            <a href="{{ url('/') }}">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
        </div>

        <div class="search-button-mobile temporary-hidden">
            <a href="javascript:;" class="search-open">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>
        </div>

        <div class="cart-button-mobile temporary-moved">
            <a href="{{ url('/cart') }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <div class="cart-badge temporary-moved">@php echo Cart::getTotalQuantity() @endphp</div>
            </a>
        </div>

        <button class="c-hamburger c-hamburger--htla burger">
            <span>toggle menu</span>
        </button>

        @include('frontend.partials.nav-search')

        @include('frontend.partials.nav')

    </div>

</div>
