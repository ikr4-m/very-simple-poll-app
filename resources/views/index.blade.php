@extends('_layout')

@section('body')
    @if (Session::has('redirect_message'))
        <p>{{ Session::get('redirect_message') }}</p>
    @endif
    <h1>Selamat datang di aplikasi poll</h1>
@endsection