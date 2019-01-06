@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
    .project-gallery a {
		filter: grayscale(80%);
        box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        transition: box-shadow 300ms, filter 300ms, border 300ms;
    }

    .project-gallery a.selected {
		filter: grayscale(0%);
		border: 1px solid #f83f36;
		box-shadow: 0px 0px 20px -5px #f83f36 !important;
	}
    
    .project-gallery a:hover {
        box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
    }
    .photo-actions {
        width: 60px;
        position: absolute;
        top: 10px;
        left: 10px;
    }
    .photo-actions a, .photo-actions span {
        width: 20px;
        height: 20px;
        margin: 0px !important;
        padding: 4px;
        box-shadow: 0px 0px 0px 0px #000;
        transition: box-shadow 300ms;
    }

    .photo-actions a:hover, .photo-actions span:hover {
        box-shadow: 0px 0px 15px -5px #000;
    }
    
    .vertical-pills .tab-content {
		padding-right: 15px;
	}
	.fa {
		color: #737373;
	}
    </style>
@endsection

@section('content')
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">تنظیمات</h5>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>تنظیمات</span></li>
					<li>داشبورد</li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pt-0">
							<div class="form-wrap">
								<form action="/panel/setting/slider" enctype="multipart/form-data" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="fa fa-desktop font-20 txt-grey ml-10" aria-hidden="true"></i>ویرایش اسلایدر</h6>
									<hr class="light-grey-hr"/>

									
									<div class="panel-body">
										@foreach ($errors -> all() as $message)
											<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{ $message }} 
											</div>
										@endforeach
							
										@if(session()->has('message'))
											<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{ session()->get('message') }}
											</div>
										@endif
										
										<div  class="pills-struct vertical-pills">
											<ul role="tablist" class="nav nav-pills ver-nav-pills pull-right" id="myTabs_10">
												<li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" href="#slide1">اسلاید 1</a></li>
												<li role="presentation"><a aria-expanded="false" data-toggle="tab" role="tab" href="#slide2">اسلاید 2</a></li>
												<li role="presentation"><a aria-expanded="false" data-toggle="tab" role="tab" href="#slide3">اسلاید 3</a></li>
											</ul>
											<div class="tab-content" id="myTabContent_10">
												@php $i = 0 @endphp
												@foreach ($options['slider'] as $item)
												<div id="slide{{++$i}}" class="tab-pane fade @if($i == 1) active @endif in row" role="tabpanel">
													<div class="col-md-8">
														<div class="form-wrap">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputuname_2">عنوان اسلاید {{$i}}</label>
																<div class="input-group">
																	<input type="text" value="{{$item->title}}" name="slides[{{$i - 1}}][title]" class="form-control" id="exampleInputuname_2" placeholder="برای مثال : Apple_iPhone_X_back">
																	<div class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_2">متن توضیح اسلاید {{$i}}</label>
																<div class="input-group">
																	<input type="text" value="{{$item->description}}" name="slides[{{$i - 1}}][description]" class="form-control" id="exampleInputEmail_2" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
																	<div class="input-group-addon"><i class="fa fa-align-right" aria-hidden="true"></i></div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-4">
																	<label class="control-label mb-10" for="exampleInputEmail_4">عنوان دکمه اسلاید {{$i}}</label>
																	<div class="input-group">
																		<input type="text" value="{{$item->button}}" name="slides[{{$i - 1}}][button]" class="form-control" id="exampleInputEmail_4" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
																		<div class="input-group-addon"><i class="fa fa-square-o" aria-hidden="true"></i></div>
																	</div>
																</div>

																<div class="col-md-8">
																	<label class="control-label mb-10" for="exampleInputEmail_5">لینک دکمه اسلاید {{$i}}</label>
																	<div class="input-group">
																		<input type="text" dir="ltr" value="{{$item->link}}" name="slides[{{$i - 1}}][link]" class="form-control" id="exampleInputEmail_5" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
																		<div class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-md-4">
														<label class="control-label mb-10">تصویر اسلاید {{$i}}</label>
														<div class="mt-10 mb-10">
															<input type="file" data-default-file="/slider/{{$item->photo}}" name="slides[{{$i - 1}}][photo]" id="input-file-now" class="dropify" />
														</div>	
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>

									<div class="form-actions">
										<button class="btn btn-info btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره اسلایدر</span></button>
										<div class="clearfix"></div>
									</div>
									@csrf
								</form>
							</div>

							<div class="form-wrap">
								<form action="/panel/setting/posters" enctype="multipart/form-data" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="fa fa-picture-o font-20 txt-grey ml-10" aria-hidden="true"></i>ویرایش پوستر ها</h6>
									<hr class="light-grey-hr"/>

									
									<div class="panel-body">
										<div  class="pills-struct vertical-pills">
											<ul role="tablist" class="nav nav-pills ver-nav-pills pull-right" id="myTabs_10">
												<li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" href="#poster1">پوستر 1</a></li>
												<li role="presentation"><a aria-expanded="false" data-toggle="tab" role="tab" href="#poster2">پوستر 2</a></li>
												<li role="presentation"><a aria-expanded="false" data-toggle="tab" role="tab" href="#poster3">پوستر 3</a></li>
											</ul>
											<div class="tab-content" id="myTabContent_10">
												@php $i = 0 @endphp
												@foreach ($options['posters'] as $item)
												<div id="poster{{++$i}}" class="tab-pane fade @if($i == 1) active @endif in row" role="tabpanel">
													<div class="col-md-8">
														<div class="form-wrap">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputuname_2">عنوان پوستر {{$i}}</label>
																<div class="input-group">
																	<input type="text" value="{{$item->title}}" name="posters[{{$i - 1}}][title]" class="form-control" id="exampleInputuname_2" placeholder="برای مثال : تخفیف ویژه محصولات !">
																	<div class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_2">متن توضیح پوستر {{$i}}</label>
																<div class="input-group">
																	<input type="text" value="{{$item->description}}" name="posters[{{$i - 1}}][description]" class="form-control" id="exampleInputEmail_2" placeholder="یک توضیح کوتاه نیم خطی برای این پوستر">
																	<div class="input-group-addon"><i class="fa fa-align-right" aria-hidden="true"></i></div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-4">
																	<label class="control-label mb-10" for="exampleInputEmail_4">عنوان دکمه پوستر {{$i}}</label>
																	<div class="input-group">
																		<input type="text" value="{{$item->button}}" name="posters[{{$i - 1}}][button]" class="form-control" id="exampleInputEmail_4" placeholder="برای مثال : 'اطلاعات بیشتر'">
																		<div class="input-group-addon"><i class="fa fa-square-o" aria-hidden="true"></i></div>
																	</div>
																</div>

																<div class="col-md-8">
																	<label class="control-label mb-10" for="exampleInputEmail_5">لینک دکمه پوستر {{$i}}</label>
																	<div class="input-group">
																		<input type="text" dir="ltr" value="{{$item->link}}" name="posters[{{$i - 1}}][link]" class="form-control" id="exampleInputEmail_5" placeholder="لینک دکمه ، برای مثال : https://example.com">
																		<div class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-md-4">
														<label class="control-label mb-10">تصویر پوستر {{$i}}</label>
														<div class="mt-10 mb-10">
															<input type="file" data-default-file="/poster/{{$item->photo}}" name="posters[{{$i - 1}}][photo]" id="input-file-now" class="dropify" />
														</div>	
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>

									<div class="form-actions">
										<button class="btn btn-orange btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره پوسترها</span></button>
										<div class="clearfix"></div>
									</div>
									@csrf
								</form>
							</div>

							<div class="form-wrap">
								<form action="/panel/setting/info" enctype="multipart/form-data" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="fa fa-info font-20 txt-grey ml-10" aria-hidden="true"></i>تغییر اطلاعات کلی</h6>
									<hr class="light-grey-hr"/>

									
									<div class="panel-body">										
										<div class="row">
											<div class="col-md-8">
												<div class="form-wrap">
													<div class="row mb-10">
														<div class="col-md-8">
															<label class="control-label mb-10" for="exampleInputEmail_4">عنوان فروشگاه</label>
															<div class="input-group">
																<input type="text" value="{{$options['site_name']}}" name="site_name" class="form-control" id="exampleInputEmail_4" placeholder="نام فروشگاه شما">
																<div class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></div>
															</div>
														</div>
														
														<div class="col-md-4">
															<label class="control-label mb-10" for="exampleInputEmail_5">شماره تلفن</label>
															<div class="input-group">
																<input type="text" value="{{$options['shop_phone']}}" name="phone" class="form-control" id="exampleInputEmail_5" placeholder="برای مثال : 09123456789">
																<div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="description">درباره فروشگاه</label>
														<div class="input-group">
															<textarea class="form-control" id="description" name="description" style="resize:none;" placeholder="یک توضیح یک خطی کوتاه درباره فروشگاه و کسب و کار شما" rows="2">{{$options['site_description']}}</textarea>
															<div class="input-group-addon"><i class="fa fa-align-right" aria-hidden="true"></i></div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-8">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_2">آدرس فروشگاه شما</label>
																<div class="input-group">
																	<input type="text" value="{{$options['shop_address']}}" name="address" class="form-control" id="exampleInputEmail_2" placeholder="آدرس فروشگاه شما که به مشتریان و کاربران نمایش داده میشود">
																	<div class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
																</div>
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_2">حداقل مبلغ</label>
																<div class="input-group">
																	<input type="number" value="{{$options['min_total']}}" name="min_total" class="form-control" id="exampleInputEmail_2" placeholder="برای امکان استفاده از کد تخفیف">
																	<div class="input-group-addon"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-md-2">
												<label class="control-label mb-10">لوگوی فروشگاه</label>
												<div class="mt-10 mb-10">
													<input type="file" data-default-file="/logo/{{$options['site_logo']}}" name="logo" id="input-file-now" class="dropify" />
												</div>
											</div>
											
											<div class="col-md-2">
												<label class="control-label mb-10">واترمارک تصاویر محصول</label>
												<div class="mt-10 mb-10">
													<input type="file" data-default-file="/logo/{{$options['watermark']}}" name="watermark" id="input-file-now" class="dropify" />
												</div>
											</div>
										</div>
									</div>

									<div class="form-actions">
										<button class="btn btn-primary btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره اطلاعات کلی</span></button>
										<div class="clearfix"></div>
									</div>
									@csrf
								</form>
							</div>

							<div class="form-wrap">
								<form action="/panel/setting/social_link" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="fa fa-link font-20 txt-grey ml-10" aria-hidden="true"></i>لینک شبکه های اجتماعی</h6>
									<hr class="light-grey-hr"/>

									
									<div class="panel-body">										
										<div class="form-wrap">
											<div class="row mb-10">
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_5">اینستاگرام</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->instagram}}" name="instagram" class="form-control" id="exampleInputEmail_5" placeholder="لینک صفحه شما در شبکه اجتماعی اینستاگرام">
														<div class="input-group-addon"><i class="fa fa-instagram" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_4">تلگرام</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->telegram}}" name="telegram" class="form-control" id="exampleInputEmail_4" placeholder="لینک صفحه شما در شبکه اجتماعی تلگرام">
														<div class="input-group-addon"><i class="fa fa-telegram" aria-hidden="true"></i></div>
													</div>
												</div>
											</div>

											<div class="row mb-10">
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_5">توییتر</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->twitter}}" name="twitter" class="form-control" id="exampleInputEmail_5" placeholder="لینک صفحه شما در شبکه اجتماعی توییتر">
														<div class="input-group-addon"><i class="fa fa-twitter" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-6">
													<label class="control-label mb-10" for="exampleInputEmail_4">فیسبوک</label>
													<div class="input-group">
														<input type="text" dir="ltr" value="{{$options['social_link']->facebook}}" name="facebook" class="form-control" id="exampleInputEmail_4" placeholder="لینک صفحه شما در شبکه اجتماعی فیسبوک">
														<div class="input-group-addon"><i class="fa fa-facebook" aria-hidden="true"></i></div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-actions">
										<button class="btn btn-succuess btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره لینک ها</span></button>
										<div class="clearfix"></div>
									</div>
									@csrf
								</form>
							</div>

							<div class="form-wrap">
								<form action="/panel/setting/shipping_cost" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="fa fa-truck font-20 txt-grey ml-10" aria-hidden="true"></i>هزینه های ارسال</h6>
									<hr class="light-grey-hr"/>

									
									<div class="panel-body">										
										<div class="form-wrap">
											<div class="row mb-10">
												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">عنوان متد شماره یک</label>
													<div class="input-group">
														<input type="text" value="{{$options['shipping_cost']->model1->name}}" name="shipping_cost[model1][name]" class="form-control" id="exampleInputEmail_5" placeholder="نام متد ارسال">
														<div class="input-group-addon"><i class="ti-text" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">هزینه متد شماره یک</label>
													<div class="input-group">
														<input type="number" value="{{$options['shipping_cost']->model1->cost}}" name="shipping_cost[model1][cost]" class="form-control" id="exampleInputEmail_5" placeholder="هزینه ارسال این متد بر حسب تومان">
														<div class="input-group-addon"><i class="fa fa-truck" aria-hidden="true"></i></div>
													</div>
												</div>

												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">عنوان متد شماره دو</label>
													<div class="input-group">
														<input type="text" value="{{$options['shipping_cost']->model2->name}}" name="shipping_cost[model2][name]" class="form-control" id="exampleInputEmail_5" placeholder="نام متد ارسال">
														<div class="input-group-addon"><i class="ti-text" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">هزینه متد شماره دو</label>
													<div class="input-group">
														<input type="number" value="{{$options['shipping_cost']->model2->cost}}" name="shipping_cost[model2][cost]" class="form-control" id="exampleInputEmail_5" placeholder="هزینه ارسال این متد بر حسب تومان">
														<div class="input-group-addon"><i class="fa fa-truck" aria-hidden="true"></i></div>
													</div>
												</div>
											</div>

											<div class="row mb-10">
												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">عنوان متد شماره سه</label>
													<div class="input-group">
														<input type="text" value="{{$options['shipping_cost']->model3->name}}" name="shipping_cost[model3][name]" class="form-control" id="exampleInputEmail_5" placeholder="نام متد ارسال">
														<div class="input-group-addon"><i class="ti-text" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">هزینه متد شماره سه</label>
													<div class="input-group">
														<input type="number" value="{{$options['shipping_cost']->model3->cost}}" name="shipping_cost[model3][cost]" class="form-control" id="exampleInputEmail_5" placeholder="هزینه ارسال این متد بر حسب تومان">
														<div class="input-group-addon"><i class="fa fa-truck" aria-hidden="true"></i></div>
													</div>
												</div>

												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">عنوان متد شماره چهار</label>
													<div class="input-group">
														<input type="text" value="{{$options['shipping_cost']->model4->name}}" name="shipping_cost[model4][name]" class="form-control" id="exampleInputEmail_5" placeholder="نام متد ارسال">
														<div class="input-group-addon"><i class="ti-text" aria-hidden="true"></i></div>
													</div>
												</div>
												<div class="col-md-3">
													<label class="control-label mb-10" for="exampleInputEmail_5">هزینه متد شماره چهار</label>
													<div class="input-group">
														<input type="number" value="{{$options['shipping_cost']->model4->cost}}" name="shipping_cost[model4][cost]" class="form-control" id="exampleInputEmail_5" placeholder="هزینه ارسال این متد بر حسب تومان">
														<div class="input-group-addon"><i class="fa fa-truck" aria-hidden="true"></i></div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-actions">
										<button class="btn btn-danger btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره هزینه های ارسال</span></button>
										<div class="clearfix"></div>
									</div>
									@csrf
								</form>
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
		// Tinymce JavaScript
		'vendors/bower_components/tinymce/tinymce.min.js',
		// Tinymce Wysuhtml5 Init JavaScript
		'dist/js/tinymce-data.js',
		// Gallery JavaScript
        'dist/js/isotope.js',
        'dist/js/lightgallery-all.js',
        'dist/js/froogaloop2.min.js',
		'dist/js/gallery-data.js',
		// Slimscroll JavaScript
        'dist/js/jquery.slimscroll.js',
		// Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Select2 JavaScript
		'vendors/bower_components/select2/dist/js/select2.full.min.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Bootstrap Tagsinput JavaScript
		'vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Init JavaScript
		'dist/js/init.js',
		// Setting page
		'dist/js/setting.js'
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach

	<script> $('.dropify').dropify(); </script>

	@isset($edit)
	<script>
	$(window).load(function () {
		var color = $('select.color-value').val();
		$('input.color-value').val(color);
		
		var li = $('li.select2-selection__choice').first();
		for (var i = 0; i < color.length; ++i) {
			li.css({background: color[i]});
			li = li.next();
		}
	});
	</script>
	@endisset
@endsection