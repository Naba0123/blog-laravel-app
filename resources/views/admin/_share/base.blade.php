<!DOCTYPE html>
<html lang="{{ lang() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $_currentMenu ? $_currentMenu['text'] . ' | ' : '' }}{{ setting('blog_title') }}</title>
    @yield('head-content')
</head>
@yield('body')
</html>
