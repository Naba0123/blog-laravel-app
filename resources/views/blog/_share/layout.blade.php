<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <title>{{ setting('blog_title') }}</title>

    @yield('head-content')

    @yield('content-css')
</head>
<body>
@yield('content')

<!-- Bootstrap Bundle with Popper -->
<script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@yield('content-js')
</body>
</html>
