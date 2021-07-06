@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.article.save') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $article->id ?? 0 }}"/>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $article->id ? 'Edit Article' : 'New Article' }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="labelFormTitle">Title</label>
                    <input type="text" name="title" value="{{ $article->title ?? old('title') }}" class="form-control" id="labelFormTitle" placeholder="Enter Title" required>
                </div>
                <div class="form-group">
                    <label>Textarea</label>
                    <textarea name="body" class="form-control" rows="10" placeholder="Enter Body" required>{!! $article->body ?? old('body') !!}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection

@section('content-script')
    <script>
        $(function() {
            // $('#dataTable').dataTable({});
        });
    </script>
@endsection
