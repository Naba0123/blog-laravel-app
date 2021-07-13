<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ mix('dist/blog.css') }}" rel="stylesheet">

    <title>{{ (isset($title) ? $title . ' | ' : '') . setting('blog_title') }}</title>

    @yield('head-content')

    @yield('content-css')
</head>
<body class="lb-bg">

<header>
    <div class="container">
        <a href="{{ url('/') }}">
            <h1>{{ setting('blog_title') }}</h1>
        </a>
    </div>
</header>

<div class="main-contents">
    <div class="container">
        <div class="lb-bg lb-contents">
            @yield('content')
        </div>
    </div>
</div>

<footer>
    <div class="container">
        @include('blog._share.copyright')
    </div>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@yield('content-js')

</body>
</html>
