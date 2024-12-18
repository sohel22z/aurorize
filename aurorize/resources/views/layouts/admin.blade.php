<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="google" content="notranslate">

    <meta content="" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.admin.admin-head')
</head>

<body class="left-sidebar">
    <!-- Pre-loader -->
    {{-- <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="circle1"></div>
                <div class="circle2"></div>
                <div class="circle3"></div>
            </div>
        </div>
    </div> --}}
    
    <div id="preloader">
        <div class="loader">
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--text"></div>
        </div>
    </div>
    <!-- End Preloader-->
    <div id="wrapper">
        @include('layouts.admin.admin-header', ['menuIcon' => true])

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">
            <div class="sidebar-content">
                <!--- Sidemenu -->
                <div id="sidebar-menu" class="slimscroll-menu">
                    @include('layouts.admin.admin-menu')
                </div><!-- End Sidebar -->
                <div class="clearfix"></div>
            </div><!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('breadcrumb')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @yield('rightconent')
    @include('layouts.admin.footer-script', ['notificationjs' => false])
    @include('layouts.shared.toast-message')
</body>
</html>
