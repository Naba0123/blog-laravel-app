@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.setting.design.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="lb-form-header-image">Header Image (the Header Image place in css&nbsp;<code>width: 100%</code>)</label>
                    @if ($headerImageUrl = header_image_url())
                        <p><img src="{{ $headerImageUrl }}" width="30%"/></p>
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="header_image" type="file" class="custom-file-input" id="lb-form-header-image">
                            <label class="custom-file-label" for="lb-form-header-image">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
