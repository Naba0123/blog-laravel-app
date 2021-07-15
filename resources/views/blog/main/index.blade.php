@extends('blog._share.layout')

@section('content')
    <div class="row">
        @foreach ($articles as $article)
            <div class="col-6 mb-2">
                @include('blog._parts.list_article', ['article' => $article])
            </div>
        @endforeach
    </div>
@endsection
