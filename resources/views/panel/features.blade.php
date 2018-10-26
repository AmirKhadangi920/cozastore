@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css'
		
		// Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css'
						
		//alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css'
		
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
					<li class="active">افزودن ویژگی جدید</li>
					<li>فروشگاه</li>
					<li>داشبورد</li>
				</ol>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">افزودن ویژگی جدید</h5>
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
								<form action="<?=WEBSITE?>panel/features/<?=(isset($data['edit'])) ? 'edit_feature' : 'add' ?>" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات ویژگی</h6>
									<hr class="light-grey-hr"/>
									<?php
									if (isset($_SESSION['messages'])) {

										foreach ($_SESSION['messages'] as $message) { ?>
											<div class="alert alert-<?=$message['type']?> alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<?=$message['text']?>
											</div>
										<?php
										}

										unset($_SESSION['messages']);
									}
									?>

									<div class="row">	
										<div class="col-md-6">
											<?php if (!isset($data['edit'])) { ?>
											<div class="form-group">
												<label class="control-label mb-10">دسته بندی ویژگی</label>
												<div class="input-group">
													<select name="title" class="form-control select2">
														<option value="false">ثبت به عنوان دسته بندی جدید</option>
														<?php 
														foreach ($data['features'] as $feature) { ?>
															<option value="<?=$feature['id']?>"><?=$feature['name']?></option>
														<?php } ?>
													</select>
													<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
												</div>
											</div>
											<?php } ?>
										</div>

										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">عنوان وِیژگی</label>
												<div class="input-group">
													<input type="text" name="feature_name" value="<?=(isset($data['name'])) ? $data['name'] : '' ?>" id="firstName" class="form-control" placeholder="مثلا : سخت افزار">
													<?php if (isset($data['edit'])) { ?>
														<input type="hidden" name="id" value="<?=$data['id']?>">
													<?php } ?>
													<div class="input-group-addon"><i class="ti-text"></i></div>
												</div>
											</div>
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn btn-<?=(isset($data['edit'])) ? 'warning' : 'primary' ?> btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> 
											<span><?=(isset($data['edit'])) ? 'ویرایش' : 'ثبت' ?></span>
										</button>
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
		
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">لیست ویژگی ها</h5>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		
		<!-- Row -->
		<div class="row">
			<?php
			$colors = ['danger', 'warning', 'info', 'primary', 'success'];
			$i = $x = 0;

			if (count($data['features']) == 0) { ?>
				<div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					تا کنون هیچ زیر مجموعه ای ثبت نشده است
				</div>
			<?php } else {

			foreach ($data['features'] as $feature) {
				if ($i >= 5) { $i = 0; }
			?>

			<div class="col-md-3">
				<div class="panel panel-<?=$colors[$i]?> card-view panel-refresh">
					<div class="refresh-container">
						<div class="la-anim-1"></div>
					</div>
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-light"><?=$feature['name']?></h6>
						</div>
						<div class="pull-left">
							<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_1" aria-expanded="true">
								<i class="zmdi zmdi-chevron-down"></i>
								<i class="zmdi zmdi-chevron-up"></i>
							</a>

							<a href="<?=WEBSITE.'panel/features/edit/'.$feature['id']?>" class="pull-left inline-block mr-15">
								<i class="zmdi zmdi-edit"></i>
							</a>

							<span feature="<?=$feature['id']?>" class="delete-feature pull-left inline-block mr-15">
								<i class="zmdi zmdi-close"></i>
							</span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  id="collapse_1" class="panel-wrapper collapse in">
						<div  class="panel-body">
							<ul class="list-icons">
								<?php
								if (count($feature['subs']) == 0) { ?>
									<div class="alert alert-warning alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										زیرمجموعه ای ثبت نشده است
									</div>
								<?php } else {

								foreach ($feature['subs'] as $sub) {
								?>
								<li class="mb-10">
									<i class="fa fa-genderless text-success ml-5"></i>
									<?=$sub['name']?>

									<div class="pull-left">
										<a href="<?=WEBSITE.'panel/features/edit/'.$sub['id']?>"><i class="fa fa-pencil ml-5"></i></a>
										<i feature="<?=$sub['id']?>" class="icon-trash txt-danger delete-feature"></i>
									</div>
								</li>
								<?php
								}}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<?php
			++$i;
			++$x;
			}
			?>	
		</div>
		<!-- /Row -->
		<?php } ?>
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
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
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
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>
		$('.delete-feature').on('click',function(){
			var id = $(this).attr('feature');
	
			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن این ویژگی مطمین هستید ؟",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#f83f37",   
				confirmButtonText: "بله",   
				cancelButtonText: "خیر",   
				closeOnConfirm: false,   
				closeOnCancel: false 
			}, function(isConfirm){   
				if (isConfirm) {
					window.location = WEBSITE + 'panel/features/delete/' + id; 
				} else {     
					swal("لغو شد", "هیچ ویژگی ای حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection