@extends('blog._share.layout', ['title' => $category->name])

@section('content')

    <div class="lb-content-header">
        <h2><i class="fa fa-tag"></i> {{ $category->name }}</h2>
    </div>

    @include('blog._parts.article_list', ['articles' => $articles])

@endsection
