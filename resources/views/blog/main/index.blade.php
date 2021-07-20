@extends('blog._share.layout')

@section('content')
    @foreach ($articles as $article)
        <div class="mt-5 mb-5 lb-box-shadow-gray">
            @include('blog._parts.list_article', ['article' => $article])
        </div>
    @endforeach
@endsection
