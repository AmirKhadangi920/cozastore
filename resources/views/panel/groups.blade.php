@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		// Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',			
		//alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
	<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.group-card {
		height: 100px;
		overflow: hidden;
	}
	.col-md-3 {
		float: right;
	}
	</style>
@endsection
	
@section('content')
	<div class="container">

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">
					@isset($edit) ویرایش گروه {{$title}} @else ثبت گروه جدید @endisset
				</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">
						<span>@isset($edit) ویرایش گروه {{$title}} @else ثبت گروه جدید @endisset</span>
					</li>
					<li>فروشگاه</li>
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
								<form action="@isset($edit) /panel/group/edit @else /panel/group/add @endisset" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات گروه</h6>
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
									</div>
									
									<div class="row">
										<div class="@isset($edit) col-md-12 @else col-md-6 @endisset">
											<div class="form-group">
												<label class="control-label mb-10">نام گروه</label>
												<div class="input-group">
													<input type="text" name="title" id="firstName" @isset($selected) value="{{$selected[0] -> title}}" @else value="{{old('title')}}" @endisset class="form-control" placeholder="مثلا : تلفن همراه">
													<div class="input-group-addon"><i class="ti-text"></i></div>
												</div>
											</div>
										</div>

										@if(!isset($edit))
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">گروه مادر</label>
												<div class="input-group">
													<select name="parent" class="form-control select2 categories">
														@if (isset($title))
														<option value="{{$id}}">زیر مجموعه گروه {{ $title }}</option>
														@else
														<option value="">ثبت به عنوان گروه اصلی</option>
														@endif

														@foreach ($groups as $group)
														<option value="{{ $group->id}}">{{$group->title}}</option>
														@endforeach
													</select>
													<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
												</div>
											</div>
										</div>
										@endif
										<!--/span-->
										
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label mb-10">توضیح کوتاه</label>
												<div class="input-group">
													<input type="text" name="description" id="firstName" 
														@isset($selected) value="{{$selected[0] -> description}}" @else value="{{old('description')}}" @endisset class="form-control" 
																@if(isset($edit) && empty($selected[0]->description))
																placeholder="هیچ توضیحی برای گروه '{{$title}}' ثبت نشده است !"
																@else 
																placeholder="یک توضیح یک خطی درباره گروه"
																@endif 
															>
													
													<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
												</div>
											</div>
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn @isset($edit) btn-warning {{$title}} @else btn-primary @endisset btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
											<span>@isset($edit) ویرایش گروه @else ثبت گروه @endisset</span>
										</button>
										<div class="clearfix"></div>
									</div>

									@isset($selected) 
										<input type="hidden" value="{{ $selected[0] -> id}}" name="id" /> 
									@endisset

									@csrf
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
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">لیست گروه ها</h5>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					@isset($breadcrumb)
						<li class="active">{{ $title }}</li>
						@if (!empty($breadcrumb[0]))
							@foreach ($breadcrumb as $item)
								<li><a href="/panel/group/{{ $item[0] -> id }}/{{ $item[0] -> title }}">
									{{ $item[0] -> title }}</a></li>
							@endforeach
						@endif
					@endisset
					<li><a href="/panel/group/">دسته های اصلی</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			@empty($groups->first())
				<div class="alert alert-warning alert-dismissable">
					<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
					@if (isset($title))
						<p class="pull-right">هیچ زیر مجموعه ای برای گروه "{{ $title }}" ثبت نشده است !</p>
					@else
						<p class="pull-right">هیچ گروهی تاکنون ثبت نشده است !</p>
					@endif
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="clearfix"></div>
				</div>
			@endempty

			<?php $colors = ['danger', 'warning', 'info', 'primary', 'success']; $i = $x = 0; ?>

			@foreach ($groups as $group)
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php if ($x == 5) { $x = 0; } ?>
					<div class="panel panel-{{ $colors[$x] }} card-view panel-refresh">
						<div class="refresh-container">
							<div class="la-anim-1"></div>
						</div>
						<div class="panel-heading">
							<div class="pull-right">
								<a href="/panel/group/{{ $group->id }}/{{ $group->title }}">
									<h6 class="panel-title txt-light">{{ $group->title }}</h6>
								</a>
							</div>
							<div class="pull-left">
								<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_<?=$i?>" aria-expanded="true">
									<i class="zmdi zmdi-chevron-down"></i>
									<i class="zmdi zmdi-chevron-up"></i>
								</a>

								<a href="/panel/group/edit/{{$group->id}}/{{$group->title}}" class="pull-left inline-block mr-15">
									<i class="zmdi zmdi-edit"></i>
								</a>

								<span group="{{$group->id}}" class="delete-group pull-left inline-block mr-15">
									<i class="zmdi zmdi-close"></i>
								</span>
							</div>
							<div class="clearfix"></div>
						</div>
						<div  id="collapse_<?=$i?>" class="panel-wrapper collapse in group-card">
							<div  class="panel-body">
								@empty($group->description)
									<div class="alert alert-warning alert-dismissable">
										<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
										<p class="pull-right">توضیحی ثبت نشده است !</p>
										<div class="clearfix"></div>
									</div>
								@endempty
								<p>{{ $group->description}}</p>
							</div>
						</div>
					</div>
				</div>				
				<?php ++$i; ++$x ?>				
			@endforeach

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
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		// Init JavaScript
		'dist/js/init.js',
		// Init Add Product Page JavaScript
		'dist/js/group_ajax.js',
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
					window.location =  '/panel/group/delete/' + id + '/' + title; 
				} else {     
					swal("لغو شد", "هیچ گروهی حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection