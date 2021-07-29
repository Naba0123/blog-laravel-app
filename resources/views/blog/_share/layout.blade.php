<!DOCTYPE html>
<html lang="{{ lang() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ url('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('dist/blog.css') }}">

    <title>{{ (isset($title) ? $title . ' | ' : '') . setting('blog_title') }}</title>

    @yield('head-content')

    @yield('content-css')

    @include('blog._share.seo')

    @include('blog._share.gtag', ['gTagId' => config('blog.analytics.gtag_id')])
</head>
<body class="lb-bg-base">

<header class="lb-bg-kachi-kurotsurubami lb-box-shadow-gray" style="@if($headerImage = header_image_url()) background-image: url({{ $headerImage }}); background-size:100%; background-position: center @endif">
    <div class="container">
        <h1><a href="{{ url('/') }}">{{ setting('blog_title') }}</a></h1>
        <p class="lb-header-description">{{ setting('blog_description') }}</p>
    </div>
</header>

<div class="container">
    @yield('content')
</div>

<footer class="lb-bg-gofun lb-box-shadow-gray">
    <div class="container">
        @include('blog._share.footer')
    </div>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@yield('content-js')

</body>
</html>
