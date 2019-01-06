@extends('store.layout.master')

@section('body-class', 'left-sidebar')

@section('style')
    <style>
        .pagination {
            position: relative;
            top: 15px;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .pagination:first-of-type {
            margin: 0px;
            padding: 0px;
            position: static;
        }
        .page-item.active .page-link {
            background-color: #ea1b25;
            border-color: #ac0b12;
        }
        .page-link {
            color: #b3020b;
        }
        .page-link:focus, .page-link:hover {
            color: #4d0004;
        }
        .page-item.active .page-link, .page-item.active .page-link:focus, .page-item.active .page-link:hover {
            background-color: #c40c15;
            border-color: #740308;
        }
        .color_label {
            background: #ea1b25;
            border-radius: 10px;
            padding: 2px 10px;
            color: #fff;
            text-shadow: 0px 0px 5px #000;
        }
        .filter_widget li {
            float: right;
            margin-right: 10px
        }
        input[type="checkbox"] {
            display: none;
        }
        input[type="checkbox"]:checked + label {
            color: #000;
            text-shadow: 0px 0px 5px #fff;
            padding: 2px 20px;
            box-shadow: 0px 0px 10px -2px;
        }

        label {
            transition: all 300ms;
        }
    </style>
    {{-- Ragne slider --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('script')
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        $(".js-range-slider").ionRangeSlider({
            @if( isset($data['price_from']) && $data['price_from'] ) 
            from: {{ $data['price_from'] }}, 
            @endif
            @if( isset($data['price_to']) && $data['price_to'] ) 
            to: {{ $data['price_to'] }}, 
            @endif
            type: "double",
            grid: true,
            min: 0,
            max: 10000,
            step: 100,
            prettify_enabled: true,
            prettify_separator: ",",
            prefix: "از ",
            postfix: " هزار تومان",
            decorate_both: true,
            values_separator: " تا ",
            onChange: function (data) {
                document.querySelector('input[name="price_from"]').value = data.from;
                document.querySelector('input[name="price_to"]').value = data.to;
            },
        });
    </script>
@endsection

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav class="woocommerce-breadcrumb" ><a href="home.html">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>فروشگاه</nav>

            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <section class="section-product-cards-carousel" >
                        <header>
                            <h2 class="h1">برترین محصولات</h2>
                            <div class="owl-nav">
                                <a href="#products-carousel-next" data-target="#recommended-product" class="slider-next"><i class="fa fa-angle-right"></i></a>
                                <a href="#products-carousel-prev" data-target="#recommended-product" class="slider-prev"><i class="fa fa-angle-left"></i></a>
                            </div>
                        </header>

                        <div id="recommended-product">
                            <div class="woocommerce columns-4">
                                <div class="products owl-carousel products-carousel columns-4 owl-loaded owl-drag">
                                    @foreach ($top_products as $item)
                                        @productCard([
                                            'product' => $item->product,
                                            'variation' => $item,
                                            'dollar_cost' => $options['dollar_cost'],
                                            'tag_name' => 'div'
                                        ])@endproductCard
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="shop-control-bar">
                        <ul class="shop-view-switcher nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" title="Grid View" href="#grid"><i class="fa fa-th"></i></a></li>
                            <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View" href="#list-view"><i class="fa fa-list"></i></a></li>
                        </ul>
                        <form action="/product" method="GET" class="woocommerce-ordering">
                            <select name="orderby" class="orderby" onchange="this.parentNode.submit()">
                                <option value="newest" selected='selected'>جدید ترین</option>
                                <option value="oldest" >قدیمی ترین</option>
                                <option value="most_expensive" >گرانترین</option>
                                <option value="cheapest" >ارزانترین</option>
                            </select>
                        </form>
                        <nav class="electro-advanced-pagination">
                            {{ $products->links() }}
                        </nav>
                    </div>

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">

                            <ul class="products columns-3">
                                @php $i = 1 @endphp
                                @foreach ($products as $item)
                                    @productCard([
                                        'product' => $item,
                                        'variation' => $item->variation,
                                        'dollar_cost' => $options['dollar_cost'],
                                        'i' => $i++
                                    ])@endproductCard
                                @endforeach
                            </ul>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="list-view" aria-expanded="true">
                            <ul class="products columns-3">
                                @foreach ($products as $item)
                                    @component('store.components.product_list', [
                                        'product' => $item,
                                        'variation' => $item->variation,
                                        'dollar_cost' => $options['dollar_cost']
                                    ])@endcomponent
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{ $products->links() }}
                    

                </main><!-- #main -->
            </div><!-- #primary -->

            <div id="sidebar" class="sidebar" role="complementary">
                <aside class="widget widget_electro_products_filter">
                    <h3 class="widget-title">فیلتر کردن</h3>
                    <form action="/product" method="GET">
                        <aside class="widget woocommerce widget_layered_nav">
                            <h3 class="widget-title">برند ها</h3>
                            <ul class="filter_widget">
                                @foreach ($brands as $item)
                                    <li>
                                        <input type="checkbox" id="brand_{{ $item->id }}" value="{{ $item->id }}" name="brand[]" @if( isset($data['brand']) && in_array($item->id, $data['brand'])) checked="checked" @endif />
                                        <label for="brand_{{ $item->id }}" class="color_label"> {{ $item->title }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="widget woocommerce widget_layered_nav" style="clear:both">
                            <h3 class="widget-title">رنگ ها</h3>
                            <ul class="filter_widget">
                                @foreach ($colors as $item)
                                    <li>
                                        <input type="checkbox" id="color_{{ $item->id }}" value="{{ $item->id }}" name="color[]" @if( isset($data['color']) && in_array($item->id, $data['color'])) checked="checked" @endif />
                                        <label for="color_{{ $item->id }}" class="color_label" style="background: {{ $item->value }}">{{ $item->name }}</span></label>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="widget woocommerce widget_price_filter" style="clear:both">
                            <h3 class="widget-title">قیمت</h3>
                            <div dir="ltr">
                                <input type="text" class="js-range-slider" value="" />
                                <input type="hidden" name="price_from" @isset($data['price_from']) value="{{ $data['price_from'] }}" @endisset />
                                <input type="hidden" name="price_to" @isset($data['price_to']) value="{{ $data['price_to'] }}" @endisset />
                            </div>
                            <input type="submit" value="اعمال فیلتر ها" style="margin-top: 20px">
                        </aside>
                    </form>
                </aside>
            </div>

        </div><!-- .container -->
    </div><!-- #content -->
@endsection
    