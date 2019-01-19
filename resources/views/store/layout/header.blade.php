<div class="top-bar">
    <div class="container">
        <nav>
            <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                <li class="menu-item animate-dropdown"><a>به فروشگاه اینترنتی {{ $options['site_name'] }} خوش آمدید</a></li>
            </ul>
        </nav>

        <nav>
            <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                <li class="menu-item animate-dropdown"><a title="آدرس دفتر"><i class="ec ec-map-pointer"></i>{{ $options['shop_address'] }}</a></li>
                <!-- Authentication Links -->
                @guest
                    <li class="menu-item animate-dropdown"><a title="سبد خرید" href="/cart"><i class="ec ec-user"></i>سبد خرید</a></li>
                    <li class="menu-item animate-dropdown"><a title="ورود به حساب" href="{{ route('login') }}"><i class="fa fa-sign-in"></i>{{ __('ورود') }}</a></li>
                    @if (Route::has('register'))
                        <li class="menu-item animate-dropdown"><a title="ثبت نام" href="{{ route('register') }}"><i class="fa fa-user-plus"></i>{{ __('ثبت نام') }}</a></li>
                    @endif
                @else
                    @if (\Auth::user()->type == 1)
                        @isset($product->name)
                        <li class="menu-item animate-dropdown"><a title="ویرایش محصول" href="/panel/products/edit/{{$product->id}}"><i class="fa fa-pencil-square-o"></i>ویرایش محصول</a></li>
                        @endisset
                        <li class="menu-item animate-dropdown"><a title="پنل مدیریت" target="_blank" href="/panel"><i class="fa fa-desktop"></i>پنل مدیریت</a></li>
                    @endif
                    <li class="menu-item animate-dropdown"><a title="سفارشات" href="/orders"><i class="fa fa-file-text-o"></i>سفارشات</a></li>                    
                    <li class="menu-item animate-dropdown"><a title="سبد خرید" href="/cart"><i class="fa fa-shopping-basket"></i>سبد خرید</a></li>
                    
                    <li class="menu-item animate-dropdown"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <a title="خروج" href="{{ route('logout') }}">
                            <i class="ec ec-user"></i>
                            خروج
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </nav>
    </div>
</div><!-- /.top-bar -->

<header id="masthead" class="site-header header-v2">
    <div class="container">
        <div class="row">

            <!-- ============================================================= Header Logo ============================================================= -->
            <div class="header-logo">
                <a href="/" class="header-logo-link">
                    <img src="{{ asset('logo/'.$options['site_logo']) }}" style="max-height: 60px;display: block;margin: auto" alt="لوگوی فروشگاه">
                </a>
            </div>
            <!-- ============================================================= Header Logo : End============================================================= -->

            <div class="primary-nav animate-dropdown">
                <div class="clearfix">
                     <button class="navbar-toggler hidden-sm-up pull-right flip" type="button" data-toggle="collapse" data-target="#default-header">
                            &#9776;
                     </button>
                 </div>

                <div class="collapse navbar-toggleable-xs" id="default-header">
                    <nav>
                        <ul id="menu-main-menu" class="nav nav-inline yamm">
                            <li class="menu-item"><a href="/">صفحه اصلی</a></li>
                            <li class="menu-item"><a href="/product">فروشگاه</a></li>
                            <li class="menu-item"><a href="/cart">سبد خرید</a></li>
                            <li class="menu-item"><a href="/blog">وبلاگ</a></li>
                        </ul>
                    </nav>

                </div>
            </div>

            <div class="header-support-info">
                <div class="media">
                    <span class="media-left support-icon media-middle"><i class="ec ec-support"></i></span>
                    <div class="media-body">
                        <span class="support-email">سوالی دارید ؟ تماس بگیرید :)</span>
                        <span class="support-number"><strong>شماره تلفن :</strong> {{ $options['shop_phone'] }}</span><br/>
                    </div>
                </div>
            </div>

        </div><!-- /.row -->
    </div>
</header><!-- #masthead -->

<nav class="navbar navbar-primary navbar-full">
    <div class="container">
        <ul class="nav navbar-nav departments-menu animate-dropdown">
            <li class="nav-item dropdown ">

                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >تمامی دسته بندی ها</a>
                <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
                    
                    @foreach ( $groups as $group_first )
                        @if ( $group_first->childs->isEmpty() )
                            <li class="highlight menu-item animate-dropdown"><a title="{{ $group_first->title }}"href="/category/{{ $group_first->id }}">{{ $group_first->title }}</a></li>
                        @else
                            <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2584 dropdown">
                                <a title="{{ $group_first->description }}" href="/category/{{ $group_first->id }}" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">{{ $group_first->title }}</a>
                                <ul role="menu" class=" dropdown-menu">
                                    <li class="menu-item animate-dropdown menu-item-object-static_block">
                                        <div class="yamm-content">
                                            <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                    <div class="vc_column-inner ">
                                                        <div class="wpb_wrapper">
                                                            <div class="wpb_single_image wpb_content_element vc_align_left" style="width: 100%;height: 300px;background: url('{{ $group_first->avatar }}') center/cover no-repeat"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vc_row row wpb_row vc_row-fluid">
                                                @foreach ( $group_first->childs as $group_secound )
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title"><a href="/category/{{ $group_secound->id }}" title="{{ $group_secound->description }}">{{ $group_secound->title }}</a></li>
                                                                            @if ($group_secound->childs)
                                                                                @foreach ($group_secound->childs as $group_third)
                                                                                    <li><a href="/category/{{ $group_third->id }}" title="{{ $group_third->description }}">{{ $group_third->title }}</a></li>
                                                                                @endforeach
                                                                            @endif
                                                                            <li class="nav-divider"></li>
                                                                            {{-- <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li> --}}
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        </ul>

        <div class="navbar-search">
            <label class="sr-only screen-reader-text" for="search">جستجو برای :</label>
            <div class="input-group">
                <input type="text" id="search" class="form-control search-field" dir="rtl" placeholder="بخشی از نام محصول مورد نظر خود را وارد کنید ...." />
                <div class="input-group-btn">
                    <input type="hidden" id="search-param" name="post_type" value="product" />
                    <button class="btn btn-secondary" onclick="window.location = '/product/search/' + this.parentNode.previousElementSibling.value"><i class="ec ec-search"></i></button>
                </div>
            </div>
        </div>
        <ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip">
            <li class="nav-item dropdown">
                <a href="cart.html" class="nav-link" data-toggle="dropdown">
                    <i class="ec ec-shopping-bag"></i>
                    <span class="cart-items-count count">
                        @if ( $cart_products )
                            @isset ($cart_products->items) {{ $cart_products->items->count() }} @else {{ $cart_products->count() }} @endisset
                        @else 0 @endif
                    </span>
                    <span class="cart-items-total-price total-price"><span class="amount"><span class="num-comma"></span> تومان</span></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-mini-cart" style="right: -150px">
                    <li>
                        <div class="widget_shopping_cart_content">

                            <ul class="cart_list product_list_widget ">
                                @php $total_cart = 0 @endphp
                                @if($cart_products)
                                    @php
                                        if ( isset( $cart_products->items ) )
                                            $items = $cart_products->items;
                                        else
                                            $items = $cart_products;
                                            
                                    @endphp

                                    @foreach ( $items as $item )
                                        @php
                                            $variation = isset( $item->variation ) ? $item->variation : $item;   
                                        @endphp
                                        <li class="mini_cart_item">
                                            <form action="/cart/remove/{{ $variation->id }}" method="POST">
                                                <input type="submit" title="حذف از سبد" class="remove" value="×" style="background: none;width: 20px;height: 20px;padding: 0px" />
                                                @method('delete')
                                                @csrf
                                            </form>
                                            <a href="single-product.html">
                                                <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="{{ $variation->product->photo }}" alt="{{ $variation->product->name }}">
                                                {{ $variation->product->name }}
                                            </a>
                                            @php
                                                $price = $variation->price;
                                                if ( $variation->offer && $variation->deadline->gt(now()) )
                                                    $price = $variation->offer;
                                                    
                                                if ( $variation->unit )
                                                    $price = $price * $options['dollar_cost'];
                                                
                                                $total_cart += $price * $item->count;
                                            @endphp
                                            <span class="quantity" style="margin-right: 115px;margin-left: 15px">{{ $item->count }} × <span class="amount"><span class="num-comma">{{ $price }}</span> تومان</span></span>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger">هیچ محصولی در سبد خرید شما موجود نیست :(</div>
                                @endif
                                <script> document.querySelector('.nav-link .amount .num-comma').innerHTML = {{ $total_cart }} </script>
                            </ul><!-- end product list -->


                            <p class="total"><strong>Subtotal:</strong> <span class="amount">£969.98</span></p>


                            <p class="buttons">
                                <a class="button wc-forward" href="/cart">سبد خرید</a>
                                <a class="button checkout wc-forward" href="/checkout">تکمیل خرید</a>
                            </p>


                        </div>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-compare nav navbar-nav pull-right flip">
            <li class="nav-item">
                <a href="/compare" class="nav-link"><i class="ec ec-compare"></i></a>
            </li>
        </ul>
    </div>
</nav>

@if ( $errors->all() || session()->has('message') )
    <div class="panel-body" style="padding: 30px">
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
    </div>
@endif