@extends('blog._share.layout')

@section('content')

    @include('blog._parts.article_list', ['articles' => $articles])

@endsection
