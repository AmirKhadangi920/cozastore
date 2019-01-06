@extends('store.layout.master')

@section('body-class', 'page home page-template-default')

@section('content')
    <div tabindex="-1" class="site-content" id="content">
        <div class="container">

            <nav class="woocommerce-breadcrumb"><a href="/">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>مقایسه محصولات</nav>
            <div class="content-area" id="primary">
                <main class="site-main" id="main">
                    <article class="post-2917 page type-page status-publish hentry" id="post-2917">
                        <div itemprop="mainContentOfPage" class="entry-content">
                            <div class="table-responsive">
                                @if ( $compares->isEmpty() )
                                    <div class="alert alert-danger">
                                        متاسفانه هنوز هیچ محصولی جهت مقایسه اضافه نشده است :(
                                    </div>
                                @else
                                    <table class="table table-compare compare-list">
                                        @php $compare_count = count( $compares ) @endphp
                                        <tbody>
                                            <tr>
                                                <th>محصولات</th>
                                                @foreach ($compares as $item)
                                                    <td>
                                                        <a class="product" href="/product/{{ $item->id }}">
                                                            <div class="product-image">
                                                                <div class="">
                                                                    <img width="250" height="232" alt="1" class="wp-post-image" src="{{ $item->photo }}">
                                                                </div>
                                                            </div>
                                                            <div class="product-info">
                                                                <h3 class="product-title">{{ $item->name }}</h3>
                                                            </div>
                                                        </a><!-- /.product -->
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>قیمت</th>
                                                @foreach ($compares as $item)
                                                    <td>
                                                        <div class="product-price price">
                                                            <span class="electro-price">
                                                                @php
                                                                    if ($item->variation->unit)
                                                                    {
                                                                        $item->variation->offer *= $options['dollar_cost'];
                                                                        $item->variation->price *= $options['dollar_cost'];
                                                                    }
                                                                @endphp
                                                                @if ($item->variation->offer && $item->variation->deadline->gt(now()))
                                                                    <ins><span class="amount"><span class="num-comma">{{ $item->variation->offer }}</span> تومان</span></ins><br/>
                                                                    <del><span class="amount"><span class="num-comma">{{ $item->variation->price }}</span> تومان</span></del>
                                                                @else
                                                                    <span class="amount"><span class="num-comma">{{ $item->variation->price }}</span> تومان</span>
                                                                @endif                                            
                                                            </span>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>وضعیت</th>
                                                @foreach ($compares as $item)
                                                    <td>
                                                        @if($item->label)
                                
                                                            @switch($item->label)
                                                                @case(1) <span class="label label-danger">توقف تولید</span> @break
                                                                @case(2) <span class="label label-primary">به زودی</span> @break                            
                                                                @case(3) <span class="label label-warning">نا موجود</span> @break                            
                                                                @case(4) <span class="label label-info">عدم فروش</span> @break                            
                                                            @endswitch
                                                        @elseif($item->variation && $item->variation->stock_inventory == 0) 
                                                            
                                                            <span class="label label-warning">نا موجود</span>
                                                        @else
                                                            <span class="label label-success">موجود برای فروش</span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>مزایا</th>
                                                @foreach ($compares as $item)
                                                    <td>
                                                        <ul style="text-align:right; color:green">
                                                            @foreach (explode(',', $item->advantages) as $item)
                                                                <li><span class="a-list-item">{{ $item }}</span></li>   
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>معایب</th>
                                                @foreach ($compares as $item)
                                                    <td>
                                                        <ul style="text-align:right; color:red">
                                                            @foreach (explode(',', $item->disadvantages) as $item)
                                                                <li><span class="a-list-item">{{ $item }}</span></li>   
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>افزودن به سبد</th>
                                                @foreach ($compares as $item)
                                                    <td>
                                                        <a class="button" href="/cart/add/{{ $item->variation->id }}?quantity=1" rel="nofollow">افزودن به سبد</a>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>حذف از مقایسه</th>
                                                @foreach ($compares as $item)
                                                    <td class="text-center">
                                                        <a href="/compare/remove/{{ $item->id }}" title="حذف کردن" class="remove-icon"><i class="fa fa-times"></i></a>
                                                    </td>   
                                                @endforeach
                                            </tr>
                                            @foreach ( $data->toArray()['spec_headers'] as $spec_header )
                                                <tr>
                                                    <td colspan="{{ $compare_count + 1 }}" style="text-align: right">
                                                        <h3><i class="fa fa-arrow-left" style="color: #e52b2b" aria-hidden="true"></i> {{ $spec_header['title'] }}</h3>
                                                        <p>{{ $spec_header['description'] }}</p>
                                                    </td>
                                                </tr>    
                                                @php $empty = true @endphp
                                                @foreach ( $spec_header['spec_rows'] as $spec_row )
                                                    @continue( is_null($spec_row['spec_datas']) )    
                                                    <tr>
                                                        <th>{{ $spec_row['title'] }}</th>
                                                        @for ($i = 0; $i < $compare_count; $i++)
                                                            <td>
                                                                @php $index = array_search($compares[$i]->id , array_column($spec_row['spec_datas'], 'product_id')) @endphp
                                                                @continue( $index === false )
                                                                @php $data = $spec_row['spec_datas'][$index]['data'] @endphp

                                                                @if ($spec_row['multiple'])
                                                                    <ul style="text-align: right">
                                                                        @foreach (explode(',', $data) as $item)
                                                                        <li>    
                                                                            @if($spec_row['values'])
                                                                                @isset($spec_row['values'][ $item ])
                                                                                    {{ $spec_row['values'][ $item ] }}
                                                                                @else
                                                                                    {{ $item }} 
                                                                                @endisset
                                                                            @else
                                                                                {{ $item }} 
                                                                            @endif
        
                                                                            @if($spec_row['label'])
                                                                                {{ $spec_row['label'] }}
                                                                            @endif
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>    
                                                                @else
                                                                    @if($spec_row['values'])
                                                                        @isset($spec_row['values'][ $data ])
                                                                            {{ $spec_row['values'][ $data ] }}
                                                                        @else
                                                                            {{ $data }}
                                                                        @endisset
                                                                    @endif
                                                                    @if($spec_row['label'])
                                                                        {{ $spec_row['label'] }}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div><!-- /.table-responsive -->
                        </div><!-- .entry-content -->
                    </article><!-- #post-## -->
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .col-full -->
    </div>
@endsection