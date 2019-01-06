<section class="brands-carousel">
    <h2 class="sr-only">برند های فروشگاه</h2>
    <div class="container">
        <div id="owl-brands" class="owl-brands owl-carousel unicase-owl-carousel owl-outer-nav">

            @foreach ($brands as $item)
                <div class="item">
                    <h5>{{ $item->title }}</h5>
                </div><!-- /.item -->
            @endforeach

        </div><!-- /.owl-carousel -->

    </div>
</section>

<footer id="colophon" class="site-footer">
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">محبوب ترین محصولات</h4>
                            <ul class="product_list_widget">
                                @foreach ($top_products->take(5) as $item)
                                    @productItem([
                                        'product'     => $item->product,
                                        'variation'   => $item,
                                        'dollar_cost' => $options['dollar_cost']
                                    ])@endproductItem
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body"><h4 class="widget-title">جدید ترین محصولات</h4>
                            <ul class="product_list_widget">
                                @foreach ($products->take(5) as $item)
                                    @productItem([
                                        'product'     => $item,
                                        'variation'   => $item->variation,
                                        'dollar_cost' => $options['dollar_cost']
                                    ])@endproductItem
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">جدید ترین تخفیف ها</h4>
                            <ul class="product_list_widget">
                                @foreach ($offers['mostـurgent']->take(5) as $item)
                                    @productItem([
                                        'product'     => $item->product,
                                        'variation'   => $item,
                                        'dollar_cost' => $options['dollar_cost']
                                    ])@endproductItem
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7">
                    <h5 class="newsletter-title">در خبرنامه ثبت نام کنید</h5>
                    <span class="newsletter-marketing-text"><strong> و آخرین اخبار و تخفیف های فروشگاه را</strong>دریافت کنید ...</span>
                </div>
                <div class="col-xs-12 col-sm-5">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="متاسفانه خبرنامه در حال حاضر فعال نیست :(">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">عضویت</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-widgets">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-md-push-5">
                    <div class="columns">
                        @php $groups = $groups->chunk( round($groups->count()/2) ) @endphp
                        <aside id="nav_menu-2" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">دسته بندی محصولات</h4>
                                <div class="menu-footer-menu-1-container">
                                    <ul id="menu-footer-menu-1" class="menu">
                                        @foreach ($groups[0] as $item)
                                            <li class="menu-item "><a href="/category/{{ $item->id }}">{{ $item->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                    <div class="columns">
                        <aside id="nav_menu-3" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">&nbsp;</h4>
                                <div class="menu-footer-menu-2-container">
                                    <ul id="menu-footer-menu-2" class="menu">
                                        @foreach ($groups[1] as $item)
                                            <li class="menu-item "><a href="/category/{{ $item->id }}">{{ $item->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                    <div class="columns">
                        <aside id="nav_menu-4" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">لینک های فروشگاه</h4>
                                <div class="menu-footer-menu-3-container">
                                    <ul id="menu-footer-menu-3" class="menu">
                                        <li class="menu-item"><a href="/">صفحه اصلی</a></li>
                                        <li class="menu-item"><a href="/cart">سبد خرید</a></li>
                                        <li class="menu-item"><a href="/product">محصولات</a></li>
                                        <li class="menu-item"><a href="/login">ورود</a></li>
                                        <li class="menu-item"><a href="/register">ثبت نام</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                </div><!-- /.col -->

                <div class="footer-contact col-xs-12 col-sm-12 col-md-5 col-md-pull-7">
                    <div class="footer-logo">
                            <img src="{{ asset('logo/'.$options['site_logo']) }}" style="max-height: 60px;display: block" alt="لوگوی فروشگاه">
                    </div><!-- /.footer-contact -->

                    <div class="footer-call-us">
                        <div class="media">
                            <span class="media-left call-us-icon media-middle"><i class="ec ec-support"></i></span>
                            <div class="media-body">
                                <span class="call-us-text">سوالی دارید ؟ تماس بگیرید :)</span>
                                <span class="call-us-number">{{ $options['shop_phone'] }}</span>
                            </div>
                        </div>
                    </div><!-- /.footer-call-us -->

                    <div class="footer-address">
                        <strong class="footer-address-title">آدرس</strong>
                        <address>{{ $options['shop_address'] }}</address>
                    </div><!-- /.footer-address -->

                    <div class="footer-address">
                        <strong class="footer-address-title">درباره کسب و کار ما</strong>
                        <span>{{ $options['site_description'] }}</span>
                    </div><!-- /.footer-address -->

                    <div class="footer-social-icons">
                        <ul class="social-icons list-unstyled">
                            <li><a class="fa fa-facebook" href="{{ $options['social_link']->facebook }}"></a> فیس بوک</li>
                            <li><a class="fa fa-twitter" href="{{ $options['social_link']->twitter }}"></a> توییتر</li>
                            <li><a class="fa fa-instagram" href="{{ $options['social_link']->instagram }}"></a> اینستاگرام</li>
                            <li><a class="fa fa-comments-o" href="{{ $options['social_link']->telegram }}"></a> تلگرام</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="pull-left flip copyright">طراح و برنامه نویس وبسایت : <a href="tel:+989105009868">امیرخدنگی</a> | &copy; کلیه حقوق وبسایت محفوظ است</div>
            <div class="pull-right flip payment">
                <div class="footer-payment-logo">
                    {{-- <ul class="cash-card card-inline">
                        <li><a style="" class="fa fa-instagram" href="{{ $options['social_link']->instagram }}"></a> اینستاگرام</li>
                        <li><a class="fa fa-comments-o" href="{{ $options['social_link']->telegram }}"></a> تلگرام</li>
                    </ul> --}}
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->
</footer><!-- #colophon -->