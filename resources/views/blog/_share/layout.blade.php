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
</head>
<body class="lb-bg-wasurenagusa-gunjyo">

<header class="lb-bg-gofun">
    <div class="container">
        <a href="{{ url('/') }}">
            <h1>{{ setting('blog_title') }}</h1>
        </a>
    </div>
</header>

<div class="container">
    @yield('content')
</div>

<footer class="lb-bg-gofun">
    <div class="container">
        @include('blog._share.copyright')
    </div>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@yield('content-js')

</body>
</html>
