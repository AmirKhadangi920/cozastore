<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32"  dir="rtl">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    موضوعات
                </h4>

                <ul>
                    @foreach ($top_groups as $group)
                    <li class="p-b-10">
                        <a href="/products?category={{$group->id}}&category_name={{$group->title}}" class="stext-107 cl7 hov-cl1 trans-04">
                            {{$group->title}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    لینک های فروشگاه
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="/" class="stext-107 cl7 hov-cl1 trans-04">
                            صفحه اصلی
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/cart" class="stext-107 cl7 hov-cl1 trans-04">
                            سبد خرید
                        </a>
                    </li>
                    
                    <li class="p-b-10">
                        <a href="/products" class="stext-107 cl7 hov-cl1 trans-04">
                            محصولات 
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/login" class="stext-107 cl7 hov-cl1 trans-04">
                            ورود 
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/register" class="stext-107 cl7 hov-cl1 trans-04">
                            ثبت نام 
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    با کسب و کار ما آشنا شوید
                </h4>

                <p class="stext-107 cl7 size-201">{{ $options['site_description'] }}</p>

                <div class="p-t-27">
                    @if ($options['social_link']->facebook)
                    <a href="{{ $options['social_link']->facebook }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>
                    @endif
                    
                    @if ($options['social_link']->instagram)
                    <a href="{{ $options['social_link']->instagram }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>
                    @endif
                    
                    @if ($options['social_link']->twitter)
                    <a href="{{ $options['social_link']->twitter }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-twitter"></i>
                    </a>
                    @endif
                    
                    @if ($options['social_link']->telegram)
                    <a href="{{ $options['social_link']->telegram }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-telegram"></i>
                    </a>
                    @endif
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    خبرنامه
                </h4>

                <p class="stext-107 m-b-5" style="color:gold;">متاسفانه خبرنامه در حال حاضر فعال نیست !</p>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            عضویت
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-0">
            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> تمام حقوق این قالب محفوظ است | ترجمه شده <i class="fa fa-heart-o" aria-hidden="true"></i> توسط <a href="tel:09105009868">SmaT Teamwork</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
        </div>
    </div>
</footer>