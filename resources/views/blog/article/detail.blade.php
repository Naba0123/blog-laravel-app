@extends('blog._share.layout', ['title' => $article->title])

@section('content')
    <div class="lba-article-header">
        <h1>{{ $article->title }}</h1>
        <div class="lba-article-category">
            <ul>
                <li>category</li>
                <li>category</li>
            </ul>
        </div>
    </div>

    <hr/>

    <div class="lba-article-body">
        {!! $bodyHtml !!}
    </div>

    <hr/>

    <div class="lba-article-footer">
        footer
    </div>
@endsection
