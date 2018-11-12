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
    
    
    </style>
@endsection

@section('content')
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">@isset($edit) ویرایش محصول @else ثبت محصول @endisset</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>@isset($edit) ویرایش محصول @else ثبت محصول @endisset</span></li>
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
								<form action="@isset($edit) /panel/products/update @else /panel/products/new @endisset" enctype="multipart/form-data" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>درباره محصول</h6>
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
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">نام محصول</label>
												<div class="input-group">
													<input type="text" name="name" @isset($edit) value="{{$product->name}}" @else value="{{old('name')}}" @endisset id="firstName" class="form-control" placeholder="مثلا : 'گوشی موبایل سامسونگGalaxy S7'">
													<div class="input-group-addon"><i class="ti-text"></i></div>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<label class="control-label mb-10">شناسه محصول</label>
											<div class="input-group">
												<input type="text" name="code" @isset($edit) value="{{$product->code}}" @else value="{{old('code')}}" @endisset id="firstName" class="form-control" placeholder="شناسه محصول در فروشگاه شما ، مثلا : B43E7">
												<div class="input-group-addon"><i class="ti-id-badge"></i></div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label mb-10">توضیح کوتاه</label>
												<div class="input-group">
													<input type="text" name="short_description" @isset($edit) value="{{$product->short_description}}" @else value="{{old('short_description')}}" @endisset id="firstName" class="form-control" placeholder="یک توضیح یک خطی درباره محصول">
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
												<label class="control-label mb-10">گروه</label>
												<div class="input-group">
													<select name="parent" class="form-control select2 categories">
														<option value="">دسته بندی نشده</option>
														@if(isset($edit) && !empty($product->category))
															<option value="{{$product->category}}" selected>گروه سابق : "{{$product->title}}"</option>
														@endif
														@foreach ($groups as $group) { ?>
														<option value="{{$group['id']}}">{{$group['title']}}</option>
														@endforeach
													</select>
													<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
												</div>
												
											</div>
										</div>
										<!--/span-->

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">ویدیوی آپارات</label>
												<div class="input-group">
													<input type="text" name="aparat_video" @isset($edit) value="https://www.aparat.com/v/{{$product->aparat_video}}" @else value="{{old('aparat_video')}}" @endisset id="firstName" class="form-control" placeholder="لینک ویدیوی شما در آپارات ، مثلا : https://www.aparat.com/v/kN0SI">
													<div class="input-group-addon"><i class="ti-video-clapper"></i></div>
												</div>
											</div>
										</div>
									</div>
									<!--/row-->
									<!-- Row -->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">لیبل محصول</label>
												<div class="input-group">
													<select name="label" class="form-control select2">
														<option value="" selected="selected">بدون لیبل</option>
														<option value="1" @if(isset($edit) && $product->label == 1) selected @endif>توقف تولید</option>
														<option value="2" @if(isset($edit) && $product->label == 2) selected @endif>به زودی</option>
														<option value="3" @if(isset($edit) && $product->label == 3) selected @endif>نا موجود</option>
														<option value="4" @if(isset($edit) && $product->label == 4) selected @endif>عدم فروش</option>
													</select>
													<div class="input-group-addon"><i class="ti-layout-media-right"></i></div>
												</div>
												
											</div>
										</div>
										<!--/span-->

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">تعداد موجود در انبار</label>
												<div class="input-group">
													<input type="number" name="stock_inventory" min="0" @isset($edit) value="{{$product->stock_inventory}}" @else value="{{old('stock_inventory')}}" @endisset id="firstName" class="form-control" placeholder="موجودی این محصول در انبار شما">
													<div class="input-group-addon"><i class="ti-layout-grid4-alt"></i></div>
												</div>
											</div>
										</div>
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">قیمت</label>
												<div class="input-group">
													<input type="number" @isset($edit) value="{{$product->price}}" @else value="{{old('price')}}"  @endisset name="price" class="form-control" id="exampleInputuname" placeholder="مثلا : 1550000">
													<div class="input-group-addon"><i class="ti-money"></i></div>
												</div>
											</div>
										</div>

										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label mb-10">واحد پولی</label>
												<div class="radio-list">
													<div class="radio-inline">
														<div class="radio radio-info">
															<input type="radio" @if(isset($edit) && $product->unit == 0) checked @elseif(old('unit') == 0) checked="checked"  @endif name="unit" id="unit_rl" value="0">
															<label for="unit_rl">تومان</label>
														</div>
													</div>
													<div class="radio-inline pl-0">
														<div class="radio radio-info">
															<input type="radio" @if(isset($edit) && $product->unit == 1) checked @elseif(old('unit') == 1) checked="checked"  @endif name="unit" id="unit_dl" value="1">
															<label for="unit_dl">دلار</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--/span-->

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">تخفیف</label>
												<div class="input-group">
													<input type="number" name="offer" @isset($edit) value="{{$product->offer}}" @else value="{{old('offer')}}" @endisset class="form-control" id="exampleInputuname_1" placeholder="مثلا 36%" min="0" max="99">
													<div class="input-group-addon"><i class="ti-cut"></i></div>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>

									<div class="row">
										<div class="col-sm-6">
											<label class="control-label mb-10">رنگ های محصول</label>
											<div class="form-group mb-0">
												<select class="select2 select2-multiple color-value" @isset($edit) value="{{$product->colors}}" @else value="{{old('color')}}" @endisset multiple="multiple" data-placeholder="رنگ هارا انتخاب کنید">
												<?php $colors = [
													['blue', 'آبی'],
													['green', 'سبز'],
													['yellow', 'زرد'],
													['brown', 'قهوه ای'],
													['violet', 'بنفش'],
													['orange', 'نارنجی'],
													['red', 'قرمز'],
													['black', 'مشکی'],
													['white', 'سفید'],
												]; 
												
												$i = 0;
												
												if (isset($edit)) {
													$product->colors = explode(',', $product->colors);
												}
												?>
												
												@foreach ($colors as $color)
													<option value="{{$color[0]}}" 
														<?php if(isset($edit) && isset($product->colors[$i]) && $color[0] == $product->colors[$i]) {
															echo 'selected'; ++$i;
														}?>>{{$color[1]}}</option>
												@endforeach																
												</select>
												<input type="hidden" name="colors" class="color-value" />
											</div>	
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">وضعیت</label>
												<div class="radio-list">
													<div class="radio-inline">
														<div class="radio radio-info">
															<input type="radio" @if(isset($edit) && $product->status == 0) checked="checked" @elseif(old('status') == 0) checked @endif name="status" id="radio2" value="0">
															<label for="radio2">پیش نویس</label>
														</div>
													</div>
													<div class="radio-inline pl-0">
														<div class="radio radio-info">
															<input type="radio" @if(isset($edit) && $product->status == 1) checked="checked" @elseif(old('status') == 1) checked @endif  @if(!isset($edit)) checked="checked" @endisset name="status" id="radio1" value="1">
															<label for="radio1">ثبت محصول</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-comment-text ml-10"></i>توضیح محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<textarea name="full_description" class="tinymce form-control">@isset($edit) {{$product->full_description}} @else {{old('full_description')}} @endisset</textarea>
											</div>
										</div>
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" class="remove-outline">
												<label class="control-label mb-10">کلمات کلیدی</label>
												<input type="text" @isset($edit) value="{{$product->keywords}}" @else value="{{old('keywords')}}" @endisset name="keywords" data-role="tagsinput" placeholder="افزودن کلمه کلیدی"/>
											</div>
										</div>
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle capitalize-font"><i class="font-20 txt-grey zmdi zmdi-collection-image ml-10"></i>تصاویر محصول</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-lg-12">
											<div class="row" id="picture-files">
												<div class="col-md-12">
													<div style="display: none;" class="alert alert-warning alert-dismissable">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														هیج تصویری برای محصول انتخاب نشده است ! 
													</div>
												</div>
												@if(isset($edit) && !empty($product->gallery))
												<div class="preview-gallery">
													@foreach (explode(',', $product->gallery) as $photo)
													<div class="col-md-2 col-xs-4 mb-30">
														<div class="img-upload-wrap">
															<input type="file" disabled data-show-remove="false" 
																data-default-file="{{ asset('uploads/'.$photo)}}" class="dropify file" />
														</div>
													</div>
													@endforeach
												</div>	
												@else
												<div class="preview-gallery">
												</div>
												@endif

												<input type="hidden" @isset($edit) value="{{$product->photo}}" @endisset id="single_photo" name="photo" onchange="alert(this.value)" />
												<input type="hidden" @isset($edit) value="{{$product->gallery}}" @endisset id="gallery" name="gallery" onchange="alert(this.value)" />
											</div>

											<div class="col-md-12 text-center">
												<div  class="panel-body">
													<!-- sample modal content -->
													<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																	<h5 class="modal-title mr-20" id="myLargeModalLabel">عکس های مورد نظر خود را انتخاب کنید</h5>
																</div>
																<div class="modal-body">
																	<div class="gallery-wrap">
																		<div class="portfolio-wrap project-gallery">
																			<ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
																				@empty ($photos[0])
																					<div class="alert alert-danger alert-dismissable">
																						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																						هیچ تصویری تا کنون آپلود نشده است
																					</div>
																				@endempty
																				
																				@if(!empty($product->gallery))
																					@foreach (explode(',', $product->gallery) as $photo)
																						<li class="item tall" photo="{{$photo}}" data-src="{{ asset('uploads/'.$photo) }}" >
																							<a href="" class="photo-gallery selected">
																								<img class="img-responsive" src="{{ asset('uploads/'.$photo) }}"  alt="توضیحی برای تصویر ثبت نشده است" />
																								<span class="hover-cap">
																									تصویر محصول
																								</span>
																							</a>
																						</li>
																					@endforeach
																				@endif

																				@if(!empty($photos[0]))
																					@foreach ($photos as $photo)
																						<li class="item tall" photo="{{$photo->photo}}" data-src="{{ asset('uploads/'.$photo->photo) }}" data-sub-html="{{$photo->description}}" >
																							<a href="" class="photo-gallery">
																								<img class="img-responsive" src="{{ asset('uploads/'.$photo->photo) }}"  alt="توضیحی برای تصویر ثبت نشده است" />
																								<span class="hover-cap">
																									@if($photo->name) {{$photo->name}} @else {{$photo->photo}} @endif
																								</span>
																							</a>
																						</li>
																					@endforeach
																				@endif

																			</ul>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<div class="pull-left">
																		<button type="button" class="btn btn-danger text-left ml-20" data-dismiss="modal">بستن</button>
																		<button type="button" class="add-pics btn btn-primary text-left" data-dismiss="modal">انتخاب تصاویر</button>
																	</div>
																</div>
															</div>
															<!-- /.modal-content -->
														</div>
														<!-- /.modal-dialog -->
													</div>
													<!-- /.modal -->
													<!-- Button trigger modal -->
													<div class="pull-center fileupload btn @if(isset($edit) && !empty($product->gallery)) btn-warning @else btn-default @endif btn-outline btn-sm btn-anim model-test" data-toggle="modal" data-target=".bs-example-modal-lg" id="add-new-picture">
														<i class="fa @if(isset($edit) && !empty($product->gallery)) fa-edit @else fa-plus @endif"></i>
														<span class="btn-text">@if(isset($edit) && !empty($product->gallery)) ویرایش تصاویر @else افزودن تصویر جدید @endif</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-swap ml-10"></i>معایب و مزایا</h6>
									<hr class="light-grey-hr"/>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group disadvantages">
												<input type="text" name="disadvantages" @isset($edit) value="{{$product->disadvantages}}" @else value="{{old('disadvantages')}}"  @endisset data-role="tagsinput" class="form-control" placeholder="عیب محصول">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group advantages">
												<input type="text" name="advantages" @isset($edit) value="{{$product->advantages}}" @else value="{{old('advantages')}}" @endisset data-role="tagsinput" class="form-control" placeholder="مزیت محصول">
											</div>
										</div>
									</div>
									<div class="seprator-block"></div>
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-calendar-note ml-10"></i>اطلاعات فنی</h6>
									<hr class="light-grey-hr"/>
									
									
									<div class="specs-table">
										@if(isset($edit) && !empty($spec_table))
											<?php 
												$spec_table = json_decode($spec_table, true);
												$specs = json_decode($product->specifications, true);
											?>
											
											@foreach ($spec_table as $item)
												<div class="row">
													<div class="col-md-2">
														<h5 class="mb-10 col-md-12 border-bottom">
															<i class="ti-angle-double-left" style="font-size: 15px; color:darkgray;"></i>
															<b>{{ $item['header'] }}</b>
														</h5>
													</div>
													
													<div class="col-md-10">
														<div class="col-md-12">
														@foreach ($item['items'] as $spec)
															<div class="col-md-6">
															@isset ($spec['select'])
																<div class="form-group">
																	<label class="control-label mb-10">{{ $spec['name'] }}</label>
																	<div class="radio-list">
																	<?php $x = 0; ?>
																	@foreach ($spec['select'] as $select)
																		<div class="radio-inline">
																			<div class="radio radio-info">
																				<?php $id = 'id-' . rand(0, 1000); ?>
																				<input type="radio" id="{{ $id }}" @if ($x++ == 0) checked="checked" @endif
																					name="specs[{{ $item['value'] }}][{{ $spec['value'] }}]" value="{{ $select }}"
																					@if($specs[ $item['value'] ][ $spec['value'] ] && $specs[ $item['value'] ][ $spec['value'] ] == $select) checked @endif />
																				<label for="{{ $id }}">{{ $select }}
																				@isset ($spec['label']) {{ $spec['label'] }} @endisset
																				</label>
																			</div>
																		</div>
																	@endforeach
																	</div>
																</div>
															@else
																<div class="form-group">
																	<label class="control-label mb-10">{{ $spec['name'] }}</label>
																	@isset ($spec['label']) <div class="input-group"> @endisset
																	<input type="text" class="form-control"
																		name="specs[{{ $item['value'] }}][{{ $spec['value'] }}]"
																		@isset($specs[ $item['value'] ][ $spec['value'] ]) value="{{ $specs[ $item['value'] ][ $spec['value'] ] }}" @endisset
																		@isset ($spec['help']) placeholder="{{ $spec['help'] }}" @endisset />
																	@isset ($spec['label'])
																		<div class="input-group-addon">{{ $spec['label'] }}</div></div>
																	@endisset
																</div>
															@endisset
															</div>	
														@endforeach
														</div>
													</div>
												</div>
												<div class="seprator-block"></div>
												<hr class="light-grey-hr"/>
												<div class="seprator-block"></div>
											@endforeach
											
											<input type="hidden" name="spec_id" value="{{ $product -> spec_table }}" />
										@else
										<input type="hidden" name="specs" value="" />
										<div class="alert alert-warning alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											هنوز گروهی انتخاب نکرده اید یا گروه مورد نظر شما دارای جدول اطلاعات فنی نیست 
										</div>
										@endif
									</div>
									

									<div class="form-actions">
										<button class="btn btn-orange btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره</span></button>
										<a href="/panel/products" class="btn btn-default pull-left">لغو</a>
										<div class="clearfix"></div>
									</div>
									@isset($edit)
									<input type="hidden" name="id" value="{{$product->pro_id}}" />
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
		// Init Add Product Page JavaScript
		'dist/js/init_add_product.js',
		// Get Groups by Ajax
		'dist/js/group_ajax.js'
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach

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