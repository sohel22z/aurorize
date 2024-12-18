<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="google" content="notranslate">

    <meta content="" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.shared.head')
</head>

@php
$user = null;
if(Auth::guard('web')->check()) {
    $user = Auth::guard('web')->user();
}
@endphp

<body class="pb-0 left-side-menu-dark no-sidebar">
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
        @include('layouts.nav', ['user' => $user])
        @include('layouts.shared.sidebar')

        <div class="content-page pt-3">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            @include('layouts.shared.footer')
        </div>
    </div>
    @include('layouts.admin.footer-script', ['notificationjs' => false])
    @include('layouts.shared.toast-message')
</body>
</html>