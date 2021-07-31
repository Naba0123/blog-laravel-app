@php
$detailUrl = route('blog.article.detail', ['article_id' => $article->id]);
@endphp

<div class="card lb-bg-gofun">
    <div class="card-body">
        <h3 class="card-title lb-article-title"><a href="{{ $detailUrl }}">{{ $article->title }}</a></h3>
        @include('blog._parts.article_info', ['article' => $article])
        <hr/>
        <p class="card-text">{{ omit_markdown_str($article->body) }}</p>
    </div>
</div>
