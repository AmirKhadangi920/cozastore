@extends('store.layout.master')

@section('body-class', 'page home page-template-default')

@section('style')
    <style>
        @media only print {
            header, footer, nav, #owl-brands, hr {
                display: none;
            }
        }

        .color_label {
            background: #ea1b25;
            border-radius: 10px;
            padding: 2px 10px;
            color: #fff;
            text-shadow: 0px 0px 5px #000;
        }
        thead tr {
            background: #848484;
        }
        thead tr th {
            color: #fff !important;
            font-size: 14px !important;
        }
        .address-head {
            font-size: 16px;
            margin-bottom: 20px !important;
            /* display: inline-block; */
        }
        .address-head i {
            margin-left: 5px;
        }
        blockquote {
            border-left: none;
            border-right: 4px solid #f83f37;
            font-size: 13px;
        }
        .btn-info.fancy-button:hover {
            background: #ed1b60 !important;
        }
        .btn-warning.fancy-button:hover {
            background: #ffbf36 !important;
        }
        .btn-dark.fancy-button:hover {
            background: #324148 !important;
            color: #fff !important;
        }
        .btn-orange.fancy-button:hover {
            background: #ff9528 !important;
            color: #fff !important;
        }
        .btn-primary.fancy-button:hover {
            background: #0092ee !important;
        }
        .btn-success.fancy-button:hover {
            background: #22af47 !important;
        }
        .btn-danger.fancy-button:hover {
            background: #f83f37 !important;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
            <nav class="woocommerce-breadcrumb"><a href="/">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>اطلاعات سفارش</nav>
            
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <article class="page type-page status-publish hentry">
                        <header class="entry-header"><h1 itemprop="name" class="entry-title">فاکتور سفارش #{{ $order->id }}</h1></header><!-- .entry-header -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default border-panel card-view">
                                    <div class="panel-heading">
                                        <div class="pull-right">
                                            <h3 class="panel-title txt-dark mt-10">مشخصات فاکتور #{{$order->id}}</h3>
                                        </div>
                                        <div class="pull-left">
                                            <?php
                                            switch ($order->status) {
                                                case 0: $status = ['پرداخت نشده', 'info']; break;
                                                case 1: $status = ['در انتظار پرداخت', 'warning']; break; 
                                                case 2: $status = ['پرداخت شده', 'dark']; break;
                                                case 3: $status = ['در حال بررسی', 'orange']; break;
                                                case 4: $status = ['در حال بسته بندی', 'warning']; break;
                                                case 5: $status = ['در حال ارسال', 'primary']; break;
                                                case 6: $status = ['ارسال شده', 'success']; break;
                                                case 7: $status = ['لغو شده', 'danger']; break;
                                                default: $status = ['پرداخت نشده', 'info'];
                                            }
                                            ?>
                                            <div class="button-list pull-left">
                                                <button type="button" class="btn btn-default btn-outline btn-icon left-icon mt-0" onclick="javascript:window.print();"> 
                                                    <i class="fa fa-print"></i><span> چاپ</span> 
                                                </button>
                                                <span class="btn btn-{{$status[1]}} mr-10 mt-0">وضعیت : {{$status[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        @foreach ($errors -> all() as $message)
                                            <div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{ $message }} 
                                            </div>
                                        @endforeach
                
                                        @if(session()->has('message'))
                                            <div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-6 text-right">
                                                    <span class="txt-dark head-font inline-block capitalize-font mb-5 address-head">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                        <b>آدرس خریدار:</b>
                                                    </span>
                                                    <address class="mb-15">
                                                        <span class="mb-5">{{$order->user->state}} ، {{$order->user->city}}</span><br/>
                                                        {{$order->user->address}}<br>
                                                        <b>کد پستی : </b>{{$order->user->postal_code}}
                                                    </address>
                                                </div>
                                                <div class="col-xs-6">
                                                    <span class="txt-dark head-font inline-block capitalize-font mb-5 address-head">
                                                        <i class="fa fa-plane" aria-hidden="true"></i>
                                                        آدرس مقصد ارسال سفارش:
                                                    </span>
                                                    <address class="mb-15">
                                                        {{$order->destination}}<br>
                                                        <b>کد پستی : </b>{{$order->postal_code}}
                                                    </address>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-xs-6 text-right">
                                                    <address>
                                                        <span class="txt-dark head-font capitalize-font mb-5 address-head">
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            تاریخ ثبت سفارش:
                                                        </span>
                                                        <?php 
                                                            $time = new Carbon\Carbon($order->created_at);
                                                            $created_at = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '/');	
                                                        ?>
                                                        <b class="txt-dark"></b> {{$time->hour.':'.$time->minute.' | '.$created_at}}<br/><br/>
                                                    </address>
                                                </div>

                                                <div class="col-xs-6 text-right">
                                                    <address>
                                                        @if ($order->payment)
                                                        <?php
                                                            $time = new Carbon\Carbon($order->payment);
                                                            $payment = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '/');	
                                                        ?>
                                                        <b class="txt-dark">پرداخت :</b> {{$time->hour.':'.$time->minute.' | '.$payment}}
                                                        <b class="txt-dark">کد احراز پرداخت :</b> {{$order->auth_code}}
                                                        <b class="txt-dark">شناسه پرداخت :</b> {{$order->payment_code}}
                                                        @else
                                                        <b class="txt-dark">پرداخت :</b> <span class="label label-danger">هنوز پرداخت نشده</span>
                                                        @endif
                                                    </address>
                                                </div>
                                            </div>
                
                                            <div class="row mt-20">
                                                @if ($order->buyer_description)
                                                <div class="col-md-12">
                                                    <span class="txt-dark head-font inline-block capitalize-font mb-5 address-head">
                                                        <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                                        <b>توضیحات شما :</b>
                                                    </span>
                                                    <span class="mb-15">
                                                        <blockquote style="padding: 5px 10px"><pre>{{$order->buyer_description}}</pre></blockquote>
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                            
                                            <div class="seprator-block"></div>
                                            
                                            <div class="invoice-bill-table">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="invoice-table">
                                                        <thead>
                                                            <tr class="btn-dark">
                                                                <th><b>تصویر محصول</b></th>
                                                                <th><b>نام محصول</b></th>
                                                                <th><b>قیمت</b></th>
                                                                <th><b>تعداد</b></th>
                                                                <th><b>رنگ</b></th>
                                                                <th><b>گارانتی</b></th>
                                                                <th><b>جمع</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->items as $item)
                                                            <tr>
                                                                <td><img src="{{$item->variation->product->photo}}" /></td>
                                                                <td>
                                                                    {{$item->variation->product->name}}<br/>
                                                                    {{$item->variation->product->code}}
                                                                </td>
                                                                <td><span class="num-comma">{{$item->price}}</span> تومان</td>
                                                                <td>{{$item->count}}</td>
                                                                <td>{!!($item->variation->color) ? '<span class="label label-primary" style="background: '.$item->variation->color->value.'">'.$item->variation->color->name.'</span>' : 'رنگی انتخاب نشده است'!!}</td>
                                                                <td>{{($item->variation->warranty)? $item->variation->warranty->name : 'بدون گارانتی'}}</td>
                                                                <td><span class="num-comma">{{$item->price * $item->count}}</span> تومان</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr class="txt-dark">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>جمع فاکتور</td>
                                                                <td><span class="num-comma">{{$order->total}}</span> تومان</td>
                                                            </tr>
                                                            <tr class="txt-dark">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>هزینه ارسال</td>
                                                                <td><span class="num-comma">{{$order->shipping_cost}}</span> تومان</td>
                                                            </tr>
                                                            <tr class="txt-dark">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>تخفیف سفارش</td>
                                                                <td><span class="num-comma">{{$order->offer}}</span> تومان</td>
                                                            </tr>
                                                            <tr class="txt-dark">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>جمع کلی</td>
                                                                <td><span class="num-comma">{{$order->total - $order->offer + $order->shipping_cost}}</span> تومان</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                        
                    </article>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .container -->
    </div><!-- #content -->
@endsection