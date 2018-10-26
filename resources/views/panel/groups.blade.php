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
					<li class="active"><span>ثبت گروه جدید</span></li>
					<li>فروشگاه</li>
					<li>داشبورد</li>
				</ol>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">ثبت گروه جدید</h5>
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
								<form action="<?=WEBSITE?>panel/groups/<?=(isset($data['edit'])) ? 'edit_group' : 'add' ?>" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات گروه</h6>
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
												<label class="control-label mb-10">گروه مادر</label>
												<div class="input-group">
													<select name="parent" class="form-control select2">
														<option value="false">ثبت به عنوان گروه اصلی</option>
														<?php foreach ($data['groups'] as $group) { ?>
															<option value="<?=$group['id']?>"><?=$group['title']?></option>
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
												<label class="control-label mb-10">نام گروه</label>
												<div class="input-group">
													<input type="text" name="name" id="firstName" value="<?=(isset($data['title'])) ? $data['title'] : '' ?>" class="form-control" placeholder="مثلا : تلفن همراه">
													<div class="input-group-addon"><i class="ti-text"></i></div>
												</div>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label mb-10">توضیح کوتاه</label>
												<div class="input-group">
													<input type="text" name="description" id="firstName" value="<?=(isset($data['description'])) ? $data['description'] : '' ?>" class="form-control" placeholder="یک توضیح یک خطی درباره گروه">
													
													<?php if (isset($data['edit'])) { ?>
														<input type="hidden" name="id" value="<?=$data['id']?>">
													<?php } ?>
													<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
												</div>
											</div>
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn btn-<?=(!isset($data['edit'])) ? 'primary' : 'warning'?> btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
											<span><?=(!isset($data['edit'])) ? 'ثبت گروه' : 'ویرایش گروه' ?></span>
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

		<?php if (!isset($data['edit'])) { ?>
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
				<?php if (isset($data['bread_cump'])) {
					foreach ($data['bread_cump'] as $bc) { ?>
						<li><a href="<?=WEBSITE.'panel/groups/'.$bc['id']?>"><?=$bc['title']?></a></li>
				<?php }
				} ?>
					<li><a href="<?=WEBSITE?>panel/groups/">دسته های اصلی</a></li>
					<!-- <li class="active"><span>ثبت گروه جدید</span></li>
					<li>فروشگاه</li> -->
				</ol>
			</div>
			
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">لیست گروه ها</h5>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			<?php
			$colors = ['danger', 'warning', 'info', 'primary', 'success'];
			$i = $x = 0;

			if (count($data['groups_info']) == 0) { ?>
				<div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					این گروه شامل هیچ زیر مجموعه ای نمیباشد
				</div>
			<?php } else {

			foreach ($data['groups_info'] as $group) {
				if ($i >= 5) { $i = 0; }
			?>

			<div class="col-md-3">
				<div class="panel panel-<?=$colors[$i]?> card-view panel-refresh">
					<div class="refresh-container">
						<div class="la-anim-1"></div>
					</div>
					<div class="panel-heading">
						<div class="pull-right">
							<a href="<?=WEBSITE . 'panel/groups/' . $group['id']?>">
								<h6 class="panel-title txt-light"><?=$group['title']?></h6>
							</a>
						</div>
						<div class="pull-left">
							<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_<?=$x?>" aria-expanded="true">
								<i class="zmdi zmdi-chevron-down"></i>
								<i class="zmdi zmdi-chevron-up"></i>
							</a>

							<a href="<?=WEBSITE . 'panel/groups/edit/' . $group['id']?>" class="pull-left inline-block mr-15">
								<i class="zmdi zmdi-edit"></i>
							</a>

							<span group="<?=$group['id']?>" class="delete-group pull-left inline-block mr-15">
								<i class="zmdi zmdi-close"></i>
							</span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  id="collapse_<?=$x?>" class="panel-wrapper collapse in">
						<div  class="panel-body">
							<p><?=$group['description']?></p>
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
		<?php } } ?>
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
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js'
		// Init JavaScript
		'dist/js/init.js',
		// Init Add Product Page JavaScript
		'dist/js/init_add_product.js',
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>
		$('.delete-group').on('click',function(){
			var title = $(this).parent().parent().find('h6').text();
			var id = $(this).attr('group');

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن گروه " + title + " مطمین هستید ؟",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#f83f37",   
				confirmButtonText: "بله",   
				cancelButtonText: "خیر",   
				closeOnConfirm: false,   
				closeOnCancel: false 
			}, function(isConfirm){   
				if (isConfirm) {
					window.location = WEBSITE + 'panel/groups/delete/' + id; 
				} else {     
					swal("لغو شد", "هیچ گروهی حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection