@extends('blog._share.layout')

@section('content')
    <div class="lb-content-header">
        <h2>Recent Articles</h2>
    </div>

    @foreach ($articles as $article)
        @include('blog._parts.list_article', ['article' => $article])
    @endforeach
@endsection
