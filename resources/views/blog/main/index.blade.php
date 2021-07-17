@extends('blog._share.layout')

@section('content')
    @foreach ($articles as $article)
        @include('blog._parts.list_article', ['article' => $article])
    @endforeach
@endsection
