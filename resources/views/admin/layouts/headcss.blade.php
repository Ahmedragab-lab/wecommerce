<meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
<!-- Twitter meta-->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:site" content="@pratikborsadiya">
<meta property="twitter:creator" content="@pratikborsadiya">
<!-- Open Graph Meta-->
<meta property="og:type" content="website">
{{-- <meta property="og:site_name" content="Vali Admin">
<meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
<meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin"> --}}
<meta property="og:image" content="{{ Storage::url('uploads/' . setting('fav_icon')) }}">
<meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/main-teal.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">
    {{--google font--}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:400,600&display=swap">
    <style>
        body {
            font-family: 'cairo', 'sans-serif';
        }

        .breadcrumb-item + .breadcrumb-item {
            padding-left: .5rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            padding-left: .5rem;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 2px 2px;
        }
        .toggle-password{
            position: absolute;left: 25px;bottom: 10px;
        }
    </style>
@endif
@if (app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/main-blue.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">
    <style>
        .toggle-password{
        position: absolute;right: 25px;bottom: 10px;
        }
    </style>
    <!-- Main CSS-->
@endif

<!-- Font-icon css-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet" href="{{ asset('admin_assets/css/custom.css')}}">


