<div class="lba-category-list">
    <ul>
        @foreach ($categories as $category)
            <li><a href="{{ route('blog.category.detail', ['category_id' => $category->id]) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>
