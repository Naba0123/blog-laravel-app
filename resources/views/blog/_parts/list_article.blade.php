<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $article->title }}</h5>
        @include('blog._parts.list_category', ['categories' => $article->categories])
        <p class="card-text">{{ mb_strimwidth(strip_tags($article->body_html), 0, 100, '……', 'UTF-8') }}</p>
        <a href="{{ route('blog.article.detail', ['article_id' => $article->id]) }}" class="btn btn-primary">
            Detail
        </a>
    </div>
</div>
