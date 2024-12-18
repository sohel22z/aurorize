<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('layouts.shared.head')
	<style>
		.site-logo{
			font: normal bold 28px 'Roboto',Arial,sans-serif;
		}
	</style>
</head>

<body class="pb-0 left-side-menu-dark no-sidebar">

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator"> 
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    

    <!-- Header Area -->
		<header class="header" >
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.html"><img src="{{Helper::assets('front_assets/img/AOS-logo.jpg')}}" height="100" width="100" alt="#"></a>
									<em class="site-logo">Aurorize</em>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li class="{{ in_array(Route::currentRouteName(),['home']) ? 'active' : '' }} "><a href="{{route('home')}}">Home</a>
											</li>
											<li class="{{ in_array(Route::currentRouteName(),['home.rcm']) ? 'active' : '' }} "><a href="{{ route('home.rcm') }}">RCM </a></li>
											<li class="{{ in_array(Route::currentRouteName(),['home.idr']) ? 'active' : '' }}"><a href=" {{ route ('home.idr') }}">IDR </a></li>
											<li><a href="#">About Us </a></li>
											<li class="{{in_array(Route::currentRouteName(),['home.inquiry']) ? 'active' : '' }} "><a href="{{route('home.inquiry')}}">Contact Us</a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
									<a href="{{route('home.inquiry')}}" class="btn">Contact Us!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
    <!-- End Header Area -->

    <div id="wrapper">
            <!-- Left Sidebar End -->

            {{-- <div class="content-page pt-3">
                <div class="content">
                    <div class="container-fluid"> --}}
                        @yield('content')
                    {{-- </div>
                </div>
            </div> --}}
                @include('layouts.shared.footer')
    </div>
        @include('layouts.shared.footer-script', ['notificationjs' => true])
        @include('layouts.shared.toast-message')
</body>
</html>
