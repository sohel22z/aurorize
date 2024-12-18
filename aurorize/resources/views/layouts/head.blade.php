<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" href="{{ Helper::assets('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ Helper::assets('favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ Helper::assets('assets/css/vendors.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ Helper::assets('assets/vendors/css/extensions/sweetalert.css') }}">
    <!-- END VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="{{ Helper::assets('assets/css/app.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ Helper::assets('assets/css/plugins/loaders/loaders.min.css') }}">

    @yield('header-script')

    <link rel="stylesheet" type="text/css" href="{{ Helper::assets('assets/css/custom.css') }}">
</head>
