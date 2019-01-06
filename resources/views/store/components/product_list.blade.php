<li class="product list-view">
    <div class="media">
        <div class="media-left">
            <a href="/product/{{ $product->id }}">
                <img class="wp-post-image" data-echo="{{ $product->photo }}" src="assets/images/blank.gif" alt="">
            </a>
        </div>
        <div class="media-body media-middle">
            <div class="row">
                <div class="col-xs-12">
                    <span class="loop-product-categories"><a rel="tag" href="{{ $product->category->id }}">{{ $product->category->title }}</a></span><a href="/product/{{ $product->id }}"><h3>{{ $product->name }}</h3>
                        <div class="product-short-description">
                            <ul style="padding-left: 18px;">
                                @foreach (explode(',', $product->advantages) as $item)
                                    <li>{{ $item }}</li>   
                                @endforeach
                            </ul>

                            <span>کد محصول : <strong>{{ $product->code }}</strong></span>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12">

                    <div class="availability in-stock">موجودی : <span>موجود است</span></div>

                    <span class="price">
                        <span class="electro-price">
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
                        </span>
                    </span>
                    <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">افزودن به سبد</a>
                    <div class="hover-area">
                        <div class="action-buttons">
                            <div class="clear"></div>
                            <a data-product_id="2706" class="add-to-compare-link" href="#"> افزودن برای مقایسه </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>