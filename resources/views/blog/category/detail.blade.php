@extends('blog._share.layout', ['title' => $category->name])

@section('content')

    <div class="lb-content-header">
        <h2><i class="fa fa-tag"></i> {{ $category->name }}</h2>
    </div>

    @foreach ($category->articles as $article)
        <div class="mt-5 mb-5 lb-box-shadow-gray">
            @include('blog._parts.list_article', ['article' => $article])
        </div>
    @endforeach

@endsection
