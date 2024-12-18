<!doctype html>
<html lang="en" translate="no">

<head>
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="google" content="notranslate">

    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('layouts.admin.admin-head')
</head>

<body>
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
    @yield('content')
    @include('layouts.admin.footer-script')
    @include('layouts.shared.toast-message')
</body>
</html>