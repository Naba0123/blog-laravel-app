@extends('blog._share.layout')

@section('content')
    <div class="row">
        @foreach ($articles as $article)
            <div class="col-4">
                <div class="card">
{{--                    <img src="..." class="card-img-top" alt="...">--}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->body }}</p>
{{--                        <a href="#" class="btn btn-primary">Go somewhere</a>--}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
