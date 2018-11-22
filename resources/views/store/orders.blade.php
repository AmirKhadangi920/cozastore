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
		'vendor/perfect-scrollbar/perfect-scrollbar.css',
		'css/util.css',
		'css/main.css',
		'css/font.css',
	]; ?>

	@foreach ($styles as $style)
		<link rel="stylesheet" type="text/css" href="{{ asset($style) }}">
	@endforeach

	<style>
	table {
		text-align: center;
	}
	th {
		text-align: center !important;
	}
	.badge {
		padding: 5px 8px;
	}
	</style>
@endsection
	
@section('article')
	<!-- breadcrumb -->
	<div class="container" dir="rtl">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				صفحه اصلی
				<i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				سفارشات
			</span>
		</div>
	</div>

	<div class="container">
		<div class="row m-t-50 m-b-50">
			<div class="col-md-12" dir="rtl">

				@if(session()->has('message'))
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ session()->get('message') }}
					</div>
				@endif

				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><b>توضیحات شما</b></th>
							<th><b>تاریخ ثبت</b></th>
							<th><b>تاریخ پرداخت</b></th>
							<th><b>جمع فاکتور</b></th>
							<th><b>وضعیت</b></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($orders as $order)
						<tr>
							<td>{{++$i}}</td>
							<td>{{$order->buyer_description}}</td>
							<?php 
								$time = new Carbon\Carbon($order->created_at);
								$created_at = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '/');	
							?>
							<td>{{$time->hour.':'.$time->minute.' | '.$created_at}}</td>
							@if ($order->payment)
							<?php
								$time = new Carbon\Carbon($order->payment);
								$payment = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '/');	
							?>
							<td>{{$time->hour.':'.$time->minute.' | '.$payment}}</td>
							@else
							<td><span class="label label-danger">هنوز پرداخت نشده</span></td>
							@endif
							<td><span class="num-comma">{{$order->total}}</span> تومان</td>
							<td>
								<?php
								switch ($order->status) {
									case 0: $status = ['پرداخت نشده', 'info']; break;
									case 1: $status = ['در انتظار پرداخت', 'warning']; break; 
									case 2: $status = ['پرداخت شده', 'dark']; break;
									case 3: $status = ['در حال بررسی', 'warning']; break;
									case 4: $status = ['در حال بسته بندی', 'warning']; break;
									case 5: $status = ['در حال ارسال', 'primary']; break;
									case 6: $status = ['ارسال شده', 'success']; break;
									case 7: $status = ['لغو شده', 'danger']; break;
									default: $status = ['پرداخت نشده', 'info'];
								}
								?>
								<span class="badge badge-{{$status[1]}}">{{$status[0]}}</span>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
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
		<script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
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
					ps.update();
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

			$('.btn-num-product-up').click(function ()
			{
				var price = $(this).parent().parent().prev().find('.num-comma').text();
				var total = $(this).parent().parent().next().next().find('.num-comma');
				price = price.replace(/,/g, '') * 1;
				var output = numeral(total.text().replace(/,/g, '') * 1 + price).format('0,0');
				total.text(output);
				
				total = $('.total');
				output = numeral(total.text().replace(/,/g, '') * 1 + price).format('0,0');
				total.text(output);
				
				total = $('.final_total');
				output = numeral(total.text().replace(/,/g, '') * 1 + price).format('0,0');
				total.text(output);
			});

			$('.btn-num-product-down').click(function ()
			{
				if ($(this).next().val() == 0) { return; }
				var price = $(this).parent().parent().prev().find('.num-comma').text();
				var total = $(this).parent().parent().next().next().find('.num-comma');
				price = price.replace(/,/g, '') * 1;
				var output = numeral(total.text().replace(/,/g, '') * 1 - price).format('0,0');
				total.text(output);
				
				total = $('.total');
				output = numeral(total.text().replace(/,/g, '') * 1 - price).format('0,0');
				total.text(output);
				
				total = $('.final_total');
				output = numeral(total.text().replace(/,/g, '') * 1 - price).format('0,0');
				total.text(output);
			});
		</script>
		
		<script src="{{ asset('js/numeral.min.js') }}"></script>
		<script>
			var nums = document.getElementsByClassName('num-comma');

			for (num in nums) {
				nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
			}
		</script>

		<script src="{{ asset('js/main.js') }}"></script>
@endsection