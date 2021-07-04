@extends('admin._share.layout')

@section('content')
    <form action="{{ route('admin.auth.login') }}" method="post">
        <label>
            <input type="email" name="email" />
        </label>
        <label>
            <input type="password" name="password"/>
        </label>
        @csrf
        <input type="submit" name="ログイン">
    </form>
@endsection
