@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.setting.general.save') }}" method="post">
        @csrf
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    @php $key = App\Models\Common\CBlogSetting::KEY_BLOG_TITLE; @endphp
                    <label for="labelForm{{ $key }}">Blog Title</label>
                    <input type="text" class="form-control {{ invalid_validation($key) }}" id="labelForm{{ $key }}" placeholder="{{ $key }}"
                           name="{{ $key }}" value="{{ old($key, setting($key)) }}" required>
                    @include('admin._parts.validation_error', ['key' => $key])
                </div>
                <div class="form-group">
                    @php $key = App\Models\Common\CBlogSetting::KEY_BLOG_DESCRIPTION; @endphp
                    <label for="labelForm{{ $key }}">Blog Description</label>
                    <input type="text" class="form-control" id="labelForm{{ $key }}" placeholder="{{ $key }}"
                           name="{{ $key }}" value="{{ old($key, setting($key)) }}" required>
                </div>

                <hr/>

                <div class="form-group">
                    @php $key = App\Models\Common\CBlogSetting::KEY_AUTHOR_NAME; @endphp
                    <label for="labelForm{{ $key }}">Author Name</label>
                    <input type="text" class="form-control" id="labelForm{{ $key }}" placeholder="{{ $key }}"
                           name="{{ $key }}" value="{{ old($key, setting($key)) }}" required>
                </div>
                <div class="form-group">
                    <label for="labelFormBlogDescription">Author Name</label>
                    @php $key = App\Models\Common\CBlogSetting::KEY_AUTHOR_DESCRIPTION; @endphp
                    <textarea class="form-control" rows="3" name="{{ $key }}" id="labelForm{{ $key }}">{!! old($key, setting($key)) !!}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
