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
                    <label for="lb-form-description">Description</label>
                    <input type="text" name="description" value="{{ old('description') ?: $article->description }}" class="form-control" id="lb-form-description" placeholder="Enter Description" required>
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
                    <label for="lb-form-body">Body Markdown</label>
                    <textarea id="lb-form-body" name="body" class="form-control" rows="10" placeholder="Enter Body" required>{!! old('body') ?: $article->body !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Is Publish</label>
                    <div class="custom-control custom-switch custom-switch-on-success">
                        <input name="is_publish" type="checkbox" class="custom-control-input" id="lb-form-is_publish" {{ $article->is_publish ? 'checked' : '' }}>
                        <label class="custom-control-label" for="lb-form-is_publish">Enable is public article.</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lb-form-created_at">Created At</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input lb-form-switch" id="lb-form-switch-created_at" data-target="created_at">
                        <label class="custom-control-label" for="lb-form-switch-created_at">Enable self setting of created at.</label>
                    </div>
                    <input type="datetime-local" name="created_at" value="{{ old('created_at') ?: ($article->created_at ? $article->created_at->format('Y-m-d\TH:i') : '') }}" class="form-control" id="lb-form-created_at" disabled>
                </div>
                <div class="form-group">
                    <label for="lb-form-updated_at">Updated At</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input lb-form-switch" id="lb-form-switch-updated_at" data-target="updated_at">
                        <label class="custom-control-label" for="lb-form-switch-updated_at">Enable self setting of updated at. (default is saved time)</label>
                    </div>
                    <input type="datetime-local" name="updated_at" value="{{ old('updated_at') ?: ($article->updated_at ? $article->updated_at->format('Y-m-d\TH:i') : '') }}" class="form-control" id="lb-form-updated_at" disabled>
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
        $(function() {
            $('.lb-form-switch').change(function() {
                const target = $(this).data('target');
                if (!target) {
                    return;
                }
                const isDisabled = !$(this).prop('checked');
                lb.switchForm(target, isDisabled);
            });

            @foreach (['created_at', 'updated_at'] as $target)
                @if (old($target) !== null)
                    $('input[data-target={{ $target }}]').prop('checked', true);
                    lb.switchForm('{{ $target }}', false);
                @endif
            @endforeach
        });

        let lb = {
            switchForm: function(target, isDisabled) {
                $('input[name=' + target + ']').prop('disabled', isDisabled);
            },
        };
    </script>
@endsection
