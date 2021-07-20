<h3 class="mb-2">Related Articles</h3>

<div class="row">
    @foreach($articles as $article)
        <div class="col-sm-6">
            <div class="mt-3 mb-3 lb-box-shadow-lightgray">
                @include('blog._parts.list_article', ['article' => $article])
            </div>
        </div>
    @endforeach
</div>
