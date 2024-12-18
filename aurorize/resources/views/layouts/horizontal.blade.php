<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('layouts.shared.head')
</head>
<body data-layout="topnav">
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="circle1"></div>
                <div class="circle2"></div>
                <div class="circle3"></div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->
    <div id="wrapper">
        @include('layouts.admin.header', ['menuIcon' => false])

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    @yield('breadcrumb')
                    @yield('content')
                </div>
            </div>

            {{-- @include('layouts.shared.footer') --}}
        </div>
    </div>

    {{-- @include('layouts.shared.rightbar') --}}

    @include('layouts.admin.footer-script')
    @include('layouts.shared.toast-message')
</body>
</html>