<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('admin.common.title') }}@if(true) | a @endif</title>
    @yield('head-content')
</head>
@yield('body')
</html>
