@extends('store.master.main')

@section('styles')
	<?php $styles = [
		'vendor/bootstrap/css/bootstrap.min.css',
		'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
		'fonts/iconic/css/material-design-iconic-font.min.css',
		'fonts/linearicons-v1.0.0/icon-font.min.css',
		'vendor/animate/animate.css',
		// 's-hamburgers/hamburgers.min.css',
		'vendor/animsition/css/animsition.min.css',
		'vendor/select2/select2.min.css',
		'vendor/daterangepicker/daterangepicker.css',
		'vendor/slick/slick.css',
		'vendor/MagnificPopup/magnific-popup.css',
		'vendor/perfect-scrollbar/perfect-scrollbar.css',
		'css/util.css',
		'css/main.css',
		'css/font.css',
	]; ?>

	@foreach ($styles as $style)
		<link rel="stylesheet" type="text/css" href="{{ asset($style) }}">
	@endforeach

	<style>
	#information ul h3 {
		margin-top: 30px;
		font-weight: bold;
	}
	
	#information ul li:first-of-type h3 {
		margin-top: 0px;
	}
	.badge {
		border-radius: 50%;
		width: 25px;
		height: 25px;
		padding: 0px;
		transition: all 300ms;
		float: right;
		margin-left: 10px;
	}
	.badge i {
		padding-top: 7px;
		opacity: 0;
	}
	label:first-of-type .badge {
		top: 6px;
		position: relative;
	}
	input[type="radio"] {
		display: none;
	}
	input[type="radio"]:checked + label > span {
		width: 50px;
		border-radius: 30px;
		box-shadow: 0px 0px 10px -2px rgba(0, 0, 0, 0.5)
	}
	input[type="radio"]:checked + label > span i {
		opacity: 1;
	}
	</style>
@endsection

@section('article')
	<!-- breadcrumb -->
	<div class="container" dir="rtl">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="/products" class="stext-109 cl8 hov-cl1 trans-04">
				فروشگاه
				<i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
		
			@for ($i = count($breadcrumb) - 2; $i >= 0; --$i)
			<a href="/products?category={{$breadcrumb[$i][0]->id}}&category_name={{$breadcrumb[$i][0]->title}}" class="stext-109 cl8 hov-cl1 trans-04">
				{{$breadcrumb[$i][0]->title}}
				<i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			@endfor
			
			<?php $last = count($breadcrumb) - 1; ?>
			<a href="/products?category={{$breadcrumb[$last][0]->id}}&category_name={{$breadcrumb[$last][0]->title}}" class="stext-109 cl8 hov-cl1 trans-04">
				{{$breadcrumb[$last][0]->title}}
				<i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				{{$product->name}}
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-30 {{--p-b-60--}}p-b-0">
		<div class="container">
			<div class="row">		
				<div class="col-md-12 p-b-30" dir="rtl">
					<div class="panel-body">
						@foreach ($errors -> all() as $message)
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{ $message }} 
							</div>
						@endforeach
	
						@if(session()->has('message'))
							<div class="alert @if(session()->has('message_type')) alert-{{session()->get('message_type')}}  @else alert-success @endif alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{ session()->get('message') }}
							</div>
						@endif
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30" dir="rtl">
					<div class="p-r-0 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							{{$product->name}}
						</h4>

						@if(!$product->label && $product->stock_inventory != 0)
							<?php if ($product->unit) {
								$product->price = $product->price * $dollar_cost;
							} ?>
							@empty ($product->offer)
							<span class="mtext-106 cl2">
								<span class="num-comma">{{$product->price}}</span> تومان
							</span>
							@else
							<?php $product->offer = $product->price - ($product->offer * $product->price) / 100; ?>
							<span class="mtext-106 cl2">
								<del><span class="num-comma">{{$product->price}}</span> تومان</del>
								<span class="num-comma">{{$product->offer}}</span> تومان
							</span>
							@endempty
						@endif

						<p class="stext-102 cl3 p-t-23">
							{{$product->short_description}}
						</p>
						
						<!--  -->
						<div class="p-t-33">
							@if(!$product->label && $product->stock_inventory != 0)
								@if(!empty($product->colors))
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										رنگ
									</div>


									<div class="size-204 respon6-next">
										<?php $product->colors = explode(',', $product->colors) ?>
										@for ($i = 0; $i < count($product->colors); ++$i)
											<input type="radio" value="{{$product->colors[$i]}}" @if($i == 0) checked @endif name="color" id="color{{$i}}" />
											<label for="color{{$i}}">
												<span class="badge " style="background: {{$product->colors[$i]}};">
													<i class="fa fa-check" aria-hidden="true"></i>
												</span>
											</label>
										@endfor
									</div>
								</div>
								@endif

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-l-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>
	
											<input class="mtext-104 cl3 txt-center num-product" type="number" max="10" name="num-product" value="1">
	
											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
	
										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											اضافه به سبد خرید
										</button>
									</div>
								</div>
							@else
								@if($product->label)
									<?php switch ($product->label) {
										case 1: $product->label = 'توقف تولید شده است'; break;
										case 2: $product->label = 'به زودی عرضه خواهد شد'; break;
										case 3: $product->label = 'محصول نا موجود است'; break;
										case 4: $product->label = 'در حال حاضر این محصول به فروش نمیرسد'; break;
									} ?>
									<div class="alert alert-warning">{{ $product->label }}</div>
								@elseif($product->stock_inventory == 0)
									<div class="alert alert-warning">محصول موجود نیست</div>
								@endif
							@endif
						</div>

						<!--  -->
						{{-- <div class="flex-w flex-m p-l-100 p-t-40 respon7">
							<div class="flex-m bor9 p-r-10 m-r-11">
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
									<i class="zmdi zmdi-favorite"></i>
								</a>
							</div>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a>
						</div> --}}
					</div>
				</div>

				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								@if(!empty($product->gallery))
									@foreach (json_decode($product->gallery) as $photo)
									<div class="item-slick3" data-thumb="{{ asset('uploads/'.$photo) }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('uploads/'.$photo) }}" alt="IMG-PRODUCT">
	
											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('uploads/'.$photo) }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="bor10 {{--m-t-50--}} p-t-43 p-b-40" dir="rtl">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						
						@if (empty($product->aparat_video) && empty($product->full_description) && empty($product->advantages) && empty($product->disadvantages))
						@else 
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#description" role="tab">توضیحات</a>
						</li>
						@endif

						@if(!empty($product -> specifications))
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">مشخصات</a>
						</li>
						@endif

						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#reviews" role="tab">نظرات</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								

								@if (!empty($product->aparat_video))
								<div id="aparat_video" class="m-b-30">
									<script type="text/JavaScript" src="https://www.aparat.com/embed/{{$product->aparat_video}}?data[rnddiv]=aparat_video&data[responsive]=yes"></script>
								</div>
								
								<hr/>	
								@endif

								@if (!empty($product->full_description))
								<p class="stext-102 cl6">
									<?=$product->full_description?>
								</p>
								<hr/>
								@endif

								@if (!empty($product->advantages) || !empty($product->disadvantages))
								<div class="row">
									<div class="col-md-6 col-sm-12">
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
									<div class="col-md-6 col-sm-12">
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
							</div>
						</div>

						@if(!empty($product -> specifications))
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<ul class="p-lr-28 p-lr-15-sm">
										<?php 
											$specs = json_decode($product -> specs, true);
											$product -> specifications = json_decode($product -> specifications, true); 
										?>
										@if ($specs)
											@foreach ($specs as $item)
												<li>
													<h3>
														<i class="fa fa-angle-left m-l-9 m-r-10 text-primary" aria-hidden="true"></i>
														{{ $item['header'] }}
													</h3>
													<hr/>
												</li>
												@foreach ($item['items'] as $spec)
												<li>
													<li class="flex-w flex-t p-b-7 alert alert-secondary">
														<span class="stext-102 cl3 size-205">
															<b>{{ $spec['name'] }}</b>
														</span>
														
														<span class="stext-102 cl6 size-206">
															{{ $product -> specifications[ $item['value'] ][ $spec['value'] ] }}
															@isset($spec['label']) {{ $spec['label'] }} @endisset
														</span>
													</li>
												</li>
												@endforeach
											@endforeach
										@endif
									</ul>
								</div>
							</div>
						</div>
						@endif
						<!-- - -->
						<div class="tab-pane fade show active" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										@empty($reviews[0])

										@else
											@foreach ($reviews as $review)
											<div class="flex-w flex-t p-b-68">
												<div class="wrap-pic-s size-109 bor0 of-hidden m-l-18 m-t-6">
													@empty($review->avatar)
													<img src="{{ asset('images/user_avatar.jpg') }}" alt="AVATAR">
													@else
													<img src="{{ asset('uploads/avatars/'.$review->avatar) }}" alt="AVATAR">
													@endempty
												</div>
	
												<div class="size-207">
													<div class="flex-w flex-sb-m p-b-17">
														<span class="mtext-107 cl2 p-l-20">
															{{$review->fullname}}<br/>
															<span class="stext-102 cl16">{{$review->email}}</span>
														</span>
	
														<span class="fs-18 cl11">
															@for ($i = 0; $i < 5; ++$i)
																@if ($review->rating > 0)
																<i class="zmdi zmdi-star"></i>
																@else
																<i class="zmdi zmdi-star-outline"></i>
																@endif
																<?php --$review->rating ?>
															@endfor
														</span>
													</div>
	
													<p class="stext-102 cl6">
														{{$review->review}} 
													</p>
												</div>
											</div>
											@endforeach
										@endempty
										
										<!-- Add review -->
										<form action="/products/review" method="post" class="w-full">
											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-l-16">
													امتیاز شما
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">نظر شما</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">نام و نام خانوادگی</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="fullname">
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">آدرس ایمیل</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
												</div>
											</div>
											
											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												ارسال
											</button>
											
											<input type="hidden" name="product" value="{{$product->pro_id}}">
											@csrf
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15" dir="rtl">
			@if(!empty($product->code))
			<span class="stext-107 cl6 p-lr-25">
				<b>کد کالا :</b>
				{{$product->code}}
			</span>
			@endif

			<span class="stext-107 cl6 p-lr-25">
				<b>گروه محصول : &nbsp</b>

				@foreach ($breadcrumb as $item)
					{{$item[0]->title}}
					<i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
				@endforeach
				{{$product->name}}
			</span>
		</div>
	</section>

	
	{{-- <!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					محصولات مرتبط
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-01.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-02.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-03.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-04.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-05.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-06.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-07.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/product-08.jpg') }}" alt="IMG-PRODUCT">

								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										لورم ایپسوم متن ساختگی با تولید.
									</a>

									<span class="stext-105 cl3">
										30 هزار تومان
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
@endsection

@section('scripts')
	<!--===============================================================================================-->	
		<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
		<script>
			$(".js-select2").each(function(){
				$(this).select2({
					minimumResultsForSearch: 20,
					dropdownParent: $(this).next('.dropDownSelect2')
				});
			})
		</script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
		<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
		<script src="{{ asset('js/slick-custom.js') }}"></script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
		<script>
			$('.parallax100').parallax100();
		</script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
		<script>
			$('.gallery-lb').each(function() { // the containers for all your galleries
				$(this).magnificPopup({
					delegate: 'a', // the selector for gallery item
					type: 'image',
					gallery: {
						enabled:true
					},
					mainClass: 'mfp-fade'
				});
			});
		</script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
	<!--===============================================================================================-->
		<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
		<script>
			$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
				e.preventDefault();
			});

			$('.js-addwish-b2').each(function(){
				var nameProduct = $(this).parent().parent().find('.js-name-b2').php();
				$(this).on('click', function(){
					swal(nameProduct, "is added to wishlist !", "success");

					$(this).addClass('js-addedwish-b2');
					$(this).off('click');
				});
			});

			$('.js-addwish-detail').each(function(){
				var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').php();

				$(this).on('click', function(){
					swal(nameProduct, "is added to wishlist !", "success");

					$(this).addClass('js-addedwish-detail');
					$(this).off('click');
				});
			});

			/*---------------------------------------------*/

			$('.js-addcart-detail').each(function(){
				var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').php();
				$(this).on('click', function(){
					swal(nameProduct, "is added to cart !", "success");
				});
			});
		
		</script>
	<!--===============================================================================================-->
		<script src="{{ asset('js/numeral.min.js') }}"></script>
		<script>
			var nums = document.getElementsByClassName('num-comma');

			for (num in nums) {
				nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
			}
		</script>
	
		<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
		<script>
			$('.js-pscroll').each(function(){
				$(this).css('position','relative');
				$(this).css('overflow','hidden');
				var ps = new PerfectScrollbar(this, {
					wheelSpeed: 1,
					scrollingThreshold: 1000,
					wheelPropagation: false,
				});

				$(window).on('resize', function(){
					ps.update();
				})
			});
		</script>

		<script>
		$('.js-addcart-detail').click(function ()
		{
			var count = $(this).prev().find('input').val();
			var color = $("input[type='radio']:checked").val();
			window.location = '/cart/add/{{$product->pro_id}}/{{$product->name}}/' + count + '/' + color;
		});
		</script>
	<!--===============================================================================================-->
		<script src="{{ asset('js/main.js') }}"></script>
@endsection