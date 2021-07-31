@include('blog._parts.pagination_buttons')

@foreach ($articles as $article)
    <div class="mt-5 mb-5 lb-box-shadow-gray">
        @include('blog._parts.article_card', ['article' => $article])
    </div>
@endforeach

@include('blog._parts.pagination_buttons')
