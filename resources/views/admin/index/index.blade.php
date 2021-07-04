@extends('admin._share.layout')

@section('content')
<form action="{{ route('admin.auth.logout') }}" method="post">
    @csrf
    <input type="submit" value="ログアウト">
</form>
@endsection
