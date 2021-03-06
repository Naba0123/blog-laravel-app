<div class="row lb-footer-container">
    <div class="col-sm-8">
        <h3>Category List</h3>
        <div class="lb-category-list lb-footer-content">
            <ul>
                @foreach ($categories as $category)
                    @if ($category->articles->count() < 1)
                        @continue
                    @endif
                    <li class="mr-2">
                        <a href="{{ route('blog.category.detail', ['category_id' => $category->id]) }}">
                            <i class="fa fa-tag"></i> {{ $category->name }} ({{ $category->articles->count() }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-sm-4">
        <h3>Author</h3>
        <div class="lb-footer-content">
            <h4>{{ setting(\App\Models\Common\CBlogSetting::KEY_AUTHOR_NAME) }}</h4>
            <p>
                {!! setting(\App\Models\Common\CBlogSetting::KEY_AUTHOR_DESCRIPTION) !!}
            </p>
        </div>
    </div>
</div>

<div class="lb-copyright">
    <p>(c) {{ date('Y') }} {{ setting('blog_title') }}</p>
</div>
