@extends('blog._share.layout', ['title' => $article->title])

@section('content')
    <div class="lb-bg-gofun lb-content">
        <div class="lb-article-header">
            @include('blog._parts.navigation_buttons', ['prev' => $prevLink, 'next' => $nextLink])

            <h1 class="lb-article-title">{{ $article->title }}</h1>

            @include('blog._parts.article_info', ['article' => $article])
        </div>

        <hr/>

        @if ($article->created_at->timestamp != $article->updated_at->timestamp)
            <div class="lb-article-updated_at">
                <p>Last Updated at {{ $article->updated_at->format('Y-m-d H:i') }}</p>
            </div>
        @endif

        <div class="lb-article-body">
            {!! $bodyHtml !!}
        </div>

        <hr class="mb-4 mt-4"/>

        <div class="lb-article-footer">
            @include('blog._parts.related_articles', ['articles' => $relatedArticles])
        </div>
    </div>
@endsection
