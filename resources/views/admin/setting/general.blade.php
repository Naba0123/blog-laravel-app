@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.setting.general.save') }}" method="post">
        @csrf
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="labelFormBlogName">Blog Title</label>
                    @php $keyBlogTitle = App\Models\Common\CBlogSetting::KEY_BLOG_TITLE; @endphp
                    <input type="text" class="form-control" id="labelFormBlogName" placeholder="Blog Title"
                           name="{{ $keyBlogTitle }}" value="{{ setting($keyBlogTitle) ?: old($keyBlogTitle, '') }}" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
