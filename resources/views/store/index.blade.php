@extends('store.layout.master')

@section('body-class', 'page home page-template-default')

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    @component('store.components.slider', [ 'slider' => $options['slider'] ]) @endcomponent
                    
                    @component('store.components.offers', [ 'offers' => $offers, 'options' => $options ]) @endcomponent

                    @component('store.components.favorites', [ 'top_products' => $top_products, 'options' => $options ]) @endcomponent

                    @component('store.components.latest', [ 'products' => $products, 'options' => $options ]) @endcomponent
                </main><!-- #main -->
            </div><!-- #primary -->

        </div><!-- .container -->
    </div><!-- #content -->
@endsection