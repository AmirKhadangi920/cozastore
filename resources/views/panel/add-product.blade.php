@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Bootstrap Dropzone CSS
		'/vendors/bower_components/dropzone/dist/dropzone.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach
	
	<script src="/ckeditor/ckeditor.js"></script>

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
								<form action="@isset($edit) /panel/products/update/{{ $product->id }} @else /panel/products/new @endisset" enctype="multipart/form-data" method="POST">
									
									<div class="panel-body">
										{{-- @foreach ($errors -> all() as $message)
											<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{ $message }} 
											</div>
										@endforeach --}}
							
										@if(session()->has('message'))
											<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{ session()->get('message') }}
											</div>
										@endif
									</div>

									<div  class="pills-struct">
										<ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_11" style="float: right; margin-bottom: 20px;">
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#variations" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-calendar-note ml-10"></i>تنوع محصولات
												</a>
											</li>
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#specifications" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-calendar-note ml-10"></i>اطلاعات فنی
												</a>
											</li>
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#advantages" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-swap ml-10"></i>معایب و مزایا
												</a>
											</li>
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#pictures" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-collection-image ml-10"></i>تصاویر محصول
												</a>
											</li>
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#description" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-comment-text ml-10"></i>توضیح محصول
												</a>
											</li>
											<li class="active" role="presentation">
												<a aria-expanded="true"  data-toggle="tab" role="tab" id="home_tab_11" href="#info">
													<i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>درباره محصولات
												</a>
											</li>											
										</ul>
										<div class="tab-content" id="myTabContent_11">
											<div  id="info" class="tab-pane fade active in" role="tabpanel">
												<div class="row">
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group @if( $errors->has('name') ) has-error @endif">
															<label class="control-label mb-10">نام محصول</label>
															<div class="input-group">
																<input type="text" name="name" @isset($edit) value="{{$product->name}}" @else value="{{old('name')}}" @endisset id="firstName" class="form-control" placeholder="مثلا : 'گوشی موبایل سامسونگGalaxy S7'">
																<div class="input-group-addon"><i class="ti-text"></i></div>
															</div>
															@if( $errors->has('name') )
																<span class="help-block">{{ $errors->first('name') }}</span>
															@endif
														</div>
													</div>
													
													<div class="col-md-6">
														<div class="form-group @if( $errors->has('code') ) has-error @endif">
															<label class="control-label mb-10">شناسه محصول</label>
															<div class="input-group">
																<input type="text" name="code" @isset($edit) value="{{$product->code}}" @else value="{{old('code')}}" @endisset id="firstName" class="form-control" placeholder="شناسه محصول در فروشگاه شما ، مثلا : B43E7">
																<div class="input-group-addon"><i class="ti-id-badge"></i></div>
															</div>
															@if( $errors->has('code') )
																<span class="help-block">{{ $errors->first('code') }}</span>
															@endif
														</div>
													</div>
			
													<div class="col-md-12">
														<div class="form-group @if( $errors->has('short_description') ) has-error @endif">
															<label class="control-label mb-10">توضیح کوتاه</label>
															<div class="input-group">
																<textarea class="form-control" id="short_description" name="short_description" style="resize:none;" placeholder="یک توضیح یک خطی درباره محصول" rows="5">@isset($edit){{$product->short_description}}@else{{old('short_description')}}@endisset</textarea>
																<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
															</div>
															@if( $errors->has('short_description') )
																<span class="help-block">{{ $errors->first('short_description') }}</span>
															@endif
														</div>
													</div>
													<!--/span-->
												</div>
												<!-- Row -->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group @if( $errors->has('parent') ) has-error @endif">
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
															@if( $errors->has('parent') )
																<span class="help-block">{{ $errors->first('parent') }}</span>
															@endif
															
														</div>
													</div>
													<!--/span-->
			
													<div class="col-md-6">
														<div class="form-group @if( $errors->has('aparat_video') ) has-error @endif">
															<label class="control-label mb-10">ویدیوی آپارات</label>
															<div class="input-group">
																<input type="text" name="aparat_video" dir="ltr" @if(isset($edit) && !empty($product->aparat_video)) value="https://www.aparat.com/v/{{$product->aparat_video}}" @else value="{{old('aparat_video')}}" @endif id="firstName" class="form-control" placeholder="https://www.aparat.com/v/kN0SI : لینک ویدیوی شما در آپارات ، مثلا">
																<div class="input-group-addon"><i class="ti-video-clapper"></i></div>
															</div>
															@if( $errors->has('aparat_video') )
																<span class="help-block">{{ $errors->first('aparat_video') }}</span>
															@endif
														</div>
													</div>
												</div>
												<!--/row-->
												<!-- Row -->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group @if( $errors->has('brand') ) has-error @endif">
															<label class="control-label mb-10">برند</label>
															<div class="input-group">
																<select name="brand" class="form-control select2 categories">
																	<option value="">بدون برند</option>
																	@foreach ($brands as $item)
																	<option value="{{ $item->id }}">{{ $item->title }}</option>
																	@endforeach
																</select>
																<div class="input-group-addon"><i class="ti-apple"></i></div>
															</div>
															@if( $errors->has('brand') )
																<span class="help-block">{{ $errors->first('brand') }}</span>
															@endif
															
														</div>
													</div>

													<div class="col-md-3">
														<div class="form-group @if( $errors->has('label') ) has-error @endif">
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
															@if( $errors->has('label') )
																<span class="help-block">{{ $errors->first('label') }}</span>
															@endif
															
														</div>
													</div>
													<!--/span-->			
													<div class="col-md-3">
														<div class="form-group @if( $errors->has('status') ) has-error @endif">
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
														@if( $errors->has('status') )
															<span class="help-block">{{ $errors->first('status') }}</span>
														@endif
													</div>
												</div>
												<!--/row-->
											</div>
						
											<div  id="description" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group @if( $errors->has('full_description') ) has-error @endif">
															<label for="full_description" style="margin-bottom: 15px">توضیحات کامل محصول</label>
															<textarea name="full_description" id="full_description" class="form-control">@isset($edit) {{$product->full_description}} @else {{old('full_description')}} @endisset</textarea>
															@if( $errors->has('full_description') )
																<span class="help-block">{{ $errors->first('full_description') }}</span>
															@endif
														</div>
														<script>
															CKEDITOR.replace( 'full_description', {
																language: 'fa'
															});
														</script>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<div class="form-group @if( $errors->has('keywords') ) has-error @endif" class="remove-outline">
															<label class="control-label mb-10">کلمات کلیدی</label>
															<input type="text" @isset($edit) value="{{$product->keywords}}" @else value="{{old('keywords')}}" @endisset name="keywords" data-role="tagsinput" placeholder="افزودن کلمه کلیدی"/>
															@if( $errors->has('keywords') )
																<span class="help-block">{{ $errors->first('keywords') }}</span>
															@endif
														</div>
													</div>
													
													<div class="col-md-12">
														<div class="form-group @if( $errors->has('note') ) has-error @endif">
															<label class="control-label mb-10">یادداشت</label>
															<div class="input-group">
																<textarea class="form-control" id="note" name="note" style="resize:none;" placeholder="یادداشت شما برای این محصول که به مشتری نمایش داده نمیشود !" rows="5">@isset($edit){{$product->note}}@else{{old('note')}}@endisset</textarea>
																<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
															</div>
															@if( $errors->has('note') )
																<span class="help-block">{{ $errors->first('note') }}</span>
															@endif
														</div>
													</div>
												</div>
											</div>

											<div id="pictures" class="tab-pane fade" role="tabpanel">
													<div class="row">
															<div class="col-sm-12">
																<div class="panel panel-default border-panel card-view">
																	<div class="panel-heading">
																		<div class="pull-left">
																			<h6 class="panel-title txt-dark">With remove link</h6>
																		</div>
																		<div class="clearfix"></div>
																	</div>
																	<div class="panel-wrapper collapse in">
																		<div class="panel-body">
																			<div class="">
																				<form action="#" class="dropzone" id="my-awesome-dropzone">
																					<div class="fallback">
																						<input name="file" type="file" multiple />
																					</div>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
											</div>
											<div id="advantages" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group advantages @if( $errors->has('advantages') ) has-error @endif">
															<input type="text" name="advantages" @isset($edit) value="{{$product->advantages}}" @else value="{{old('advantages')}}" @endisset data-role="tagsinput" class="form-control" placeholder="مزیت محصول">
															@if( $errors->has('advantages') )
																<span class="help-block">{{ $errors->first('advantages') }}</span>
															@endif
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group disadvantages @if( $errors->has('disadvantages') ) has-error @endif">
															<input type="text" name="disadvantages" @isset($edit) value="{{$product->disadvantages}}" @else value="{{old('disadvantages')}}"  @endisset data-role="tagsinput" class="form-control" placeholder="عیب محصول">
															@if( $errors->has('disadvantages') )
																<span class="help-block">{{ $errors->first('disadvantages') }}</span>
															@endif
														</div>
													</div>
												</div>
											</div>
											<div id="specifications" class="tab-pane fade" role="tabpanel">
												<div class="container">
													<div class="specs-table row">
														@if(isset($edit) && !empty($spec_table))
															<?php 
																$spec_table = json_decode($spec_table, true);
																$specs = json_decode($product->specifications, true);
															?>
															
															@foreach ($spec_table as $item)
																<div class="row">
																	<div class="col-md-2">
																		<h5 class="mb-10 col-md-12 border-bottom">
																			<i class="ti-angle-double-left" style="font-size: 15px; color:darkgray; margin-left: 5px;"></i>
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
															
															<input type="hidden" name="spec_table" value="{{ $product -> spec_table }}" />
														@else
														<input type="hidden" name="specs" value="" />
														<div class="alert alert-warning alert-dismissable col-md-12">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
															هنوز گروهی انتخاب نکرده اید یا گروه مورد نظر شما دارای جدول اطلاعات فنی نیست 
														</div>
														@endif
													</div>
												</div>
											</div>
											<div id="variations" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group @if( $errors->has('price') ) has-error @endif">
															<label class="control-label mb-10">قیمت</label>
															<div class="input-group">
																<input type="number" min="0" @isset($edit) value="{{$product->price}}" @else value="{{old('price')}}"  @endisset name="price" class="form-control" id="exampleInputuname" placeholder="مثلا : 1550000">
																<div class="input-group-addon"><i class="ti-money"></i></div>
															</div>
															@if( $errors->has('price') )
																<span class="help-block">{{ $errors->first('price') }}</span>
															@endif
														</div>
													</div>
			
													<div class="col-md-2">
														<div class="form-group @if( $errors->has('unit') ) has-error @endif">
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
															@if( $errors->has('unit') )
																<span class="help-block">{{ $errors->first('unit') }}</span>
															@endif
														</div>
													</div>
													<!--/span-->
			
													<div class="col-md-2">
														<div class="form-group @if( $errors->has('offer') ) has-error @endif">
															<label class="control-label mb-10">تخفیف</label>
															<div class="input-group">
																<input type="number" name="offer" @isset($edit) value="{{$product->offer}}" @else value="{{old('offer')}}" @endisset class="form-control" id="exampleInputuname_1" placeholder="مثلا 36%" min="0" max="99">
																<div class="input-group-addon"><i class="ti-cut"></i></div>
															</div>
															@if( $errors->has('offer') )
																<span class="help-block">{{ $errors->first('offer') }}</span>
															@endif
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group @if( $errors->has('offer_deadline') ) has-error @endif">
															<label class="control-label mb-10">مهلت تخفیف</label>
															<div class="input-group">
																<input type="text" dir="ltr" data-mask="9999/99/99 99:99" name="offer_deadline" @isset($edit) value="{{$product->offer_deadline}}" @else value="{{old('offer_deadline')}}" @endisset class="form-control" id="exampleInputuname_1" placeholder="برای مثال :  ۱۳:۴۰ ۱۳۹۷/۰۵/۲۴" min="0" max="99">
																<div class="input-group-addon"><i class="ti-timer"></i></div>
															</div>
															@if( $errors->has('offer_deadline') )
																<span class="help-block">{{ $errors->first('offer_deadline') }}</span>
															@endif
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<div class="form-group @if( $errors->has('stock_inventory') ) has-error @endif">
															<label class="control-label mb-10">تعداد موجود در انبار</label>
															<div class="input-group">
																<input type="number" name="stock_inventory" min="0" @isset($edit) value="{{$product->stock_inventory}}" @else value="{{old('stock_inventory')}}" @endisset id="firstName" class="form-control" placeholder="موجودی این محصول در انبار شما">
																<div class="input-group-addon"><i class="ti-layout-grid4-alt"></i></div>
															</div>
															@if( $errors->has('stock_inventory') )
																<span class="help-block">{{ $errors->first('stock_inventory') }}</span>
															@endif
														</div>
													</div>
													
													<div class="col-sm-4">
														<div class="form-group @if( $errors->has('colors') ) has-error @endif">
															<label class="control-label mb-10">رنگ</label>
															<div class="input-group">
																<select name="brand" class="form-control select2 categories">
																	<option value="">بدون رنگ</option>
																	@foreach ($colors as $item)
																	<option value="{{ $item->value }}">{{ $item->name }}</option>
																	@endforeach
																</select>
																<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
															</div>
															@if( $errors->has('colors') )
																<span class="help-block">{{ $errors->first('colors') }}</span>
															@endif
														</div>
													</div>
													<!--/span-->

													<div class="col-md-6">
														<div class="form-group @if( $errors->has('warranty') ) has-error @endif">
															<label class="control-label mb-10">گارانتی</label>
															<div class="input-group">
																<select name="brand" class="form-control select2 categories">
																	<option value="">بدون گارانتی</option>
																	@foreach ($warranties as $item)
																	<option value="{{ $item->id }}">{{ $item->title }} {{ $item->expire }}</option>
																	@endforeach
																</select>
																<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
															</div>
															@if( $errors->has('warranty') )
																<span class="help-block">{{ $errors->first('warranty') }}</span>
															@endif
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-actions">
										<button class="btn btn-orange btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره</span></button>
										<a href="/panel/products" class="btn btn-default pull-left">لغو</a>
										<div class="clearfix"></div>
									</div>

									@isset($edit) @method('put') @endisset
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
		'vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',
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

		// Dropzone JavaScript
		'vendors/bower_components/dropzone/dist/dropzone.js',
		// Dropzone Init JavaScript
		'dist/js/dropzone-data.js',

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

	<script>
		@isset($edit)
			$(window).load(function () {
				var color = $('select.color-value').val();
				$('input.color-value').val(color);
				
				var li = $('li.select2-selection__choice').first();
				for (var i = 0; i < color.length; ++i) {
					li.css({background: color[i]});
					li = li.next();
				}
			});
		@endisset

	</script>
@endsection