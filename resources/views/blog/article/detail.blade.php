@extends('blog._share.layout', ['title' => $article->title])

@section('content')
    <div class="lb-bg-gofun lb-content">
        <div class="lb-article-header">
            @include('blog._parts.navigation_buttons', ['prev' => $prevLink, 'next' => $nextLink])

{{--            @include('blog._parts.google_adsense', ['client' => config('blog.adsense.client'), 'slot' => config('blog.adsense.slots.article_top')])--}}

            <h1 class="lb-article-title">{{ $article->title }}</h1>

            @include('blog._parts.article_info', ['article' => $article])

            @if ($article->created_at->timestamp != $article->updated_at->timestamp)
                <div class="lb-article-updated_at">
                    <p>Updated at <i class="fa fa-calendar"></i> {{ $article->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            @endif
        </div>

        <hr/>

        <div class="lb-article-sns-share">
            @include('blog._parts.twitter_share_button')
        </div>

        <div class="lb-article-body">

            <!-- Summary -->
            <div class="lb-article-summary">
                <h4><i class="fas fa-comment"></i> Summary</h4>
                <p>{!! $article->description !!}</p>
            </div>

            {!! $bodyHtml !!}
        </div>

        <div class="lb-article-sns-share">
            @include('blog._parts.twitter_share_button')
        </div>

        <hr class="mb-4 mt-4"/>

        @include('blog._parts.google_adsense', ['client' => config('blog.adsense.client'), 'slot' => config('blog.adsense.slots.article_bottom')])

        <div class="lb-article-footer">
            @include('blog._parts.related_articles', ['articles' => $relatedArticles])
        </div>
    </div>
@endsection
