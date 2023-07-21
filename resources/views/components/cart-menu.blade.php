<div>
    <div class="cart-items">
        <a href="{{ route('front.cart.index') }}" class="main-btn">
            <i class="lni lni-cart"></i>
            <span class="total-items">{{ count($items) }}</span>
        </a>
        <!-- Shopping Item -->
        <div class="shopping-item">
            <div class="dropdown-cart-header">
                <span>{{ $items->count() }}</span>
                <a href="{{ route('front.cart.index') }}">View Cart</a>
            </div>
            <ul class="shopping-list">
                @forelse ($items as $item )
                <li>
                    <a href="j" class="remove" title="Remove this item"><i
                            class="lni lni-close"></i></a>
                    <div class="cart-img-head">
                        <a class="cart-img" href="{{ route('front.products.show',$item->product->slug) }}"><img
                                src="{{ $item->product->image_url }}" alt="#"></a>
                    </div>
                    <div class="content">
                        <h4><a href="{{ route('front.products.show',$item->product->slug) }}">{{ $item->product->name }}</a></h4>
                        <p class="quantity"> Quantity:{{ $item->quantity }} <span class="amount">
                           Price: {{ Currency::format($item->product->price) }}
                        </span>
                        </p>
                    </div>
                </li>                    
                @empty
                    <div>No Carts Yet</div>
                @endforelse

            </ul>
            <div class="bottom">
                <div class="total">
                    <span>Total</span>
                    <span class="total-amount">{{ Currency::format($total) }}</span>
                </div>
                <div class="button">
                    <a href="{{ route('front.checkout.form') }}" class="btn animate">Checkout</a>
                </div>
            </div>
        </div>
        <!--/ End Shopping Item -->
    </div>
</div>
