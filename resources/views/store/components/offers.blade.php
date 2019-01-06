
<div class="home-v1-deals-and-tabs deals-and-tabs row animate-in-view fadeIn animated" data-animation="fadeIn">
    <div class="deals-block col-lg-4">
        @php $special = $offers['mostـurgent'][0] @endphp
        <section class="section-onsale-product">
            <header>
                <h2 class="h1">تخفیف ویژه</h2>
                <div class="savings">
                    <span class="savings-text">
                        <span class="amount">
                            {{ round( ($special->price - $special->offer) * 100 / $special->price) }} %
                        </span>
                        درصد تخفیف
                    </span>
                </div>
            </header><!-- /header -->

            <div class="onsale-products">
                <div class="onsale-product">
                    <a href="/product/{{ $offers['mostـurgent'][0]->product->id }}">
                        <div class="product-thumbnail">
                            <img class="wp-post-image" data-echo="{{ $offers['mostـurgent'][0]->product->photo }}" src="assets/images/blank.gif" alt="{{ $offers['mostـurgent'][0]->product->name }}">
                        </div>

                        <h3>{{ $offers['mostـurgent'][0]->product->name }}</h3>
                    </a>

                    <span class="price">
                        <span class="electro-price">
                            @php
                                if ($offers['mostـurgent'][0]->unit)
                                {
                                    $offers['mostـurgent'][0]->offer *= $options['dollar_cost'];
                                    $offers['mostـurgent'][0]->price *= $options['dollar_cost'];
                                }
                            @endphp
                            <ins><span class="amount"><span class="num-comma">{{ $offers['mostـurgent'][0]->offer }}</span> تومان</span></ins><br/>
                            <del><span class="amount"><span class="num-comma">{{ $offers['mostـurgent'][0]->price }}</span> تومان</span></del>
                            <span class="amount"> </span>
                        </span>
                    </span><!-- /.price -->

                    <div class="deal-progress">
                        <div class="deal-stock">
                            <span class="stock-sold">موجودی: <strong>{{ $offers['mostـurgent'][0]->stock_inventory }}</strong></span>
                            <span class="stock-available">میزان تخفیف: <strong class="num-comma">{{ $offers['mostـurgent'][0]->price - $offers['mostـurgent'][0]->offer }}</strong> تومان</span>
                        </div>
                    </div><!-- /.deal-progress -->

                    <div class="deal-countdown-timer">
                        <div class="marketing-text text-xs-center">عجله کنید ، تخفیف به زودی به پایان میرسد !</div>


                        <div id="deal-countdown" class="countdown">
                            <span data-value="0" class="days"><span class="value"></span><b>روز</b></span>
                            <span class="hours"><span class="value"></span><b>ساعت</b></span>
                            <span class="minutes"><span class="value"></span><b>دقیقه</b></span>
                            <span class="seconds"><span class="value"></span><b>ثانیه</b></span>
                        </div>
                        <span class="deal-end-date" style="display:none;">{{ $offers['mostـurgent'][0]->offer_deadline }}</span>
                        <script>
                        // set the date we're counting down to
                        var deal_end_date = document.querySelector(".deal-end-date").textContent;
                        var target_date = new Date( deal_end_date ).getTime();

                        // variables for time units
                        var days, hours, minutes, seconds;

                        // get tag element
                        var countdown = document.getElementById( 'deal-countdown' );

                        // update the tag with id "countdown" every 1 second
                        setInterval( function () {

                        // find the amount of "seconds" between now and target
                        var current_date = new Date().getTime();
                        var seconds_left = (target_date - current_date) / 1000;

                        // do some time calculations
                        days = parseInt(seconds_left / 86400);
                        seconds_left = seconds_left % 86400;

                        hours = parseInt(seconds_left / 3600);
                        seconds_left = seconds_left % 3600;

                        minutes = parseInt(seconds_left / 60);
                        seconds = parseInt(seconds_left % 60);

                        // format countdown string + set tag value
                        countdown.innerHTML = '<span data-value="' + days + '" class="days"><span class="value">' + days +  '</span><b>روز</b></span><span class="hours"><span class="value">' + hours + '</span><b>ساعت</b></span><span class="minutes"><span class="value">'
                        + minutes + '</span><b>دقیقه</b></span><span class="seconds"><span class="value">' + seconds + '</span><b>ثانیه</b></span>';

                        }, 1000 );
                        </script>
                    </div><!-- /.deal-countdown-timer -->
                </div><!-- /.onsale-product -->
            </div><!-- /.onsale-products -->
        </section><!-- /.section-onsale-product -->
    </div><!-- /.col -->


    <div class="tabs-block col-lg-8">
        <div class="products-carousel-tabs">
            <ul class="nav nav-inline">
                <li class="nav-item"><a class="nav-link active" href="#tab-products-1" data-toggle="tab">فوری ترین تخفیفات</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab-products-2" data-toggle="tab">بیشترین تخفیفات</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                    <div class="woocommerce columns-3">

                        <ul class="products columns-3">
                            @php $i = 1 @endphp
                            @foreach ($offers['mostـurgent'] as $item)
                                @productCard([
                                    'product' => $item->product,
                                    'variation' => $item,
                                    'dollar_cost' => $options['dollar_cost'],
                                    'i' => $i++,
                                ])@endproductCard
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="tab-pane" id="tab-products-2" role="tabpanel">
                    <div class="woocommerce columns-3">
                        <ul class="products columns-3">
                            @php $i = 1 @endphp
                            @foreach ($offers['the_most'] as $item)
                                @productCard([
                                    'product' => $item->product,
                                    'variation' => $item,
                                    'dollar_cost' => $options['dollar_cost'],
                                    'i' => $i++,
                                ])@endproductCard
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.tabs-block -->
</div><!-- /.deals-and-tabs -->