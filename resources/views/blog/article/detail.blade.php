@extends('blog._share.layout', ['title' => $article->title])

@section('content')
    <div class="lba-article-header">
        <h1>{{ $article->title }}</h1>
        @include('blog._parts.list_category', ['categories' => $article->categories])
    </div>

    <hr/>

    <div class="lba-article-body">
        {!! $bodyHtml !!}
    </div>

    <hr/>

    <div class="lba-article-footer">
        footer
    </div>
@endsection
