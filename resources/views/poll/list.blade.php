@extends('_layout')

@section('body')
    @if (Session::has('redirect_message'))
        <p>{{ Session::get('redirect_message') }}</p>
    @endif
    <h1>Daftar Poll Anda</h1>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Nama</td>
            <td>Link</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->poll_name }}</td>
                <td><a href="{{ route('poll.stages', ['id' => $v->id]) }}">Klik di sini</a></td>
                <td><a href="{{ route('poll.list.delete', ['id' => $v->id]) }}">Hapus</a></td>
            </tr>
        @endforeach
    </table>
@endsection