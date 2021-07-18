@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.article.save') }}" method="post">
        @csrf
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $article->id ? 'Edit Article' : 'New Article' }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="lb-form-id">Article ID</label>
                    <input type="text" name="article_id" value="{{ $article->id ?? 0 }}" class="form-control" id="lb-form-id" readonly>
                </div>
                <div class="form-group">
                    <label for="lb-form-title">Title</label>
                    <input type="text" name="title" value="{{ old('title') ?: $article->title }}" class="form-control" id="lb-form-title" placeholder="Enter Title" required>
                </div>
                <div class="form-group">
                    <label for="lb-form-category">Category</label>
                    <select multiple="" class="form-control" name="category_ids[]" id="lb-form-category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id, $associatedCategoryIds) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Body Markdown</label>
                    <textarea name="body" class="form-control" rows="10" placeholder="Enter Body" required>{!! old('body') ?: $article->body !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Is Publish</label>
                    <div class="custom-control custom-switch custom-switch-on-success">
                        <input name="is_publish" type="checkbox" class="custom-control-input" id="lb-form-is_publish" {{ $article->is_publish ? 'checked' : '' }}>
                        <label class="custom-control-label" for="lb-form-is_publish">Off will be saved as draft.</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
    @include('admin._parts.back')
@endsection

@section('content-script')
    <script>

    </script>
@endsection
