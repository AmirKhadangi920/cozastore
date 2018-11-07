@extends('store.master.main')

@section('styles')
	<?php $styles = [
		'vendor/bootstrap/css/bootstrap.min.css',
		'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
		'fonts/iconic/css/material-design-iconic-font.min.css',
		'fonts/linearicons-v1.0.0/icon-font.min.css',
		'vendor/animate/animate.css',
		'vendor/css-hamburgers/hamburgers.min.css',
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
	.block2 {
		box-shadow: 0px 0px 20px -10px #000;
		padding: 10px;
	}
	
	.block2-btn.js-show-modal1 {
		box-shadow: 0px 0px 20px -7px #000;
	}
	.product-card {
		float: right !important;
	}
	.badge {
		position: absolute;
		top: 0px;
		left: 0px;
		padding: 6px 8px 4px;
		box-shadow: 0px 0px 20px -5px #000;
	}
	</style>
@endsection

@section('article')
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140" dir="rtl">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52" dir="rtl">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						همه محصولات
					</button>

					<?php $group_temp = ''; $groups = []; ?>
					@foreach ($products as $product)
						@if(!in_array($product->id, $groups) && $product->id)
							<?php $group_temp = $product->title; $groups[] = $product->id ?>
							<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{'group'.$product->id}}">
								{{$product->title}}
							</button>
						@endif
					@endforeach
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-l-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-l-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-l-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						فیلتر
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-l-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-l-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						جست و جو
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<input onkeyup="this.nextElementSibling.href = '/products/1/{{$filter['order']}}/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}/'+this.value" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" value="{{$filter['query']}}" placeholder="جستجو ...">
						
						
						<a href="/products/1/{{$filter['order']}}/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</a>
					</div>	
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								مرتب سازی بر اساس
							</div>

							<ul>
								<li class="p-b-6">
									<a href="/products/1/expensivest/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='expensivest') filter-link-active @endif">
										گرانترین
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products/1/cheapest/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='cheapest') filter-link-active @endif">
										ارزانترین
									</a>
								</li>

								
								<li class="p-b-6">
									<a href="/products/1/newest/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='newest') filter-link-active @endif">
										جدید ترین
									</a>
								</li>

								
								<li class="p-b-6">
									<a href="/products/1/oldest/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='oldest') filter-link-active @endif">
										قدیمی ترین
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col2 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								قیمت 
							</div>

							<ul>
								<li class="p-b-6">
									<a href="/products/1/{{$filter['order']}}/all/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='all') filter-link-active @endif">
										همه
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products/1/{{$filter['order']}}/0to500/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='0to500') filter-link-active @endif">
										0 - 500 هزار تومان
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products/1/{{$filter['order']}}/500to1000/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='500to1000') filter-link-active @endif">
										500 - 1000 هزار تومان
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products/1/{{$filter['order']}}/1000to2000/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='1000to2000') filter-link-active @endif">
										1000 - 2000 هزار تومان
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products/1/{{$filter['order']}}/2000toend/{{$filter['color']}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='2000toend') filter-link-active @endif">
										2000 هزار تومان به بالا
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col3 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								رنگ
							</div>

							<ul>
								<?php $colors = [
									['blue', 'آبی'],
									['green', 'سبز'],
									['yellow', 'زرد'],
									['brown', 'قهوه ای'],
									['violet', 'بنفش'],
									['orange', 'نارنجی'],
									['red', 'قرمز'],
									['black', 'مشکی'],
									['white', 'سفید'],
								]; ?>
								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: transparent;">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="/products/1/{{$filter['order']}}/{{$filter['price']}}/all/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['color']=='all') filter-link-active @endif">
										همه
									</a>
								</li>
								@foreach ($colors as $color)
								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: {{$color[0]}};">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="/products/1/{{$filter['order']}}/{{$filter['price']}}/{{$color[0]}}/{{$filter['keyword']}}/{{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['color']==$color[0]) filter-link-active @endif">
										{{$color[1]}}
									</a>
								</li>
								@endforeach
							</ul>
						</div>

						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								بر چسب ها
							</div>

							<div class="flex-w p-t-4 m-r--5">
								<?php $keywords = [
									'گوشی هوشمند',
									'ساعت هوشمند',
									'برچسب',
									'گلس'
								]; ?>
								<a href="/products/1/{{$filter['order']}}/{{$filter['price']}}/{{$filter['color']}}/{{$filter['query']}}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 @if($filter['keyword']=='all') filter-link-active @endif">
									همه
								</a>
								@foreach ($keywords as $keyword)
								<a href="/products/1/{{$filter['order']}}/{{$filter['price']}}/{{$filter['color']}}/{{$keyword}}/{{$filter['query']}}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 @if($filter['keyword']==$keyword) filter-link-active @endif">
									{{$keyword}}
								</a>
								@endforeach
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="row isotope-grid">
				@empty ($products[0])
				<div class="col-sm-12 col-md-12 col-lg-12 p-b-35 mb-35">
					<div class="alert alert-warning alert-dismissable">
						<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
						<p class="pull-right">متاسفانه هیچ محصولی یافت نشد !</p>
						<div class="clearfix"></div>
					</div>
				</div>
				@else
					@foreach ($products as $product)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 product-card isotope-item {{'group'.$product->id}}">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								
								<img src="{{asset('/uploads/'.$product->photo)}}" alt="IMG-PRODUCT">

								<a href="{{$product->pro_id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									مشاهده سریع
								</a>

								<span class="badge badge-dark">{{$product->title}}</span>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l">
									<a href="/product/{{$product->pro_id}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<b>{{$product->name}}</b>
									</a>

									<?php if ($product->unit) {
										$product->price = $product->price * $dollar_cost;
									} ?>
									@empty ($product->offer)
									<span class="stext-105 cl3">
										<span class="num-comma">{{$product->price}}</span> تومان
									</span>
									@else
									<?php $product->offer = $product->price - ($product->offer * $product->price) / 100; ?>
									<span class="stext-105 cl3">
										<del><span class="num-comma">{{$product->price}}</span> تومان</del>
										<span class="num-comma">{{$product->offer}}</span> تومان
									</span>
									@endempty
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>

									
								</div>
							</div>
						</div>
						<input type="hidden" id="pro_id" value="{{$product->pro_id}}}" />
					</div>
					@endforeach
				@endempty
			</div>

			@if (!empty($products[0]) && $product_count > 10)
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
					<li class="page-item @if($page == 1) disabled @endif">
						<a class="page-link" href="/products/{{$page - 1}}/{{$filter['order']}}/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}" tabindex="-1">قبلی</a>
					</li>
					@for ($i = 1; $i <= ceil($product_count / 10); $i++)
					<li class="page-item @if($page == $i) active @endif">
						<a class="page-link" href="/products/{{$i}}/{{$filter['order']}}/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}">
							{{$i}}
						</a>
					</li>
					@endfor
					<li class="page-item @if($page == $i - 1) disabled @endif">
						<a class="page-link" href="/products/{{$page + 1}}/{{$filter['order']}}/{{$filter['price']}}/{{$filter['color']}}/{{$filter['keyword']}}">بعدی</a>
					</li>
				</ul>
			</nav>
			@endif
		</div>
	</div>
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
					// ps.update();
				})
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
	
		<script src="{{ asset('js/main.js') }}"></script>
		<script>var dollar_cost = {{$dollar_cost}};</script>
		<script src="{{ asset('dist/js/quickview.js') }}"></script>
@endsection