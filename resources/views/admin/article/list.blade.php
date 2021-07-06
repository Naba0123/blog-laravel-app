@extends('admin._share.layout')

@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <a href="{{ route('admin.article.edit') }}">
                <button type="button" class="btn btn-primary mb-2">New Article</button>
            </a>
            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>body</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ mb_strimwidth(strip_tags($article->body), 0, 100, '……', 'UTF-8') }}</td>
                        <td>{{ $article->created_at }}</td>
                        <td>{{ $article->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.article.edit', ['id' => $article->id]) }}">
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
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
            // $('#dataTable').dataTable({});
        });
    </script>
@endsection
