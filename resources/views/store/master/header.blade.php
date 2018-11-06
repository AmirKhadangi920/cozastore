<?php if (!isset($page_name)) { $page_name = null; } ?>
<!-- Header -->
<header class="header-v4" dir="rtl">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    به فروشگاه اینترنتی {{$site_name}} خوش آمدید
                </div>

                <div class="right-top-bar flex-w h-full">

                    
                    <!-- Authentication Links -->
                    @guest
                        <a class="nav-link" href="/cart"><i class="fa fa-shopping-cart m-l-5"></i>سبد خرید</a>
                        <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-user m-l-5"></i>{{ __('ورود') }}</a>
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-edit m-l-5"></i>{{ __('ثبت نام') }}</a>
                        @endif
                    @else
                        @if (\Auth::user()->type == 1)
                        @isset($product->name)
                        <a class="nav-link" href="/panel/products/edit/{{$product->pro_id}}"><i class="fa fa-edit m-l-5"></i>ویرایش محصول</a>
                        @endisset
                        <a class="nav-link" href="/panel"><i class="fa fa-bars m-l-5" aria-hidden="true"></i>پنل مدیریت</a>
                        @endif
                        <a class="nav-link" href="/cart"><i class="fa fa-shopping-cart m-l-5"></i>سبد خرید</a>

                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out m-l-5"></i>{{ __('خروج') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <a href="#" class="logo">
                    <img src="{{ asset('logo/'.$site_logo) }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li @if($page_name == 'main') class="active-menu" @endif>
                            <a href="/">صفحه اصلی</a>
                        </li>

                        <li @if($page_name == 'products') class="active-menu" @endif>
                            <a href="/products">فروشگاه</a>
                        </li>

                        {{-- <li>
                            <a href="/blog">وبلاگ</a>
                        </li> --}}

                        <li @if($page_name == 'contact') class="active-menu" @endif>
                            <a href="/contact">ارتباط با ما</a>
                        </li>
                        
                        <li @if($page_name == 'about') class="active-menu" @endif>
                            <a href="/about">درباره ما</a>
                        </li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{count($cart_products)}}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    حمل و نقل رایگان برای سفارش استاندارد بیش از 100 دلار					</div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        پرسش و پاسخ
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        اکانت من
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="index.php">صفحه اصلی</a>
                <ul class="sub-menu-m">
                    <li><a href="index.php">صفحه اصلی 1</a></li>
                    <li><a href="home-02.php">صفحه اصلی 2</a></li>
                    <li><a href="home-03.php">صفحه اصلی 3</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="product.php">فروشگاه</a>
            </li>

            <li>
                <a href="shoping-cart.php" class="label1 rs1" data-label1="جدید">امکانات</a>
            </li>

            <li>
                <a href="blog.php">وبلاگ</a>
            </li>

            <li>
                <a href="about.php">درباره</a>
            </li>

            <li>
                <a href="contact.php">ارتباط</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="جستجو ...">
            </form>
        </div>
    </div>
</header>