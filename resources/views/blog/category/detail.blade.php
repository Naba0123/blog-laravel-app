@extends('blog._share.layout', ['title' => $category->name])

@section('content')
    <div class="lb-content-header">
        <h2><i class="fa fa-tag"></i> {{ $category->name }}</h2>
    </div>

    <div class="lb-article-body">
        @foreach ($category->articles as $article)
            @include('blog._parts.list_article', ['article' => $article])
        @endforeach
    </div>

@endsection
