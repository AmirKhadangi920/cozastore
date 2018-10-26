@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		//  Custom Fonts
		'dist/css/font-awesome.min.css',
		//  Calendar CSS
		'vendors/bower_components/fullcalendar/dist/fullcalendar.css"',
		//  Custom CSS
		'dist/css/style.css',
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
					<li class="active"><span>محصولات</span></li>
				</ol>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">محصولات</h5>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		
		<!-- Group Row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-dark">جستجو در محصولات</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  class="panel-wrapper collapse in">
						<div  class="panel-body">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="product_name" id="firstName" class="form-control" placeholder="مثلا : تلفن همراه">
									<div class="input-group-addon"><i class="ti-search"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Group Row -->

		<div class="seprator-block"></div>
		
		<!-- Product Row One -->
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>	
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>			
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>
			<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
				<div class="panel panel-default card-view pa-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<article class="col-item">
								<div class="photo">
									<div class="options">
										<a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
										<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
									</div>
									
									<a href="javascript:void(0);"> <img src="<?=IMG?>products/V9 4GB 64GB Black - Vivo.jpg" class="img-responsive" alt="Product Image" /> </a>
								</div>
								<div class="info">
									<h6>اپل iPhone X</h6>
									<div class="product-rating inline-block">
										<a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
									</div>
									<span class="head-font block txt-orange-light-1 font-16">200 تومان</span>
								</div>
							</article>
						</div>
					</div>	
				</div>	
			</div>

		</div>	
		<!-- /Product Row Four -->
		
		<div class="row">
			<div class="col-md-5"></div>

			<div class="col-md-2">
				<input type="button" class="btn btn-primary col-md-12" value="بارگذاری بیشتر ..." />
			</div>
		</div>
		
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
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		'dist/js/sweetalert-data.js',
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