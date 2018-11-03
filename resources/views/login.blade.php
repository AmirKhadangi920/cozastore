<!DOCTYPE html>
<html lang="fa" dir="rtl">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>ورود به حساب</title>
		<meta name="description" content="Splasher is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Splasher Admin, Splasheradmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
		<!-- Custom CSS -->
		<link href="/dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper  pa-0">
			<header class="sp-header">
				<div class="form-group mb-0 pull-left">
					<span class="inline-block pl-10">تا کنون ثبت نام نکرده اید ؟</span>
					<a class="inline-block btn btn-danger btn-rounded " href="signup.html">ثبت نام</a>
				</div>
				
				<div class="sp-logo-wrap pull-right">
					<a href="index.html">
						<img class="brand-img ml-10" src="{{ asset('images/logo.png') }}" alt="brand"/>
						<span class="brand-text"><img  src="{{ asset('images/brand.png') }}" alt="brand"/></span>
					</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">ورود به هایکو استور</h3>
											<h6 class="text-center nonecase-font txt-grey">اطلاعات حساب خود را واید کنید</h6>
										</div>	
										<div class="form-wrap">
											<form action="#">
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">آدرس ایمیل</label>
													<input type="email" class="form-control" required="" id="exampleInputEmail_2" placeholder="آدرس ایمیل خود را وارد کنید ">
												</div>
												<div class="form-group">
													<label class="pull-right control-label mb-10" for="exampleInputpwd_2">رمز عبور</label>
													<a class="capitalize-font txt-danger block mb-10 pull-left font-12" href="forgot-password.html">رمز عبور خود را فراموش کرده اید ؟</a>
													<div class="clearfix"></div>
													<input type="password" class="form-control" required="" id="exampleInputpwd_2" placeholder="رمز عبور خود را وارد کنید">
												</div>
												
												{{-- <div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-right">
														<input id="checkbox_2" required="" type="checkbox">
														<label for="checkbox_2"> مرا به خاطر بسپار</label>
													</div>
													<div class="clearfix"></div>
												</div> --}}
												<div class="form-group text-center">
													<button type="submit" class="btn btn-danger btn-rounded">ورود</button>
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
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="/vendors/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="/dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="/dist/js/init.js"></script>
	</body>
</html>
