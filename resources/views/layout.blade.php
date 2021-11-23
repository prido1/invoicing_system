<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description-Pritech" content="">
    <meta name="author-Pritech" content="">
    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{asset('assets\images\favicon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets\images\favicon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets\images\favicon.png')}}">
    <title>@yield('title')</title>
    @include('partials/styles')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@include('partials/navbar')

@include('partials/side-bar')

@section('content')
@show

</div>
@include('partials.footer')
@include('partials/scripts')
@stack('scripts')
</body>

</html>
