
<section class="home-v1-recently-viewed-products-carousel section-products-carousel animate-in-view fadeIn animated" data-animation="fadeIn">
    <header>
        <h2 class="h1">جدیدترین محصولات</h2>
        <div class="owl-nav">
            <a href="#products-carousel-next" data-target="#recently-added-products-carousel" class="slider-next"><i class="fa fa-angle-right"></i></a>
            <a href="#products-carousel-prev" data-target="#recently-added-products-carousel" class="slider-prev"><i class="fa fa-angle-left"></i></a>
        </div>
    </header>

    <div id="recently-added-products-carousel">
        <div class="woocommerce columns-6">
            <div class="products owl-carousel recently-added-products products-carousel columns-6">
                @foreach ($products as $item)
                    @productCard([
                        'product' => $item,
                        'variation' => $item->variation,
                        'dollar_cost' => $options['dollar_cost'],
                        'tag_name' => 'div',
                    ])@endproductCard
                @endforeach
            </div>
        </div>
    </div>
</section>