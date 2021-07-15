@extends('blog._share.layout', ['title' => $category->name])

@section('content')
    <div class="lba-article-header">
        <h1>{{ $category->name }}</h1>
    </div>

    <hr/>

    <div class="lba-article-body">
        <div class="row">
            @foreach ($category->articles as $article)
                <div class="col-6">
                    @include('blog._parts.list_article', ['article' => $article])
                </div>
            @endforeach
        </div>
    </div>

    <hr/>

    <div class="lba-article-footer">
        footer
    </div>
@endsection
