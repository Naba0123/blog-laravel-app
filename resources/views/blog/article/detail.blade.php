@extends('blog._share.layout', ['title' => $article->title])

@section('content')
    <div class="lb-bg-gofun lb-content">
        <div class="lb-article-header">
            @include('blog._parts.navigation_buttons', ['prev' => $prevLink, 'next' => $nextLink])

            <h1 class="lb-article-title">{{ $article->title }}</h1>

            @include('blog._parts.article_info', ['article' => $article])
        </div>

        <hr/>

        <div class="lb-article-body">
            {!! $bodyHtml !!}
        </div>

        <hr/>

        <div class="lb-article-footer">
            footer
        </div>
    </div>
@endsection
