@extends('admin._share.layout')

@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <a href="{{ route('admin.article.edit', ['article_id' => 0]) }}">
                <button type="button" class="btn btn-primary mb-2">New Article</button>
            </a>
            <table id="lb-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Article ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->categories->pluck('name')->join(', ') }}</td>
                        <td>{{ omit_markdown_str($article->body) }}</td>
                        <td>{{ $article->created_at }}</td>
                        <td>{{ $article->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.article.edit', ['article_id' => $article->id]) }}">
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                            <form action="{{ route('admin.article.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}"/>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        $(function() {
            $('#lb-table').dataTable({});
        });
    </script>
@endsection
