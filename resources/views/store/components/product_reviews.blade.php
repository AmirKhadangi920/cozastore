<div class="tab-pane panel entry-content wc-tab" id="tab-reviews">
    <div id="reviews" class="electro-advanced-reviews">
        <div class="advanced-review row">
            <div class="col-xs-12 col-md-6">
                <h2 class="based-title">بر اساس {{ $reviews->count() }} نظر</h2>
                <div class="avg-rating">
                    @php
                        $value_rating = $reviews->avg('value');
                        $quality_rating = $reviews->avg('quality');
                        $design_rating = $reviews->avg('design');
                        $total_rating = $reviews->avg('total');
                    @endphp
                    <span class="avg-rating-number">{{ substr(($value_rating + $quality_rating + $design_rating + $total_rating)/4, 0, 4) }}</span> در مجموع
                </div>

                <div class="rating-histogram">
                    <div class="rating-bar">
                        <div>
                            <span style="width: 100px;display: inline-block">ارزش خرید :</span>
                            <h4 class="text-danger" style="display:inline">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($value_rating-- > 0)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endif
                                @endfor
                            </h4>
                            <h4 style="margin-right: 10px;display:inline">{{ substr($reviews->avg('value'), 0, 4) }}</h4>
                        </div>
                    </div><!-- .rating-bar -->

                    <div class="rating-bar">
                        <div>
                            <span style="width: 100px;display: inline-block">کیفیت ساخت :</span>
                            <h4 class="text-danger" style="display:inline">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($quality_rating-- > 0)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endif
                                @endfor
                            </h4>
                            <h4 style="margin-right: 10px;display:inline">{{ substr($reviews->avg('quality'), 0, 4) }}</h4>
                        </div>
                    </div><!-- .rating-bar -->

                    <div class="rating-bar">
                        <div>
                            <span style="width: 100px;display: inline-block">طراحی و ظاهر :</span>
                            <h4 class="text-danger" style="display:inline">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($design_rating-- > 0)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endif
                                @endfor
                            </h4>
                            <h4 style="margin-right: 10px;display:inline">{{ substr($reviews->avg('design'), 0, 4) }}</h4>
                        </div>
                    </div><!-- .rating-bar -->

                    <div class="rating-bar">
                        <div>
                            <span style="width: 100px;display: inline-block">امتیاز کلی :</span>
                            <h4 class="text-danger" style="display:inline">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($total_rating-- > 0)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endif
                                @endfor
                            </h4>
                            <h4 style="margin-right: 10px;display:inline">{{ substr($reviews->avg('total'), 0, 4) }}</h4>
                        </div>
                    </div><!-- .rating-bar -->
                </div>
            </div><!-- /.col -->

            <div class="col-xs-12 col-md-6">
                <div id="review_form_wrapper">
                    <div id="review_form">
                        <div id="respond" class="comment-respond">
                            <h3 id="reply-title" class="comment-reply-title">ثبت نظر جدید
                                <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel reply</a>
                                </small>
                            </h3>

                            @auth
                                <form action="/product/{{ $product_id }}/review" method="POST" id="commentform" class="comment-form">
                                    <p class="comment-form-rating">
                                        <label>ارزش خرید</label>
                                        <span class="rateYo"></span>
                                        <input type="hidden" name="value" value="3" />
                                    </p>
                                    <p class="comment-form-rating">
                                        <label>کیفیت ساخت</label>
                                        <span class="rateYo"></span>
                                        <input type="hidden" name="quality" value="3" />
                                    </p>
                                    <p class="comment-form-rating">
                                        <label>طراحی و ظاهر</label>
                                        <span class="rateYo"></span>
                                        <input type="hidden" name="design" value="3" />
                                    </p>
                                    <p class="comment-form-rating">
                                        <label>امتیاز کلی</label>
                                        <span class="rateYo"></span>
                                        <input type="hidden" name="total" value="3" />
                                    </p>

                                    <p class="comment-form-comment">
                                        <label for="comment">نظر شما</label>
                                        <textarea id="comment" name="review" cols="45" rows="8" aria-required="true"></textarea>
                                    </p>

                                    <p class="form-submit">
                                        <input name="submit" type="submit" id="submit" class="submit" value="ثبت نظر" />
                                    </p>
                                    @csrf
                                </form><!-- form -->
                            @else
                                <div class="alert alert-danger">
                                    برای ثبت نظر ابتدا باید وارد حساب خود شوید !
                                </div>
                                <form action="/product/{{ $product_id }}/review" method="POST">
                                    @csrf
                                    <input type="submit" value="ورود به حساب" class="btn btn-danger">
                                </form>
                            @endauth
                        </div><!-- #respond -->
                    </div>
                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->

        <div id="comments">

            <ol class="commentlist">
                @foreach ($reviews as $item)
                    <li class="comment odd alt thread-odd thread-alt depth-1">

                        <div class="comment_container">

                            <img alt='' src="/assets/images/blog/avatar.jpg" class='avatar' height='60' width='60' />
                            <div class="comment-text">

                                <div>
                                    <div>
                                        <span style="width: 100px;display: inline-block">ارزش خرید :</span>
                                        <span class="text-danger">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($item->value-- > 0)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                    <div>
                                        <span style="width: 100px;display: inline-block">کیفیت ساخت :</span>
                                        <span class="text-danger">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($item->quality-- > 0)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                    <div>
                                        <span style="width: 100px;display: inline-block">طراحی و ظاهر :</span>
                                        <span class="text-danger">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($item->design-- > 0)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                    <div>
                                        <span style="width: 100px;display: inline-block">امتیاز کلی :</span>
                                        <span class="text-danger">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($item->total-- > 0)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                </div>


                                <div itemprop="description" class="description" style="margin-top: 15px;border-right: 3px solid #b71d1d;padding-right: 10px">
                                    <p>{{ $item->review }}</p>
                                </div>

                                <p class="meta">
                                    <strong itemprop="author"><i class="fa fa-user" aria-hidden="true"></i> {{ $item->user->full_name }}</strong> &ndash; <time itemprop="datePublished" datetime="2016-03-03T14:14:47+00:00"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ \Morilog\Jalali\Jalalian::forge($item->updated_at)->ago() }}</time>
                                </p>

                            </div>
                        </div>
                    </li><!-- #comment-## -->
                @endforeach
            </ol><!-- /.commentlist -->

        </div><!-- /#comments -->

        <div class="clear"></div>
    </div><!-- /.electro-advanced-reviews -->
</div><!-- /.panel -->