<section class="section-product-cards-carousel animate-in-view fadeIn animated" data-animation="fadeIn">

    <header>

        <h2 class="h1">محبوب ترین محصولات</h2>

        <ul class="nav nav-inline">

            <li class="nav-item active"><span class="nav-link">{{ $top_products->count() }} محصول برتر</span></li>

            @php $group_name = ''; $i = 0 @endphp
            @foreach ($top_products as $item)
                @continue( !$item->category || $group_name == $item->product->category->title || $i > 5)
                <li class="nav-item"><a class="nav-link" href="/category/{{ $item->product->category->id }}">{{ $item->product->category->title }}</a></li>
                @php $group_name = $item->product->category->title; ++$i @endphp
            @endforeach
        </ul>
    </header>

    <div id="home-v1-product-cards-careousel">
        <div class="woocommerce columns-3 home-v1-product-cards-carousel product-cards-carousel owl-carousel">

            @foreach ($top_products->chunk(6) as $chunk)
                <ul class="products columns-3">
                    @php $i = 1 @endphp
                    @foreach ($chunk as $item)
                        @productCard([
                            'product' => $item->product,
                            'variation' => $item,
                            'dollar_cost' => $options['dollar_cost'],
                            'i' => $i++,
                        ])@endproductCard
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div><!-- #home-v1-product-cards-careousel -->

</section>