@extends('blog._share.layout')

@section('content')
    <div class="row">
        @foreach ($articles as $article)
            <div class="col-6">
                <div class="card">
{{--                        <img src="..." class="card-img-top" alt="...">--}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ mb_strimwidth(strip_tags($article->body_html), 0, 100, '……', 'UTF-8') }}</p>
                        <a href="{{ route('blog.article.detail', ['id' => $article->id]) }}" class="btn btn-primary">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
