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
	.badge.label {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		padding: 6px 10px;
		font-size: 20px;
		background: #9797979e;
		box-shadow: 0px 0px 10px #000;
	}
	.gray {
		-webkit-filter: grayscale(100%);
		filter: grayscale(100%);
	}
	.shadow {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0px;
		left: 0px;
		background: #00000085;
	}
	.badge.detail {
		position: absolute;
		top: 0px;
		left: 0px;
		padding: 6px 8px 4px;
		box-shadow: 0px 0px 20px -5px #000;
	}
	.badge.color {
		border-radius: 50%;
		width: 25px;
		height: 25px;
		padding: 0px;
		transition: all 300ms;
		float: right;
		margin-left: 10px;
	}
	.badge.color i {
		padding-top: 7px;
		opacity: 0;
	}
	label:first-of-type .badge.color {
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
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140" dir="rtl">
		<div class="container">
			<div class="col-md-12" dir="rtl">
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
			
			<div class="flex-w flex-sb-m p-b-52" dir="rtl">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					@isset($_GET['category_name'])
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						همه محصولات گروه <b>{{$_GET['category_name']}}</b>
					</button>
					
					<div class="bread-crumb flex-w p-l-25 p-r-30  p-lr-0-lg">
						<a href="/products" class="stext-109 cl8 hov-cl1 trans-04">
							همه گروه ها
							<i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
						</a>
					
						@if ($breadcrumb[0])
							@for ($i = count($breadcrumb) - 1; $i >= 0; --$i)
							<a href="/products?category={{$breadcrumb[$i][0]->id}}&category_name={{$breadcrumb[$i][0]->title}}" class="stext-109 cl8 hov-cl1 trans-04">
								{{$breadcrumb[$i][0]->title}}
								<i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
							</a>
							@endfor						
						@endif

						<span class="stext-109 cl4">
							{{$_GET['category_name']}}
						</span>
					</div>
					@else 
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
					@endisset
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
						<input onkeyup="this.nextElementSibling.href = '/products?page=1&order={{$filter['order']}}&price={{$filter['price']}}&color={{$filter['color']}}&keyword={{$filter['keyword']}}/'+this.value" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" value="@isset($_GET['query']) {{$_GET['query']}} @endisset" placeholder="جستجو ...">
						
						
						<a href="/products?page=1&order={{$filter['order']}}&price={{$filter['price']}}&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
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
									<a href="/products?page=1&order=expensivest&price={{$filter['price']}}&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='expensivest') filter-link-active @endif">
										گرانترین
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products?page=1&order=cheapest&price={{$filter['price']}}&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='cheapest') filter-link-active @endif">
										ارزانترین
									</a>
								</li>

								
								<li class="p-b-6">
									<a href="/products?page=1&order=newest&price={{$filter['price']}}&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='newest') filter-link-active @endif">
										جدید ترین
									</a>
								</li>

								
								<li class="p-b-6">
									<a href="/products?page=1&order=oldest&price={{$filter['price']}}&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['order']=='oldest') filter-link-active @endif">
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
									<a href="/products?page=1&order={{$filter['order']}}&price=all&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='all') filter-link-active @endif">
										همه
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products?page=1&order={{$filter['order']}}&price=0to500&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='0to500') filter-link-active @endif">
										0 - 500 هزار تومان
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products?page=1&order={{$filter['order']}}&price=500to1000&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='500to1000') filter-link-active @endif">
										500 - 1000 هزار تومان
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products?page=1&order={{$filter['order']}}&price=1000to2000&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='1000to2000') filter-link-active @endif">
										1000 - 2000 هزار تومان
									</a>
								</li>

								<li class="p-b-6">
									<a href="/products?page=1&order={{$filter['order']}}&price=2000toend&color={{$filter['color']}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['price']=='2000toend') filter-link-active @endif">
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

									<a href="/products?page=1&order={{$filter['order']}}&price={{$filter['price']}}&color=all&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['color']=='all') filter-link-active @endif">
										همه
									</a>
								</li>
								@foreach ($colors as $color)
								<li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: {{$color[0]}};">
										<i class="zmdi zmdi-circle"></i>
									</span>

									<a href="/products?page=1&order={{$filter['order']}}&price={{$filter['price']}}&color={{$color[0]}}&keyword={{$filter['keyword']}}&query={{$filter['query']}}" class="filter-link stext-106 trans-04 @if($filter['color']==$color[0]) filter-link-active @endif">
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
								<a href="/products?page=1&order={{$filter['order']}}&price={{$filter['price']}}&color={{$filter['color']}}&query={{$filter['query']}}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 @if($filter['keyword']=='all') filter-link-active @endif">
									همه
								</a>
								@foreach ($keywords as $keyword)
								<a href="/products?page=1&order={{$filter['order']}}&price={{$filter['price']}}&color={{$filter['color']}}&keyword={{$keyword}}&query={{$filter['query']}}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 @if($filter['keyword']==$keyword) filter-link-active @endif">
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
							<div class="block2-pic hov-img0 @if($product->label || $product->stock_inventory == 0) gray @endif">
								
								{{-- <img src="{{asset('/uploads/'.$product->photo)}}" alt="IMG-PRODUCT"> --}}
								<img src="{{$product->photo}}" alt="IMG-PRODUCT">

								@if(!$product->label && $product->stock_inventory != 0)
									<a href="{{$product->pro_id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
										مشاهده سریع
									</a>
								@endif

								@if($product->label)
									<?php switch ($product->label) {
										case 1: $product->label = 'توقف تولید'; break;
										case 2: $product->label = 'به زودی'; break;
										case 3: $product->label = 'نا موجود'; break;
										case 4: $product->label = 'عدم فروش'; break;
									} ?>
									<div class="shadow"></div> 
									<span class="badge label badge-dark">{{ $product->label }}</span>
								@elseif ($product->stock_inventory == 0)
									<div class="shadow"></div> 
									<span class="badge label badge-dark">نا موجود</span>
								@else
									<span class="badge detail badge-dark">{{$product->title}}</span>
								@endif
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l">
									<a href="/product/{{$product->id}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<b>{{$product->name}}</b>
									</a>

									@if(!$product->label && $product->stock_inventory != 0)
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
									@endif
								</div>

								@if(!$product->label && $product->stock_inventory != 0)
								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="/cart/add/{{$product->pro_id}}/{{$product->name}}/1">
										<i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 25px;"></i>
									</a>
								</div>
								@endif
							</div>
						</div>
						<input type="hidden" id="pro_id" value="{{$product->pro_id}}}" />
					</div>
					@endforeach
				@endempty
			</div>

			{{ $products->links() }}
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