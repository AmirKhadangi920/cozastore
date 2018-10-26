@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Data table CSS
		'vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
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
					<li class="active">لیست سفارشات</li>
					<li>صفحات خاص</li>
					<li>داشبورد</li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">لیست سفارشات</h5>
			</div>
		</div>
		<!-- /Title -->
		
		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">سفارشات</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_1" class="table  display table-hover mb-30">
										<thead>
											<tr>
												<th>شناسه فاکتور</th>
												<th>خریدار</th>
												<th>توضیحات</th>
												<th>مبلغ</th>
												<th>وضعیت</th>
												<th>ثبت سفارش</th>
												<th>پرداخت</th>
												<th>اطلاعات بیشتر</th>
											</tr>
										</thead>

										<tbody>
											<tr>
												<td>#5012</td>
												<td>احمد حسینی</td>
												<td>لورم ایپسوم متن ساختگی با تولید</td>
												<td>205,500 </td>
												<td>
													<span class="label label-danger">پرداخت نشده</span>
												</td>
												<td>2011/04/25</td>
												<td>-</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5013</td>
												<td>علی کمالی</td>
												<td>سادگی نامفهوم از صنعت </td>
												<td>205,500</td>
												<td>
													<span class="label label-success">پرداخت شده</span>
												</td>
												<td>2011/07/25</td>
												<td>2012/12/02</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5014</td>
												<td>حسین موسوی</td>
												<td>چاپ و با استفاده از طراحان گرافیک است</td>
												<td>205,500</td>
												<td>
													<span class="label label-warning">در انتظار</span>
												</td>
												<td>2009/01/12</td>
												<td>2012/12/02</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5015</td>
												<td>اکبر یزدی</td>
												<td>چاپگرها و متون بلکه روزنامه و مجله در ستون</td>
												<td>205,500 </td>
												<td>
													<span class="label label-success">پرداخت شده</span>
												</td>
												<td>2012/03/29</td>
												<td>2012/12/02</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5016</td>
												<td>رضا اولیا</td>
												<td>تکنولوژی مورد نیاز و کاربردهای </td>
												<td>205,500</td>
												<td>
													<span class="label label-success">پرداخت شده</span>
												</td>
												<td>2008/11/28</td>
												<td>2012/12/02</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5017</td>
												<td>فاطمه مددی</td>
												<td>آینده شناخت فراوان جامعه و متخصصان </td>
												<td>205,500</td>
												<td>
													<span class="label label-success">پرداخت شده</span>
												</td>
												<td>2012/12/02</td>
												<td>2016/12/02</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5017</td>
												<td>حسن ایرانی</td>
												<td>طراحان خلاقی و فرهنگ </td>
												<td>205,500</td>
												<td>
													<span class="label label-success">پرداخت شده</span>
												</td>
												<td>2012/08/06</td>
												<td>2013/09/15</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5010</td>
												<td>ستاره ملکی</td>
												<td>تکنولوژی مورد نیاز و کاربردهای</td>
												<td>205,500</td>
												<td>
													<span class="label label-success">پرداخت شده</span>
												</td>
												<td>2010/10/14</td>
												<td>2014/09/15</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>
											<tr>
												<td>#5011</td>
												<td>رضا نجفی</td>
												<td>ارائه راهکارها و شرایط سخت </td>
												<td>205,500</td>
												<td>
													<span class="label label-success">پرداخت شده</span>
												</td>
												<td>2009/09/15</td>
												<td>2013/09/15</td>
												<td>
													<a href="<?=WEBSITE?>panel/invoice-details">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>	
												</td>
											</tr>

										</tbody>
									</table>
								</div>
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
		// Data table JavaScript
		'vendors/bower_components/datatables/media/js/jquery.dataTables.min.js',
		'dist/js/dataTables-data.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Init JavaScript
		'dist/js/init.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
@endsection