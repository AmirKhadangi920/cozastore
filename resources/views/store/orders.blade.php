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

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav class="woocommerce-breadcrumb"><a href="/">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>سفارشات</nav>

            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <article class="page type-page status-publish hentry">
                        <header class="entry-header"><h1 itemprop="name" class="entry-title">سفارشات شما</h1></header><!-- .entry-header -->

                        <form action="/checkout" method="POST">

                            <table class="shop_table shop_table_responsive cart">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">شماره فاکتور</th>
                                        <th class="product-color">آدرس مقصد</th>
                                        <th class="product-warranty">کد پستی</th>
                                        <th class="product-quantity">روش ارسال</th>
                                        <th class="product-subtotal">هزینه ارسال</th>
                                        <th class="product-subtotal">وضعیت</th>
                                        <th class="product-price">تخفیف</th>
                                        <th class="product-subtotal">جمع فاکتور</th>
                                        <th class="product-subtotal">تاریخ پرداخت</th>
                                        <th class="product-subtotal">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $item)
                                        <tr class="cart_item">
                                            <td class="product-thumbnail">#{{ $item->id }}</td>

                                            <td data-title="Product" class="product-name">{{ $item->destination }}</td>

                                            <td data-title="Price" class="product-color">{{ $item->postal_code }}</td>
                                            
                                            <td data-title="Price" class="product-price">
                                                @php $temp = (array) $options['shipping_cost'] @endphp
                                                {{ $temp[ $item->shipping_type ]->name }}
                                            </td>

                                            <td data-title="Quantity" class="product-quantity"><span class="num-comma">{{ $item->shipping_cost }}</span> تومان</td>

                                            <td data-title="Total" class="product-subtotal">
                                                @php
                                                    switch ($item->status) {
                                                        case 0: $status = ['پرداخت نشده', 'info']; break;
                                                        case 1: $status = ['در انتظار پرداخت', 'warning']; break; 
                                                        case 2: $status = ['پرداخت شده', 'dark']; break;
                                                        case 3: $status = ['در حال بررسی', 'warning']; break;
                                                        case 4: $status = ['در حال بسته بندی', 'warning']; break;
                                                        case 5: $status = ['در حال ارسال', 'primary']; break;
                                                        case 6: $status = ['ارسال شده', 'success']; break;
                                                        case 7: $status = ['لغو شده', 'danger']; break;
                                                        default: $status = ['پرداخت نشده', 'info'];
                                                    }
                                                @endphp
                                                <span class="label label-{{ $status[1] }}">{{ $status[0] }}</span>
                                            </td>

                                            <td data-title="Price" class="product-warranty"><span class="num-comma">{{ $item->offer }}</span> تومان</td>

                                            <td data-title="Total" class="product-subtotal"><span class="num-comma">{{ $item->total }}</span> تومان</td>
                                            
                                            <td data-title="Total" class="product-subtotal">
                                                @if ($item->payment)
                                                    {{ \Morilog\Jalali\Jalalian::forge($item->payment)->format('%H:%S - %d %B %Y') }}
                                                @else
                                                    <span class="label label-danger">هنوز پرداخت نشده</span>
                                                @endif
                                            </td>

                                            <td data-title="Total" class="product-subtotal"><a href="/orders/{{ $item->id }}" title="اطلاعات بیشتر"><i class="fa fa-info"></i></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">
                                                <div class="alert alert-danger">
                                                    متاسفانه هیچ سفارشی هنوز برای شما ثبت نشده است :(
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
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