<div class="nav-search">
    <div class="input-bg temporary-hidden">
        <input type="text" placeholder="Search" />
    </div>
    <a class="hvr-pulse basket" href="{{ url('/cart') }}"></a>
    <span>ITEM: <i class="item-badge">@php echo Cart::getTotalQuantity() @endphp</i></span>
    <span>VIEW CART.</span>
</div>
