@extends('store.layout.master')

@section('body-class', 'page home page-template-default')

@section('content')

    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
            <nav class="woocommerce-breadcrumb">
                <a href="home.html">خانه</a>
                @foreach (array_reverse( $breadcrumb ) as $item)
                    @continue( $loop->last )
                    <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                    <a href="/category/{{ $item->id }}">{{ $item->title }}</a>
                @endforeach
                <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                {{ $category->title }}
            </nav><!-- /.woocommerce-breadcrumb -->

            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <section>
                        <header>
                            <h2 class="h1">زیرگروه های {{ $category->title }}</h2>
                        </header>

                        <div class="woocommerce columns-4">
                            <ul class="product-loop-categories">

                                @forelse ($category->childs as $item)
                                    <li class="product-category product">
                                        <a href="/category/{{ $item->id }}">
                                            <img src="{{ $item->avatar }}" class="img-responsive" alt="{{ $item->description }}">
                                            <h3>{{ $item->title }}</h3>
                                        </a>
                                    </li><!-- /.item -->
                                @empty
                                    <div class="alert alert-danger">این گروه شامل هیچ زیر گروهی نیست :(</div>
                                @endforelse
                            </ul>
                        </div>
                    </section>

                    <section class="section-products-carousel" >

                        <header>

                            <h2 class="h1">محصولات این دسته بندی</h2>

                            <div class="owl-nav">
                                <a href="#products-carousel-next" data-target="#product-category-carousel" class="slider-next"><i class="fa fa-angle-right"></i></a>
                                <a href="#products-carousel-prev" data-target="#product-category-carousel" class="slider-prev"><i class="fa fa-angle-left"></i></a>
                            </div>

                        </header>

                        <div id="product-category-carousel">
                            <div class="woocommerce columns-6">

                                <div class="products owl-carousel products-carousel columns-6">
                                    @foreach ($category_pros as $item)
                                        @productCard([
                                            'product' => $item,
                                            'variation' => $item->variation,
                                            'options' => $options,
                                            'tag_name' => 'div'
                                        ])@endproductCard
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </section><!-- /.section-products-carousel -->
                </main><!-- /.site-main -->
            </div><!-- /.content-area -->
        </div>
    </div>
@endsection