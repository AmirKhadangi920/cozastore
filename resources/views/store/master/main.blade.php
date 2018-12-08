<?php if (!isset($cart_products)) { $cart_products = []; } ?>

<!DOCTYPE html>
<html lang="fa" dir="ltr">
<head>
	<title>{{ $options['site_name'] }} @isset($page_title) | {{$page_title}} @endisset</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@isset($product->keywords)
	<meta name="keywords" content="{{$product->keywords}}">
	@endisset
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>
	@yield('styles')
	
	<style>
	.sub-menu {
		position: absolute;
		top: 0px;
		left: -105%;
		background: #fff;
		box-shadow: 0px 0px 9px -3px #000;
		width: 80%;
	}
	</style>
</head>
<body class="animsition">
	
	@include('store.master.header')


	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart"  dir="rtl">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					سبد خرید شما
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php $total_cart = 0; ?>
					@empty($cart_products[0])
					@else
						@foreach ($cart_products as $product)
						<li class="header-cart-item flex-w flex-t m-b-12">
							<div class="header-cart-item-img" onclick="window.location = '/cart/remove/{{$product->pro_id}}/{{$product->name}}'">
								<img src="{{ asset('uploads/'.$product->photo) }}" alt="IMG">
							</div>

							<div class="header-cart-item-txt p-t-8">
								<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
									{{$product->name}}
								</a>

								<?php
								$price = $product->price;
								if ($product->unit)
									$price = $price * $dollar_cost;
	
								if ($product -> offer != 0)
									$price = $price - ($product->offer * $price) / 100;
								
								$total_cart += $price * $product->count;
								?>
								<span class="header-cart-item-info">
									{{$product->count}} * <span class="num-comma">{{ceil($price / 1000)}}</span> هزار تومان
								</span>
							</div>
						</li>
						<hr/>
						@endforeach
					@endif
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						مجموع <span class="num-comma">{{ceil($total_cart / 1000)}}</span> هزار تومان
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="/cart" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-l-8 m-b-10">
							دیدن سبد خرید
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

		
    @yield('article')

	@include('store.master.footer')

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">					
					<div class="col-md-6 col-lg-5 p-b-30" dir="rtl">
						<div class="p-l-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14"></h4>

							<span class="mtext-106 cl2 price"></span>

							<p class="stext-102 cl3 p-t-23 short-description"></p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										رنگ
									</div>

									<div class="size-204 respon6-next colors-input">
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-l-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											افزودن به سبد
										</button>
									</div>
								</div>	
							</div>
						</div>
					</div>

					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w product-gallery">
								
							</div>
						</div>
					</div>

					<div class="col-md-8 mx-auto p-b-30 video"></div>
				</div>
			</div>
		</div>
	</div>

    @yield('scripts')

</body>
</html>
