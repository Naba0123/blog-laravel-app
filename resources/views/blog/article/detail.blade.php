@extends('blog._share.layout', ['title' => $article->title])

@section('content')
    <div class="lb-article-header">
        @include('blog._parts.navigation_buttons')

        <h1 class="lb-article-title">{{ $article->title }}</h1>
        @include('blog._parts.category_list', ['categories' => $article->categories])
    </div>

    <hr/>

    <div class="lb-article-body">
        {!! $bodyHtml !!}
    </div>

    <hr/>

    <div class="lb-article-footer">
        footer
    </div>
@endsection
