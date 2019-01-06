@extends('store.layout.master')

@section('body-class', 'page home page-template-default')

@section('style')
    <style>
        .color_label {
            background: #ea1b25;
            border-radius: 10px;
            padding: 2px 10px;
            color: #fff;
            text-shadow: 0px 0px 5px #000;
        }

        select {
            background: #fff;
            border-radius: 5px;
            outline: none;
            padding: 5px 10px;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $('.btn-num-product-up').click(function ()
        {
            if ( $(this).prev().val() >= $(this).attr('max') ) {
                event.stopPropagation();
                return;
            }
            $(this).prev().val( ( $(this).prev().val() * 1 ) + 1 );

            var price = $(this).parent().parent().prev().find('.num-comma').text();
            var total = $(this).parent().parent().next().find('.num-comma');
            price = price.replace(/,/g, '') * 1;
            var output = numeral(total.text().replace(/,/g, '') * 1 + price).format('0,0');
            total.text(output);
            
            total = $('.sub-total');
            output = numeral(total.text().replace(/,/g, '') * 1 + price).format('0,0');
            total.text(output);
            
            total = $('.final-total');
            output = numeral(total.text().replace(/,/g, '') * 1 + price).format('0,0');
            total.text(output);
        });

        $('.btn-num-product-down').click(function ()
        {
            if ($(this).next().val() <= 1) {
                event.stopPropagation();
                return;
            }
            $(this).next().val( ( $(this).next().val() * 1 ) - 1 );
            var price = $(this).parent().parent().prev().find('.num-comma').text();
            var total = $(this).parent().parent().next().find('.num-comma');
            
            price = price.replace(/,/g, '') * 1;
            var output = numeral(total.text().replace(/,/g, '') * 1 - price).format('0,0');
            total.text(output);
            
            total = $('.sub-total');
            output = numeral(total.text().replace(/,/g, '') * 1 - price).format('0,0');
            total.text(output);
            
            total = $('.final-total');
            output = numeral(total.text().replace(/,/g, '') * 1 - price).format('0,0');
            total.text(output);
        });

        var cost = 0;

        $('.shipping_cost').click(function () {
            var method =$(this).val();
            var cost_temp = $('option[value="'+method+'"]').attr('cost');
            cost = cost_temp;
        });

        $('.shipping_cost').change(function () {
            var method =$(this).val();
            var cost_temp = $('option[value="'+method+'"]').attr('cost');

            var total = $('.final-total');
            var output = numeral(total.text().replace(/,/g, '') * 1 + (cost_temp - cost)).format('0,0');
            total.text(output);
        });
    </script>
@endsection

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav class="woocommerce-breadcrumb"><a href="/">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>سبد خرید</nav>

            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <article class="page type-page status-publish hentry">
                        <header class="entry-header"><h1 itemprop="name" class="entry-title">سبد خرید شما</h1></header><!-- .entry-header -->

                        <form action="/checkout" method="POST">

                            <table class="shop_table shop_table_responsive cart">
                                <thead>
                                    <tr>
                                        {{-- <th class="product-remove">&nbsp;</th> --}}
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">نام محصول</th>
                                        <th class="product-color">رنگ</th>
                                        <th class="product-warranty">گارانتی</th>
                                        <th class="product-price">قیمت</th>
                                        <th class="product-quantity">تعداد</th>
                                        <th class="product-subtotal">مجموع</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                        $offer = 0;
                                        $items = isset( $cart_products->items ) ? $cart_products->items : $cart_products;
                                    @endphp
                                
                                    @if ( $items )
                                        @foreach ($items as $item)
                                            <tr class="cart_item">
                                                @php
                                                    $variation = isset( $item->variation ) ? $item->variation : $item;   
                                                @endphp
                                                {{-- <td class="product-remove">
                                                    <form action="/cart/remove/{{ $variation->id }}" method="POST">
                                                        <input type="submit" title="حذف از سبد" class="remove" value="×" style="width: 20px;height: 20px;padding: 0px" />
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </td> --}}

                                                <td class="product-thumbnail">
                                                    <a href="/product/{{ $variation->product->id }}"><img width="180" height="180" src="{{ $variation->product->photo }}" alt=""></a>
                                                </td>

                                                <td data-title="Product" class="product-name">
                                                    <a href="/product/{{ $variation->product->id }}">{{ $variation->product->name }}</a>
                                                </td>

                                                <td data-title="Price" class="product-color">
                                                    <span class="color_label" style="background: {{ $variation->color->value }}">
                                                        {{ $variation->color->name }}
                                                    </span>
                                                </td>
                                                
                                                <td data-title="Price" class="product-warranty">
                                                    {{ $variation->warranty->name }}
                                                </td>

                                                <td data-title="Price" class="product-price">
                                                    @php
                                                        $price = $variation->price;

                                                        if ($variation->offer && $variation->deadline->gt(now()))
                                                        {
                                                            $offer += $variation->unit
                                                                    ? $price - $variation->offer
                                                                    : ($price - $variation->offer) * $options['dollar_cost'];
                                                            $price = $variation->offer;
                                                        }

                                                        if ($variation->unit)
                                                        {
                                                            $price *= $options['dollar_cost'];
                                                        }
                                                    @endphp
                                                    <span class="amount"><span class="num-comma">{{ $price }}</span> تومان</span>
                                                </td>

                                                <td data-title="Quantity" class="product-quantity">
                                                    <div class="quantity buttons_added">
                                                        <input type="button" class="minus btn-num-product-down" value="-">
                                                        <input type="number" size="4" dir="ltr" class="input-text qty text" title="Qty" value="{{ $item->count }}" name="cart[{{ $item->id }}]" />
                                                        <input type="button" max="{{ $variation->stock_inventory }}" class="plus btn-num-product-up" value="+">
                                                    </div>
                                                </td>

                                                <td data-title="Total" class="product-subtotal">
                                                    <span class="amount"><span class="num-comma">{{ $item->count * $price }}</span> تومان</span>
                                                </td>
                                                @php $total += $item->count * $price @endphp
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">
                                                <div class="alert alert-danger">
                                                    متاسفانه سبد خرید شما در حال حاضر خالی است :(
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="8">
                                            <div class="cart-collaterals" style="padding-top: 0px">

                                                <div class="cart_totals ">

                                                    <h2>فاکتور سفارش شما</h2>

                                                    <table class="shop_table shop_table_responsive">

                                                        <tbody>
                                                            <tr class="cart-subtotal">
                                                                <th>جمع فاکتور</th>
                                                                <td data-title="Subtotal"><span class="amount"><span class="num-comma sub-total">@auth{{ $cart_products->total }}@else{{ $total }}@endauth</span> تومان</span></td>
                                                            </tr>


                                                            <tr class="shipping">
                                                                <th>هزینه ارسال</th>
                                                                <td data-title="Shipping">
                                                                    <select name="shipping_type" class="shipping_type">
                                                                        @foreach($options['shipping_cost'] as $key => $item)
                                                                            <option value="{{ $key }}" @auth @if( $cart_products->shipping_type == $key ) selected="selected" @endif @endauth cost="{{ $item->cost }}">{{ $item->name . ' - '. $item->cost.' تومان'}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr class="order-offer">
                                                                <th>تخفیف فاکتور</th>
                                                                <td data-title="Total"><strong><span class="amount"><span class="num-comma">@auth{{ $cart_products->offer }}@else{{ $offer }}@endauth</span> تومان </span></strong> </td>
                                                            </tr>

                                                            <tr class="order-total">
                                                                <th>جمع نهایی</th>
                                                                <td data-title="Total"><strong><span class="amount"><span class="num-comma final-total">@auth{{ $cart_products->total - $cart_products->offer + $cart_products->shipping_cost }}@else{{ $total + $options['shipping_cost']->model1->cost }}@endauth</span> تومان </span></strong> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <div class="wc-proceed-to-checkout">

                                                        <a class="checkout-button button alt wc-forward" href="checkout.html">Proceed to Checkout</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="actions" colspan="8">
                                            <div class="coupon">
                                                @auth
                                                    <label for="coupon_code">کد تخفیف :</label>
                                                    <input type="text" placeholder="اگر کد تخفیف دارید وارد کنید" @isset($cart_products->discount_code) value="{{ $cart_products->discount_code->code }}" @endisset id="coupon_code" class="input-text" />
                                                    <input type="button" onclick="window.location = '/cart/discount_code/' + this.previousElementSibling.value" value="اعمال کد تخفیف" name="apply_coupon" style="top: 3px" class="button">
                                                @else
                                                    <span class="pull-right">اگر کد تخفیف دارید, جهت اعمال کد تخفیف ابتدا وارد حساب خود شوید<span>
                                                @endauth
                                            </div>

                                            <a href="/cart" type="submit" name="update_cart" class="button">بروز رسانی سبد خرید</a>

                                            <div class="wc-proceed-to-checkout">
                                                <button type="submit" class="checkout-button button alt wc-forward">تکمیل پرداخت</button>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            @csrf
                        </form>
                        
                    </article>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .container -->
    </div><!-- #content -->
@endsection