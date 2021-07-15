@extends('blog._share.layout', ['title' => $article->title])

@section('content')
    <div class="lb-bg-gofun lb-contents">
        <div class="lb-article-header">
            @include('blog._parts.navigation_buttons')

            <h1 class="lb-article-title">{{ $article->title }}</h1>

            <div class="lb-article-info">
                <div class="lb-article-categories">@include('blog._parts.category_list', ['categories' => $article->categories])</div>
                <div class="lb-article-created"><p>{{ $article->created_at }}</p></div>
            </div>
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
