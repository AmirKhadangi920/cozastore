@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach
@endsection

@section('content')
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">داشبورد</a></li>
					<li><a href="#"><span>صفحات خاص</span></a></li>
					<li class="active"><span>جزئیات سفارش</span></li>
				</ol>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">جزئیات سفارش</h5>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-dark">مشخصات فاکتور</h6>
						</div>
						<div class="pull-left">
							<h6 class="txt-dark">فاکتور #12345</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6 text-right">
									<span class="txt-dark head-font inline-block capitalize-font mb-5">آدرس خریدار:</span>
									<address class="mb-15">
										<span class="address-head mb-5">خراسان رضوی ، مشهد</span>
										بین وکیل آباد 80 و 82<br>
										پلاک 13 ، واحد 1<br>
										<b>شماره تلفن : </b>09154321254
									</address>
								</div>
								<div class="col-xs-6">
									<span class="txt-dark head-font inline-block capitalize-font mb-5">آدرس مقصد ارسال سفارش:</span>
									<address class="mb-15">
										<span class="address-head mb-5">مشهد ، خراسان رضوی</span>
										بین دستغیب ، 15 و 17<br>
										واحد 1<br>
										<b>شماره تلفن : </b>09105009868
									</address>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-6">
									<address>
										<span class="txt-dark head-font capitalize-font mb-5">روش پرداخت:</span>
										<br>
										درگاه پرداخت زرین پال<br>
									</address>
								</div>
								<div class="col-xs-6 text-right">
									<address>
										<span class="txt-dark head-font capitalize-font mb-5">تاریخ سفارش:</span><br>
										1397/08/20<br>13:43<br>
									</address>
								</div>
							</div>
							
							<div class="seprator-block"></div>
							
							<div class="invoice-bill-table">
								<div class="table-responsive">
									<table class="table table-hover" id="invoice-table">
										<thead>
											<tr class="btn-success">
												<th>تصویر محصول</th>
												<th>نام محصول</th>
												<th>قیمت</th>
												<th>تعداد</th>
												<th>جمع</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><img src="{{ asset('images/products/V9 4GB 64GB Black - Vivo.jpg') }}" /></td>
												<td>اپل iPhone X</td>
												<td>10.99</td>
												<td>1</td>
												<td>10.99</td>
											</tr>
											<tr>
												<td><img src="{{ asset('images/products/V9 4GB 64GB Black - Vivo.jpg') }}" /></td>
												<td>اپل iPhone X</td>
												<td>20.00</td>
												<td>3</td>
												<td>60.00</td>
											</tr>
											<tr>
												<td><img src="{{ asset('images/products/V9 4GB 64GB Black - Vivo.jpg') }}" /></td>
												<td>اپل iPhone X</td>
												<td>600.00</td>
												<td>1</td>
												<td>600.00</td>
											</tr>
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td>جمع فاکتور</td>
												<td>670.99 تومان</td>
											</tr>
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td>هزینه ارسال</td>
												<td>15 تومان</td>
											</tr>
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td>تخفیف سفارش</td>
												<td>50 تومان</td>
											</tr>
											<tr class="txt-dark">
												<td></td>
												<td></td>
												<td></td>
												<td>جمع کلی</td>
												<td>635.99 تومان</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="button-list pull-right">
									<a class="btn btn-danger mr-10">مستردد شده</a>
									<a class="btn btn-orange mr-10">در حال بررسی</a>
									<a class="btn btn-warning mr-10">در حال بسته بندی</a>
									<a class="btn btn-primary mr-10">در حال ارسال</a>
									<a class="btn btn-success mr-10">ارسال شده</a>
								</div>

								<div class="button-list pull-left">
									<button type="button" class="btn btn-default btn-outline btn-icon left-icon" onclick="javascript:window.print();"> 
										<i class="fa fa-print"></i><span> چاپ</span> 
									</button>
									<span class="btn btn-primary mr-10">وضعیت : در حال ارسال</span>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->
		
	</div>
@endsection
		
		
@section('scripts')
	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Init JavaScript
		'dist/js/init.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
@endsection		