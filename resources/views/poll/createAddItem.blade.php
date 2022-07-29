@extends('_layout')

@section('body')
    <p>Poll telah dibuat! Silahkan menuju link <a href="{{ route('poll.stages', ['id' => $id]) }}">ini</a> untuk melihat poll anda</p>
    <p>
        <a href="{{ route('index') }}">Kembali ke halaman utama</a>
    </p>
@endsection