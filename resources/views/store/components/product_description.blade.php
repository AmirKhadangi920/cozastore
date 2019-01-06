<div class="tab-pane panel entry-content wc-tab" id="tab-description">
    <div class="electro-description">
        @if (!empty($product->aparat_video))
            <div id="aparat_video" class="m-b-30">
                <script type="text/JavaScript" src="https://www.aparat.com/embed/{{$product->aparat_video}}?data[rnddiv]=aparat_video&data[responsive]=yes"></script>
            </div>
            
            <hr class="m-b-30" />
        @endif
        {!! $product->full_description !!}

        @if (!empty($product->advantages) || !empty($product->disadvantages))
            <hr class="m-b-30" />

            <div class="row">
                <div class="col-md-6 col-sm-12 advantages">
                    <ul>
                        @empty ($product->advantages)
                        <li>هیچ مزیتی برای این محصول ثبت نشده است .</li>
                        @else
                            <?php $product->advantages = explode(',', $product->advantages); ?>
                            @foreach ($product->advantages as $advantage)
                            <li>
                                <div class="alert alert-success" role="alert">
                                    {{$advantage}}
                                </div>
                            </li>
                            @endforeach
                        @endempty
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 disadvantages">
                    <ul>
                        @empty ($product->disadvantages)
                        <li>هیچ عیبی برای این محصول ثبت نشده است .</li>
                        @else
                            <?php $product->disadvantages = explode(',', $product->disadvantages); ?>
                            @foreach ($product->disadvantages as $disadvantage)
                            <li>
                                <div class="alert alert-danger" role="alert">
                                    {{$disadvantage}}
                                </div>
                            </li>
                            @endforeach
                        @endempty
                    </ul>
                </div>
            </div>
        @endif
    </div><!-- /.electro-description -->

    <div class="product_meta">
        <span class="sku_wrapper">کد محصول : <span class="sku" itemprop="sku">{{ $product->code }}</span></span>


        <span class="posted_in">گروه محصول :
            <a href="/category/{{ $product->category->id }}" rel="tag">{{ $product->category->title }}</a>
        </span>

        <span class="tagged_as">کلمات کلیدی :
            @foreach (explode(',', $product->keywords) as $item)
                <span rel="tag">{{ $item }}</span>@if(!$loop->last) , @endif
            @endforeach
        </span>

    </div><!-- /.product_meta -->
</div>