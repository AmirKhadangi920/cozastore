@extends('store.layout.master')

@section('body-class', 'page home page-template-default')

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $('.shipping_type').change(function () {
            var method = $(this).val();
            var cost_temp = $('option[value="'+method+'"]').attr('cost') * 1;
            var cost = $('.shipping_cost').text().replace(/,/g, '') * 1;

            var total = $('.final-total');
            var output = numeral(total.text().replace(/,/g, '') * 1 + (cost_temp - cost)).format('0,0');
            total.text(output);
            $('.shipping_cost').text( numeral(cost_temp).format('0,0') )
        });
    </script>
@endsection

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav class="woocommerce-breadcrumb"><a href="/">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>تکمیل سفارش</nav>

            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <article class="page type-page status-publish hentry">
                        <header class="entry-header"><h1 itemprop="name" class="entry-title">تکمیل سفارش</h1></header><!-- .entry-header -->

                        <form action="/cart/pay" class="checkout woocommerce-checkout" method="post" name="checkout">
                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">

                                        <h3>اطلاعات خریدار</h3>

                                        <p id="billing_first_name_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_first_name">نام <abbr title="required" class="required">*</abbr></label><input type="text" value="{{ auth()->user()->first_name }}" disabled="disabled" placeholder="علی رضا" id="billing_first_name" name="billing_first_name" class="input-text "></p>

                                        <p id="billing_last_name_field" class="form-row form-row form-row-last validate-required"><label class="" for="billing_last_name">نام خانوادگی <abbr title="required" class="required">*</abbr></label><input type="text"  value="{{ auth()->user()->last_name }}" disabled="disabled"  placeholder="توکلی" id="billing_last_name" name="billing_last_name" class="input-text "></p><div class="clear"></div>

                                        <p id="billing_email_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_email">آدرس ایمیل <abbr title="required" class="required">*</abbr></label><input type="email"  value="{{ auth()->user()->email }}" disabled="disabled"  placeholder="example@example.com" id="billing_email" name="billing_email" class="input-text "></p>

                                        <p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone">شماره تلفن <abbr title="required" class="required">*</abbr></label><input type="tel"  value="{{ auth()->user()->phone }}" disabled="disabled"  placeholder="09105009868" id="billing_phone" name="billing_phone" class="input-text "></p><div class="clear"></div>

                                        @guest
                                            <p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1">رمز عبور <abbr title="required" class="required">*</abbr></label><input type="password" placeholder="رمز عبور" id="billing_address_1" name="password" class="input-text "></p>
                                            <p id="billing_address_2_field" class="form-row form-row form-row-wide address-field"><input type="password" placeholder="تکرار رمز عبور" id="billing_address_2" name="password_confirmation" class="input-text "></p>
                                        @endguest

                                        <p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1">آدرس <abbr title="required" class="required">*</abbr></label><input type="text" value="{{ auth()->user()->state }}"  placeholder="استان" id="billing_address_1" name="state" class="input-text "></p>

                                        <p id="billing_address_2_field" class="form-row form-row form-row-wide address-field"><input type="text"  value="{{ auth()->user()->city }}"  placeholder="شهر" id="billing_address_2" name="city" class="input-text "></p>
                                        <p id="billing_address_2_field" class="form-row form-row form-row-wide address-field"><input type="text"  value="{{ auth()->user()->address }}"  placeholder="خیابان , کوچه , پلاک و ..." id="address" name="address" class="input-text "></p>

                                        <p id="billing_postcode_field" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="postal_code">کد پستی <abbr title="required" class="required">*</abbr></label><input type="text"  value="{{ auth()->user()->postal_code }}"  placeholder="کد پستی آدرس شما" id="billing_postcode" name="postal_code" class="input-text "></p>

                                        <div class="clear"></div>
                                        @guest <p class="form-row form-row-wide create-account">* با اطلاعات وارد شده در بالا برای شما یک حساب کاربری نیز ساخته میشود</p> @endguest

                                    </div>
                                </div>

                                <div class="col-2">
                                    <h3>توضیحات و روش ارسال</h3>
                                    <div class="woocommerce-shipping-fields">
                                        <h3 id="ship-to-different-address">
                                            <span>آیا مایل به ارسال کالا از طریق دیگری میباشید ؟</span>
                                            <select name="shipping_type" class="shipping_type" style="background: #fff;border-radius: 20px;padding: 10px 15px 13px;border-color: #d5d5d5;outline: none">
                                                @foreach($options['shipping_cost'] as $key => $item)
                                                    <option value="{{ $key }}" @if( $cart_products->shipping_type == $key ) selected="selected" @endif cost="{{ $item->cost }}">{{ $item->name . ' - '. $item->cost.' تومان'}}</option>
                                                @endforeach
                                            </select>
                                        </h3>
                                
                                        <p id="order_comments_field" class="form-row form-row notes"><label class="" for="order_comments">توضیحات شما </label><textarea cols="5" rows="2" placeholder="چنانچه درباره سفارش خود توضیحاتی دارید که به فروشنده نمایش داده شود در این قسمت وارد کنید ..." id="order_comments" class="input-text" name="buyer_description">@isset( $cart_products ){{ $cart_products->buyer_description }}@endisset</textarea></p>
                                    </div>
                                </div>
                            </div>

                            <h3 id="order_review_heading">سفارش شما</h3>

                            <div class="woocommerce-checkout-review-order" id="order_review">
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">محصولات</th>
                                            <th class="product-total">جمع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart_products->items as $item)
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    <strong>{{ $item->variation->product->name }}</strong>
                                                    @if( $item->variation->color) <span class="label label-danger" style="background: {{ $item->variation->color->value }}">{{ $item->variation->color->name }}</span> @endif 
                                                    @if( $item->variation->warranty) با گارانتی {{ $item->variation->warranty->name }}@endif 
                                                    <strong class="product-quantity">× {{ $item->count }} عدد</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount"><span class="num-comma">{{ $item->count * $item->price }}</span> تومان</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>جمع فاکتور</th>
                                            <td><span class="amount"><span class="num-comma">{{ $cart_products->total }}</span> تومان</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>هزینه ارسال</th>
                                            <td data-title="Shipping"><span class="amount"><span class="num-comma shipping_cost">{{ $cart_products->shipping_cost }}</span> تومان</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>تخفیف سفارش</th>
                                            <td data-title="Shipping"><span class="amount"><span class="num-comma">{{ $cart_products->offer }}</span> تومان</span></td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>جمع نهایی</th>
                                            <td><strong><span class="amount"><span class="num-comma final-total">{{ $cart_products->total - $cart_products->offer + $cart_products->shipping_cost }}</span> تومان</span></strong> </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="woocommerce-checkout-payment" id="payment">
                                    
                                    <div class="form-row place-order">
                                        <input type="submit" data-value="Place order" value="پرداخت صورت حساب از طریق درگاه امن زرین پال" class="button alt">
                                    </div>
                                </div>
                            </div>

                            @csrf
                        </form>
                    </article>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .container -->
    </div><!-- #content -->
@endsection