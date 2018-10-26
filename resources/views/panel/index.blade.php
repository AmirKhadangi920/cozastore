@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Morris Charts CSS
		'vendors/bower_components/morris.js/morris.css',
		// Data table CSS
		'vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
		'vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css',
		// bootstrap-select CSS
		'vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css',	
		// Bootstrap Switches CSS
		'vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
		// switchery CSS
		'vendors/bower_components/switchery/dist/switchery.min.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
	@endforeach

@endsection

@section('content')
	<div class="container pt-30">
		<!-- Row -->
		<div class="row">
			
			<div class="col-md-4 col-sm-6">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel card-view">
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">ثبت قیمت دلار</h6>
								</div>
								<div class="pull-left">
									<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_1" aria-expanded="true">
										<i class="zmdi zmdi-chevron-down"></i>
										<i class="zmdi zmdi-chevron-up"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div  id="collapse_1" class="panel-wrapper collapse in">
								<div  class="panel-body">
									<div class="form-wrap">
										<form>
											<!-- form-group -->
											<div class="form-group mb-20">
												<p class="text-muted inline-block mb-10 ml-10 font-13">قیمت امروز دلار را ثبت کنید</p>
												<div class="input-group mb-15"> <span class="input-group-addon">$</span>
													<input type="number" placeholder="قیمت 1 دلار" class="form-control">
												</div>
											</div>
											<!-- /form-group -->
											<button class="btn btn-danger btn-block mb-10">ثبت قیمت</button>
										</form>
									</div>
								
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">محصولات برتر</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div  class="panel-body">
										<span class="font-12 head-font txt-dark">هندزفری beats</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-info" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
										<span class="font-12 head-font txt-dark">گلس A5 2017</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
										<span class="font-12 head-font txt-dark">ساعت هوشمند aWatch</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-danger" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 70%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
										<span class="font-12 head-font txt-dark">اپل iPhone X</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-warning" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
									</div>									
								</div>	
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel review-box card-view">
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">بررسی های اخیر</h6>
								</div>
								<div class="pull-left">
									<div class="form-group mb-0 sm-bootstrap-select">
										<select class="selectpicker" data-style="form-control">
											<option>جدید ترین ها</option>
											<option>بالاترین امتیاز</option>
											<option>پایین ترین امتیاز</option>
										</select>
									</div>	
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
							<div class="panel-body row pa-0">
									<div class="streamline">
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-right">
													<span class="inline-block">برای ساعت هوشمند</span>
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
												</div>
												<a href="javascript:void(0);"  class="pull-left txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-right">
													<span class="reviewer font-13">
														<span>توسط</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">فاطمه فتحی</a>
													</span>	
													<span class="inline-block font-13  mb-5">7 روز پیش</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
											</div>
										</div>
										<hr class="light-grey-hr"/>
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-right">
													<span class="inline-block">برای محافظ صفحه نمایش</span>
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
												</div>
												<a href="javascript:void(0);"  class="pull-left txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-right">
													<span class="reviewer font-13">
														<span>توسط</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">محسن رضایی</a>
													</span>	
													<span class="inline-block font-13  mb-5">7 ساعت پیش</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
											</div>
										</div>
										<hr class="light-grey-hr"/>
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-right">
													<span class="inline-block">برای ساعت طرح اپل</span>
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
												</div>
												<a href="javascript:void(0);"  class="pull-left txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-right">
													<span class="reviewer font-13">
														<span>توسط</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">رضا احمدی</a>
													</span>	
													<span class="inline-block font-13  mb-5">12 روز پیش</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
											</div>
										</div>
										<hr class="light-grey-hr"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-6">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">تجزیه و تحلیل فروش</h6>
								</div>
								<div class="pull-left sales-btn-group">
									<div class="btn-group btn-group-rounded">
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">امسال</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">این فصل</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">این ماه</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">این هفته</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">امروز</button>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="chart_1" class="" style="height:418px;"></div>
									<ul class="flex-stat flex-stat-2 mt-40">
										<li>
											<span class="block">آمار بازدید</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">3,24,222</span></span>
											<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+15%</span>
											</span>
											<div class="clearfix"></div>
										</li>
										<li>
											<span class="block">سفارشات</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">1,23,432</span></span>
											<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+4%</span>
											</span>
											<div class="clearfix"></div>
										</li>
										<li>
											<span class="block">درآمد</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">324,222</span> تومان</span>
											<span class="block txt-danger mt-5">
												<i class="zmdi zmdi-caret-down pr-5 font-20"></i><span class="weight-500">-5%</span>
											</span>
											<div class="clearfix"></div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">لیست سفارشات</h6>
								</div>
								<div class="pull-left">
									<a href="#" class="pull-left inline-block refresh mr-15">
										<i class="zmdi zmdi-replay"></i>
									</a>
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table  display table-hover border-none">
												<thead>
													<tr>
														<th>#شناسه</th>
														<th>توضیح</th>
														<th>مبلغ</th>
														<th>وضعیت</th>
														<th>ثبت سفارش</th>
														<th>پرداخت</th>
														<th>مشاهده</th>
													</tr>
												</thead>

												<tbody>
													<tr>
														<td>#5012</td>
														<td>خرید از فروشگاه</td>
														<td>205,500 تومان</td>
														<td>
															<span class="label label-danger">پرداخت نشده</span>
														</td>
														<td>2011/04/25</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5013</td>
														<td>یک توضیح</td>
														<td>205,500 تومان</td>
														<td>
															<span class="label label-success">پرداخت شده</span>
														</td>
														<td>2011/07/25</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5014</td>
														<td>خرید کامل و تمام</td>
														<td>205,500 تومان</td>
														<td>
															<span class="label label-warning">در انتظار پرداخت</span>
														</td>
														<td>2009/01/12</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5015</td>
														<td>توضیح متنی</td>
														<td>205,500 تومان</td>
														<td>
															<span class="label label-success">پرداخت شده</span>
														</td>
														<td>2012/03/29</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
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
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// simpleWeather JavaScript
		'vendors/bower_components/moment/min/moment.min.js',
		'vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js',
		'dist/js/simpleweather-data.js',
		// Progressbar Animation JavaScript
		'vendors/bower_components/waypoints/lib/jquery.waypoints.min.js',
		'vendors/bower_components/jquery.counterup/jquery.counterup.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Sparkline JavaScript
		'vendors/jquery.sparkline/dist/jquery.sparkline.min.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// ChartJS JavaScript
		'vendors/chart.js/Chart.min.js',
		// EasyPieChart JavaScript
		'vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
		// EChartJS JavaScript
		'vendors/bower_components/echarts/dist/echarts-en.min.js',
		'vendors/echarts-liquidfill.min.js',
		// Morris Charts JavaScript
		'vendors/bower_components/raphael/raphael.min.js',
		'vendors/bower_components/morris.js/morris.min.js',
		// Toast JavaScript
		'vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Bootstrap Select JavaScript
		'vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js',
		// Init JavaScript
		'dist/js/init.js',
		'dist/js/ecommerce-data.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
@endsection