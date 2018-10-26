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
@endsection

@section('content')
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">داشبورد</a></li>
					<li><a href="#"><span>فروشگاه</span></a></li>
					<li class="active"><span>افزودن محصول</span></li>
				</ol>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">افزودن محصول</h5>
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
								<form action="<?=WEBSITE.'panel/products/addproduct'?>" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>درباره محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-md-6">
											<label class="control-label mb-10">شناسه محصول</label>
											<div class="input-group">
												<input type="text" name="product_code" id="firstName" class="form-control" placeholder="شناسه محصول در فروشگاه شما ، مثلا : B43E7">
												<div class="input-group-addon"><i class="ti-id-badge"></i></div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">نام محصول</label>
												<div class="input-group">
													<input type="text" name="product_name" id="firstName" class="form-control" placeholder="مثلا : 'گوشی موبایل سامسونگGalaxy S7'">
													<div class="input-group-addon"><i class="ti-text"></i></div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label mb-10">توضیح کوتاه</label>
												<div class="input-group">
													<input type="text" name="short_description" id="firstName" class="form-control" placeholder="یک توضیح یک خطی درباره محصول">
													<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!-- Row -->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">ویدیوی آپارات</label>
												<div class="input-group">
													<input type="text" name="aparat_video" id="firstName" class="form-control" placeholder="اسکریپت ویدیوی خود در سایت آپارات را در این قسمت وارد کنید">
													<div class="input-group-addon"><i class="ti-video-clapper"></i></div>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">گروه</label>
												<div class="input-group">
													<select name="parent" class="form-control select2">
														<option value="false">دسته بندی نشده</option>
														<?php foreach ($data['groups'] as $group) { ?>
														<option value="<?=$group['id']?>"><?=$group['title']?></option>
														<?php } ?>
													</select>
													<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
												</div>
												
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">تخفیف</label>
												<div class="input-group">
													<input type="number" name="offer" class="form-control" id="exampleInputuname_1" placeholder="مثلا 36%" min="0" max="99">
													<div class="input-group-addon"><i class="ti-cut"></i></div>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label mb-10">واحد پولی</label>
												<div class="radio-list">
													<div class="radio-inline">
														<div class="radio radio-info">
															<input type="radio" name="unit" id="unit_rl" value="0">
															<label for="unit_rl">ریال</label>
														</div>
													</div>
													<div class="radio-inline pl-0">
														<div class="radio radio-info">
															<input type="radio" name="unit" checked="checked" id="unit_dl" value="1">
															<label for="unit_dl">دلار</label>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">قیمت</label>
												<div class="input-group">
													<input type="number" name="price" class="form-control" id="exampleInputuname" placeholder="مثلا : 1550000">
													<div class="input-group-addon"><i class="ti-money"></i></div>
												</div>
											</div>
										</div>
										
										<!--/span-->
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">وضعیت</label>
												<div class="radio-list">
													<div class="radio-inline">
														<div class="radio radio-info">
															<input type="radio" name="status" id="radio2" value="0">
															<label for="radio2">پیش نویس</label>
														</div>
													</div>
													<div class="radio-inline pl-0">
														<div class="radio radio-info">
															<input type="radio" name="status" checked="checked" id="radio1" value="1">
															<label for="radio1">ثبت محصول</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<label class="control-label mb-10">رنگ های محصول</label>
											<div class="form-group mb-0">
												<select name="colors" class="select2 select2-multiple color-value" multiple="multiple" data-placeholder="رنگ هارا انتخاب کنید">
													<option value="blue" style="background: blue">آبی</option>
													<option value="green">سبز</option>
													<option value="yellow">زرد</option>
													<option value="brown">قهوه ای</option>
													<option value="violet">بنفش</option>
													<option value="orange">نارنجی</option>
													<option value="red">قرمز</option>
													<option value="black">مشکی</option>
													<option value="white">سفید</option>																
												</select>
											</div>	
										</div>
										<!--/span-->
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-comment-text ml-10"></i>توضیح محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<textarea name="full_description" class="tinymce form-control"></textarea>
											</div>
										</div>
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" class="remove-outline">
												<label class="control-label mb-10">کلمات کلیدی</label>
												<input type="text" name="keywords" data-role="tagsinput" placeholder="افزودن کلمه کلیدی"/>
											</div>
										</div>
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-collection-image ml-10"></i>تصاویر محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-lg-12">
											<div class="row" id="picture-files">
												<div class="col-md-2 col-xs-4">
													<div class="img-upload-wrap">
														<input type="file" name="images[]" multiple="multiple" id="input-file-now" class="dropify" />
													</div>
												</div>
											</div>
											<div class="fileupload btn btn-default btn-outline btn-sm btn-anim" id="add-new-picture"><i class="fa fa-plus"></i><span class="btn-text">افزودن تصویر جدید</span></div>
										</div>
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-swap ml-10"></i>معایب و مزایا</h6>
									<hr class="light-grey-hr"/>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group disadvantages">
												<input type="text" name="disadvantages" data-role="tagsinput" class="form-control" placeholder="عیب محصول">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group advantages">
												<input type="text" name="advantages" data-role="tagsinput" class="form-control" placeholder="مزیت محصول">
											</div>
										</div>
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-calendar-note ml-10"></i>اطلاعات فنی</h6>
									<hr class="light-grey-hr"/>
									
									<div class="row features-values">
										<div class="features-row">
											<div class="col-sm-6">
												<div class="form-group features">
													<input type="text" name="features[0]['value']" class="form-control" placeholder="مقدار ویژگی را وارد کنید">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<select name="features[0]['name']" class="form-control select2">
														<option value="false">یک ویژگی را انتخاب کنید</option>
														<?php foreach ($data['features'] as $feature) {
															if (count($feature['subs']) != 0) { ?>
																<optgroup label="<?=$feature['name']?>">
																	<?php foreach ($feature['subs'] as $sub) { ?>
																		<option value="<?=$sub['id']?>"><?=$feature['name'].' > '.$sub['name']?></option>
																	<?php } ?>
																</optgroup>
														<?php }
														} ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button type="button" class="btn btn-primary pull-right create-new-feautre"> <i class="fa fa-plus"></i> <span>افزودن ویژگی جدید</span></button>
										<button class="btn btn-orange btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره</span></button>
										<button type="button" class="btn btn-default pull-left">لغو</button>
										<div class="clearfix"></div>
									</div>
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
		// Init Add Product Page JavaScript
		'dist/js/init_add_product.js',
		// Get Groups by Ajax
		'dist/js/group_ajax.js'
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>var WEBSITE = '<?=WEBSITE?>';</script>

	<script>
		var s2 = [];
		s2[0] = '<div class="features-row"><div class="col-sm-6"><div class="form-group features">';
		s2[0] += '<input type="text" name="features['
		s2[1] = '][\'value\']" data-role="tagsinput" class="form-control" placeholder="مقدار ویژگی را وارد کنید">';
		s2[1] += '</div></div><div class="col-sm-6"><div class="form-group">';
		s2[1] += '<select name="features[';
		s2[2] += '][\'name\']" class="form-control select2">';
		s2[2] += '<option value="false">یک ویژگی را انتخاب کنید</option>';
		<?php 
		foreach ($data['features'] as $feature) {
			if (count($feature['subs']) != 0) { ?>
				s2[2] += '<optgroup label="<?=$feature['name']?>">';
				<?php foreach ($feature['subs'] as $sub) { ?>
					s2[2] += '<option value="<?=$sub['id']?>"><?=$feature['name'].' > '.$sub['name']?></option>';
				<?php } ?>
		s2[2] += '</optgroup>'
		<?php }
		} ?>
		s2[2] += '</select></div></div></div>';
	</script>
@endsection