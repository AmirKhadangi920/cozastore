
<div class="single-product-wrapper">
    <div class="product-images-wrapper">
        <span class="onsale">تصاویر محصول</span>
        <div class="images electro-gallery">
            <div class="thumbnails-single owl-carousel">
                @foreach ($product->gallery as $item)
                    <a href="{{ $item }}" class="zoom" title="" data-rel="prettyPhoto[product-gallery]"><img src="/assets/images/blank.gif" data-echo="{{ $item }}" class="wp-post-image" alt=""></a>
                @endforeach
            </div><!-- .thumbnails-single -->

            <div class="thumbnails-all columns-5 owl-carousel">
                @foreach ($product->gallery as $item)
                    <a href="{{ $item }}" class="@if($loop->first) first @elseif($loop->last) last @endif" title=""><img src="/assets/images/blank.gif" data-echo="{{ $item }}" class="wp-post-image" alt=""></a>
                @endforeach
            </div><!-- .thumbnails-all -->
        </div><!-- .electro-gallery -->
    </div><!-- /.product-images-wrapper -->

    <div class="summary entry-summary">

        <span class="loop-product-categories">
            <a href="/category/{{ $product->category->id }}" rel="tag">{{ $product->category->title }}</a>
        </span><!-- /.loop-product-categories -->

        <h1 itemprop="name" class="product_title entry-title">{{ $product->name }}</h1>

        <div class="woocommerce-product-rating">
            <div class="star-rating" title="Rated 4.33 out of 5">
                <span style="width:86.6%">
                    <strong itemprop="ratingValue" class="rating">4.33</strong>
                    out of <span itemprop="bestRating">5</span>				based on
                    <span itemprop="ratingCount" class="rating">3</span>
                    customer ratings
                </span>
            </div>

            <a class="woocommerce-review-link">( <span itemprop="reviewCount" class="count">{{ $product->reviews->count() }}</span> نظر برای این محصول ثبت شده است )</a>
        </div><!-- .woocommerce-product-rating -->

        <div class="brand">
            <span>برند محصول : <strong>{{ $product->brand->title }} </strong></span>
        </div><!-- .brand -->

        <div class="availability">
            | وضعیت : 
            @if($product->label)
                @switch($product->label)
                    @case(1) <span class="label label-danger">توقف تولید</span> @break
                    @case(2) <span class="label label-primary">به زودی</span> @break
                    @case(3) <span class="label label-warning">نا موجود</span> @break
                    @case(4) <span class="label label-info">عدم فروش</span> @break
                @endswitch
            @endif
        </div><!-- .availability -->

        <hr class="single-product-title-divider" />

        <div class="action-buttons">
            <a href="#" class="add-to-compare-link" data-product_id="2452"> افزودن محصول برای مقایسه </a>
        </div><!-- .action-buttons -->

        <div itemprop="description">
            @if (!empty($product->advantages) || !empty($product->disadvantages))
                <ul>
                    @foreach (explode(',', $product->advantages) as $advantage)
                        <li>{{$advantage}}</li>
                    @endforeach
                </ul>
            @endif


            {{ $product->short_description }}<br/><br/>
            <p><strong>کد محصول</strong>: {{ $product->code }}</p>
        </div><!-- .description -->

        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

            <p class="price">
                <span class="electro-price">
                    @php
                        if ($product->variations[0]->unit)
                        {
                            $product->variations[0]->offer *= $options['dollar_cost'];
                            $product->variations[0]->price *= $options['dollar_cost'];
                        }
                    @endphp

                    @if($product->variations[0]->offer && $product->variations[0]->deadline->gt(now()) )
                        <ins><span class="amount"><span class="num-comma">{{ $product->variations[0]->offer }}</span> تومان</span></ins>
                        <del><span class="amount"><span class="num-comma">{{ $product->variations[0]->price }}</span> تومان</span></del>
                    @else
                        <span class="amount"><span class="num-comma">{{ $product->variations[0]->price }}</span> تومان</span></span>
                    @endif
                </span>
            </p>

            <meta itemprop="price" content="1215" />
            <meta itemprop="priceCurrency" content="IR" />
            <link itemprop="availability" href="http://schema.org/InStock" />

        </div><!-- /itemprop -->

        <form action="/cart/add/{{ $product->variations[0]->id }}" method="GET" class="variations_form cart">

            <table class="variations">
                <tbody>
                    <tr>
                        <td class="label"><label>رنگ و گارانتی</label></td>
                        <td class="value">
                            <select onchange="this.parentNode.parentNode.parentNode.parentNode.parentNode.action = '/cart/add/' + this.value">
                                @foreach ($product->variations as $item)
                                    <option value="{{ $item->id }}">رنگ {{ $item->color->name }} - گارانتی {{ $item->warranty->title }} {{ $item->warranty->expire }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>


            <div class="single_variation_wrap">
                <div class="woocommerce-variation single_variation"></div>
                <div class="woocommerce-variation-add-to-cart variations_button">
                    <div class="quantity">
                        <label>تعداد :</label>
                        <input type="number" name="quantity" min="0" max="20" value="1" class="input-text qty text"/>
                    </div>
                    <button type="submit" class="single_add_to_cart_button button">افزودن به سبد خرید</button>
                </div>
            </div>
        </form>

    </div><!-- .summary -->
</div><!-- /.single-product-wrapper -->