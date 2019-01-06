<li>
    <a href="/product/{{ $product->id }}" title="{{ $product->name }}">
        <img class="wp-post-image" data-echo="{{ $product->photo }}" src="/assets/images/blank.gif" alt="{{ $product->name }}">
        <span class="product-title">{{ $product->name }}</span>
    </a>
    <span class="electro-price">
        @if ( $variation)
            @php
                if ($variation->unit)
                {
                    $variation->offer *= $dollar_cost;
                    $variation->price *= $dollar_cost;
                }
            @endphp
            @if ($variation->offer && $variation->deadline->gt(now()))
                <ins><span class="amount"><span class="num-comma">{{ $variation->offer }}</span> تومان</span></ins>
                <del><span class="amount"><span class="num-comma">{{ $variation->price }}</span> تومان</span></del>
            @else
                <span class="amount"><span class="num-comma">{{ $variation->price }}</span> تومان</span>
            @endif
        @endif
    </span>
</li>