@extends('store.layout.master')

@section('body-class', 'single-product')

@section('style')
    <style>
    .advantages ul, .disadvantages ul {
        list-style-type: none;
        padding: 0px;
    }
    .advantages li, .disadvantages li {
        margin-bottom: 10px;
    }
    .advantages .alert, .disadvantages .alert {
        margin-bottom: 10px;
        padding: 5px 10px !important;
    }
    .advantages .alert {
        background: linear-gradient(to bottom right, #5cb85c, #17ac17);
        color: #f9fff7;
    }
    .disadvantages .alert {
        background: linear-gradient(to bottom right, #ea1b25, #cb434a);
        color: #ffefef;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">   
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
    
    $(".rateYo").rateYo({
        ratedFill: "#E74C3C",
        rtl: true,
        rating: 3,
        fullStar: true,
        onChange: function (rating) {
            $(this).next().val(rating);
        }
    });
    </script>
@endsection

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav class="woocommerce-breadcrumb">
                <a href="home.html">خانه</a>
                @foreach ($breadcrumb as $item)
                    <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                    <a href="/category/{{ $item->id }}">{{ $item->title }}</a>
                @endforeach
                <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                {{ $product->name }}
            </nav><!-- /.woocommerce-breadcrumb -->

            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <div class="product">
                        @component('store.components.product_single', [ 'product' => $product, 'options' => $options ])@endcomponent

                        <div class="woocommerce-tabs wc-tabs-wrapper">
                            <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">
                                {{-- <li class="nav-item accessories_tab">
                                    <a href="#tab-accessories" data-toggle="tab">لوازم جانبی</a>
                                </li> --}}

                                <li class="nav-item description_tab">
                                    <a href="#tab-description" data-toggle="tab">توضیحات کلی</a>
                                </li>

                                <li class="nav-item specification_tab">
                                    <a href="#tab-specification" class="active" data-toggle="tab">مشخصات فنی</a>
                                </li>

                                <li class="nav-item reviews_tab">
                                    <a href="#tab-reviews" data-toggle="tab">نظرات کاربران</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                {{-- @component('store.components.product_accessories')@endcomponent --}}

                                @component('store.components.product_description', [ 'product' => $product ])@endcomponent

                                @component('store.components.product_specifications', [ 'spec' => $product->spec ])@endcomponent
                                
                                @component('store.components.product_reviews', [ 'reviews' => $product->reviews, 'product_id' => $product->id ])@endcomponent
                            </div>
                        </div><!-- /.woocommerce-tabs -->
                        
                        <div class="related products">
                            <h2>محصولات مشابه</h2>

                            <ul class="products columns-5">
                                @foreach ($relateds as $item)
                                    @productCard([
                                        'product' => $item,
                                        'variation' => $item->variation,
                                        'dollar_cost' => $options['dollar_cost']
                                    ])@endproductCard
                                @endforeach
                            </ul><!-- /.products -->
                        </div><!-- /.related -->
                    </div>
                </main><!-- /.site-main -->
            </div><!-- /.content-area -->

            <div id="sidebar" class="sidebar" role="complementary">
                <aside id="woocommerce_products-2" class="widget woocommerce widget_products">
                    <h3 class="widget-title">جدید ترین محصولات</h3>
                    <ul class="product_list_widget">
                        @foreach ($products->take(20) as $item)
                            <li>
                                <a href="/product/{{ $item->id }}" title="Tablet Thin EliteBook  Revolve 810 G6">
                                    <img class="wp-post-image" data-echo="{{ $item->photo }}" src="assets/images/blank.gif" alt="{{ $item->name }}">
                                    <span class="product-title">{{ $item->name }}</span>
                                </a>
                                <span class="electro-price" style="margin-right: 115px;margin-left: 15px">
                                    @if ($item->variation->offer && $item->variation->deadline->gt(now()))
                                        <ins><span class="amount"><span class="num-comma">{{ $item->variation->offer }}</span> تومان</span></ins>
                                        <del><span class="amount"><span class="num-comma">{{ $item->variation->price }}</span> تومان</span></del>
                                    @else
                                        <span class="amount"><span class="num-comma">{{ $item->variation->price }}</span> تومان</span>
                                    @endif                                            
                                </span>
                            </li>
                        @endforeach
                    </ul><!-- .product_list_widget -->
                </aside><!-- .widget -->
            </div><!-- /.sidebar-shop -->

        </div><!-- .col-full -->
    </div><!-- #content -->
@endsection