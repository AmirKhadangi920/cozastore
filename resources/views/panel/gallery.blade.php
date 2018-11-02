@extends('panel.master.main')

@section('styles')
	<?php $styles = [
        // Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach
    
    <style>
    .project-gallery a {
        box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
        transition: box-shadow 300ms;
    }
    
    .project-gallery a:hover {
        box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
    }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Title -->
        <div class="row heading-bg">
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active"><span>گالری</span></li>
                <li><a href="/panel">داشبورد</a></li>
            </ol>
            </div>
            <!-- /Breadcrumb -->
            
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">گالری</h5>
            </div>
        </div>
        <!-- /Title -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <h6 class="panel-title txt-dark">آپلود تصویر جدید</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="form-wrap">
                                <form>
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="exampleInputuname_2">نام تصویر</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="exampleInputuname_2" placeholder="برای مثال : Apple_iPhone_X_back">
                                            <div class="input-group-addon"><i class="icon-picture"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="exampleInputEmail_2">توضیح کوتاه</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" id="exampleInputEmail_2" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
                                            <div class="input-group-addon"><i class="icon-speech"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-success pull-left mr-10">آپلود تصویر</button>
                                    </div>
                                </form>
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="mt-10 mb-10">
                                <input type="file" id="input-file-now" class="dropify" />
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="seprator-block"></div>

        <!-- Row -->
        <div class="row" dir="ltr">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <?php
                            $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/products';
                            $files = scandir($path);

                            $files = array_diff(scandir($path), array('.', '..'));
                            ?>
                            <div class="gallery-wrap">
                                <div class="portfolio-wrap project-gallery">
                                    <ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
                                        @foreach ($files as $file)
                                            <li  class="item tall"  data-src="{{ asset('uploads/products/'.$file) }}" data-sub-html="<p>این عکس متعلق به گالری عکس های فروشگاه شما میباشد</p>" >
                                                <a href="">
                                                <img class="img-responsive" src="{{ asset('uploads/products/'.$file) }}"  alt="Image description" />
                                                <span class="hover-cap">{{$file}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
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
        // Gallery JavaScript
        'dist/js/isotope.js',
        'dist/js/lightgallery-all.js',
        'dist/js/froogaloop2.min.js',
        'dist/js/gallery-data.js',
        // Slimscroll JavaScript
        'dist/js/jquery.slimscroll.js',
        // Fancy Dropdown JS
        'dist/js/dropdown-bootstrap-extended.js',
        // Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js',
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
    
    <script> $('.dropify').dropify(); </script>
@endsection