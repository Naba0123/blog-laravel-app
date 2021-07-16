@php
$detailUrl = route('blog.article.detail', ['article_id' => $article->id]);
@endphp

<div class="card lb-bg-gofun mb-3 lb-box-shadow">
    <div class="card-body">
        <a href="{{ $detailUrl }}"><h3 class="card-title lb-article-title">{{ $article->title }}</h3></a>
        <div class="lb-article-info">
            <div class="lb-article-categories">@include('blog._parts.category_list', ['categories' => $article->categories])</div>
            <div class="lb-article-created"><p>{{ $article->created_at }}</p></div>
        </div>
        <hr/>
        <p class="card-text">{{ omit_markdown_str($article->body) }}</p>
    </div>
</div>
