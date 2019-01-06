@php if ( !isset($tag_name) ) $tag_name = 'li' @endphp

<{{ $tag_name }} class="product @isset($i) @if($i % 3 == 1) first @elseif($i % 3 == 0) last @endif @endisset">
    <div class="product-outer">
        <div class="product-inner">
            @if ( $product->category )
                <span class="loop-product-categories"><a href="/category/{{ $product->category->id }}" rel="tag">{{ $product->category->title }}</a></span>
            @endif
            <a href="/product/{{ $product->id }}">
                <h3>
                    {{ $product->name }}
                    @if($product->label)
                        
                        @switch($product->label)
                            @case(1) <span class="label label-danger">توقف تولید</span> @break
                            @case(2) <span class="label label-primary">به زودی</span> @break                            
                            @case(3) <span class="label label-warning">نا موجود</span> @break                            
                            @case(4) <span class="label label-info">عدم فروش</span> @break                            
                        @endswitch
                    @elseif($variation && $variation->stock_inventory == 0) 
                        
                        <span class="label label-warning">نا موجود</span> 
                    @endif
                </h3>
                <div class="product-thumbnail">
                    <img src="/assets/images/blank.gif" data-echo="{{ $product->photo }}" class="img-responsive" alt="{{ $product->name }}" />
                </div>
            </a>
            
            <div class="price-add-to-cart">
                @if ( $variation )
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
                    @if( $variation->stock_inventory !== 0 && !$product->label)
                        <a rel="nofollow" href="/cart/add/{{ $variation->id }}?quantity=1" class="button add_to_cart_button">افزودن به سبد</a>
                    @endif
                @endif
            </div><!-- /.price-add-to-cart -->

            <div class="hover-area">
                <div class="action-buttons">
                    <a href="/compare/add/{{ $product->id }}" class="add-to-compare-link added"> افزودن برای مقایسه </a>
                </div>
            </div>

        </div><!-- /.product-inner -->
    </div><!-- /.product-outer -->
</{{ $tag_name }}><!-- /.products -->