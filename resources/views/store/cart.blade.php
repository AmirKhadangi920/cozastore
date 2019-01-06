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

                        <form>

                            <table class="shop_table shop_table_responsive cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
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
                                    @php $total = 0 @endphp
                                    @foreach ($cart_products->items as $item)
                                        <tr class="cart_item">

                                            <td class="product-remove">
                                                <a class="remove" href="/cart/remove/{{ $item->variation->id }}">×</a>
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="/product/{{ $item->variation->product->id }}"><img width="180" height="180" src="{{ $item->variation->product->photo }}" alt=""></a>
                                            </td>

                                            <td data-title="Product" class="product-name">
                                                <a href="/product/{{ $item->variation->product->id }}">{{ $item->variation->product->name }}</a>
                                            </td>

                                            <td data-title="Price" class="product-color">
                                                <span class="color_label" style="background: {{ $item->variation->color->value }}">
                                                    {{ $item->variation->color->name }}
                                                </span>
                                            </td>
                                            
                                            <td data-title="Price" class="product-warranty">
                                                {{ $item->variation->warranty->name }}
                                            </td>

                                            <td data-title="Price" class="product-price">
                                                @php
                                                    $price = $item->variation->price;

                                                    if ($item->variation->offer && $item->variation->deadline->gt(now()))
                                                        $price = $item->variation->offer;

                                                    if ($item->variation->unit)
                                                        $price *= $options['dollar_cost'];
                                                @endphp
                                                <span class="amount"><span class="num-comma">{{ $price }}</span> تومان</span>
                                            </td>

                                            <td data-title="Quantity" class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="button" class="minus btn-num-product-down" value="-">
                                                    <input type="number" size="4" dir="ltr" class="input-text qty text" title="Qty" value="{{ $item->count }}" name="cart[92f54963fc39a9d87c2253186808ea61][qty]" max="29" min="0" step="1">
                                                    <input type="button" max="{{ $item->variation->stock_inventory }}" class="plus btn-num-product-up" value="+">
                                                </div>
                                            </td>

                                            <td data-title="Total" class="product-subtotal">
                                                <span class="amount"><span class="num-comma">{{ $item->count * $price }}</span> تومان</span>
                                            </td>
                                            @php $total += $item->count * $price @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="actions" colspan="8">

                                            <div class="coupon">
                                                <label for="coupon_code">کد تخفیف :</label> <input type="text" placeholder="اگر کد تخفیف دارید وارد کنید" value="{{ $cart_products->discount_code->code }}" id="coupon_code" class="input-text" name="coupon_code">
                                                <input type="submit" value="اعمال کد تخفیف" name="apply_coupon" style="top: 3px" class="button">
                                            </div>

                                            <a href="/cart" type="submit" name="update_cart" class="button">بروز رسانی سبد خرید</a>

                                            <div class="wc-proceed-to-checkout">
                                                <a class="checkout-button button alt wc-forward" href="checkout.html">تکمیل پرداخت</a>
                                            </div>

                                            <input type="hidden" value="1eafc42c5e" name="_wpnonce"><input type="hidden" value="/electro/cart/" name="_wp_http_referer">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <div class="cart-collaterals">

                            <div class="cart_totals ">

                                <h2>فاکتور سفارش شما</h2>

                                <table class="shop_table shop_table_responsive">

                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>جمع فاکتور</th>
                                            <td data-title="Subtotal"><span class="amount"><span class="num-comma sub-total">{{ $total }}</span> تومان</span></td>
                                        </tr>


                                        <tr class="shipping">
                                            <th>هزینه ارسال</th>
                                            <td data-title="Shipping">
                                                <select name="shipping_cost" class="shipping_cost">
                                                    @foreach($options['shipping_cost'] as $key => $item)
                                                        <option value="{{ $key }}" cost="{{ $item->cost }}">{{ $item->name . ' - '. $item->cost.' تومان'}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>جمع نهایی</th>
                                            <td data-title="Total"><strong><span class="amount"><span class="num-comma final-total">{{ $total + $options['shipping_cost']->model1->cost }}</span> تومان </span></strong> </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="wc-proceed-to-checkout">

                                    <a class="checkout-button button alt wc-forward" href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </article>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .container -->
    </div><!-- #content -->
@endsection