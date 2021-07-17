@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.setting.general.save') }}" method="post">
        @csrf
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="labelFormBlogName">Blog Title</label>
                    @php $keyBlogTitle = App\Models\Common\CBlogSetting::KEY_BLOG_TITLE; @endphp
                    <input type="text" class="form-control {{ invalid_validation($keyBlogTitle) }}" id="labelFormBlogName" placeholder="Blog Title"
                           name="{{ $keyBlogTitle }}" value="{{ old($keyBlogTitle, setting($keyBlogTitle)) }}" required>
                    @include('admin._parts.validation_error', ['key' => $keyBlogTitle])
                </div>
                <div class="form-group">
                    <label for="labelFormBlogDescription">Blog Description</label>
                    @php $keyBlogDescription = App\Models\Common\CBlogSetting::KEY_BLOG_DESCRIPTION; @endphp
                    <input type="text" class="form-control" id="labelFormBlogDescription" placeholder="Blog Description"
                           name="{{ $keyBlogDescription }}" value="{{ old($keyBlogDescription, setting($keyBlogDescription)) }}" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
