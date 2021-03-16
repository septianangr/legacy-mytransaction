<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/image/icon/default.png') }}" rel="icon">
    @stack('styles')
    <style>
        body,
        html {
            height: 100%;
        }
        .alert-text {
            font-size: 0.95em;
        }
    </style>
    <title>@yield('title')</title>
</head>

<body class="bg-light font-weight-light">
    <nav class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mx-auto navbar navbar-dark bg-danger navbar-expand">
        <h1 class="navbar-brand font-weight-light">
            <img class="mb-1" src="{{ asset('assets/image/icon/default.png') }}" width="30" height="30"> {{ $site_name }}
        </h1>
    </nav>
    @include($nav_role . '.navigation')