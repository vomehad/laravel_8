<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    @yield('meta')
    <title>@yield('title')</title>
    @include('includes.assets.css')
    @include('includes.assets.fonts')
    @yield('head')
</head>
<body class="container body-content">
@include('includes.header')
<div class="container">
    @include('includes.assets.messages')
    <div class="row">
        <div class="col-10">
            @yield('content')
        </div>
        <div class="col-2">
            @include('includes.aside')
        </div>
    </div>
</div>
@include('includes.assets.js')
@include('includes.footer')
@yield('body')
</body>
</html>
