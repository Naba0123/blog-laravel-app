<div class="lb-category-list">
    <ul>
        @foreach ($categories as $category)
            <li class="mr-2">
                <a href="{{ route('blog.category.detail', ['category_id' => $category->id]) }}">
                    <i class="fa fa-tag"></i> {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
