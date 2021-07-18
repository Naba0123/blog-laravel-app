@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.setting.general.save') }}" method="post">
        @csrf
        <div class="card card-primary">
            <div class="card-body">
                @foreach (\App\Models\Common\CBlogSetting::ENABLE_SETTING_KEYS as $key)
                    @if ($formType = config('admin.setting.general.form_type.' . $key))
                        @switch($formType)
                            @case('textarea')
                                <div class="form-group">
                                    <label for="labelFormBlogDescription">{{ $key }}</label>
                                    <textarea class="form-control" rows="3" name="{{ $key }}" id="labelForm{{ $key }}">{!! old($key, setting($key)) !!}</textarea>
                                </div>
                                @break
                            @default

                                @break
                        @endswitch
                    @else
                        <div class="form-group">
                            <label for="labelForm{{ $key }}">{{ $key }}</label>
                            <input type="text" class="form-control {{ invalid_validation($key) }}" id="labelForm{{ $key }}" placeholder="{{ $key }}"
                                   name="{{ $key }}" value="{{ old($key, setting($key)) }}" required>
                            @include('admin._parts.validation_error', ['key' => $key])
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
