@php
$detailUrl = route('blog.article.detail', ['article_id' => $article->id]);
@endphp

<div class="card">
    <div class="card-body">
        <h5 class="card-title lb-article-title"><a href="{{ $detailUrl }}">{{ $article->title }}</a></h5>
        @include('blog._parts.category_list', ['categories' => $article->categories])
        <p class="card-text">{{ mb_strimwidth(strip_tags($article->body_html), 0, 100, '……', 'UTF-8') }}</p>
    </div>
</div>
