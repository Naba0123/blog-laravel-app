<div class="lb-article-info">
    <div class="lb-article-categories">
        @include('blog._parts.category_list', ['categories' => $article->categories->sortBy('name')])
    </div>
    <div class="lb-article-created">
        <p><i class="fa fa-calendar"></i> {{ $article->created_at->format('Y-m-d H:i') }}</p>
    </div>
</div>
