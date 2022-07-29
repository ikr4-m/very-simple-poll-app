@extends('_layout')

@section('body')
    <h1>Buat Poll Baru</h1>
    <form action="{{ route('poll.create.add') }}" method="post">
        @csrf
        <input type="hidden" name="option" value="{{ $option }}">
        <table>
            <tr>
                <td>Deskripsi Poll</td>
                <td>:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Pilihan</td>
                <td>:</td>
                <td>
                    <ul>
                        @for ($i = 0; $i < $option; $i++)
                            <li><input type="text" name="poll_choice_name_{{ $i }}"></li>    
                        @endfor
                    </ul>
                    <a href="{{ route('poll.create', ['option' => $option - 1]) }}">Kurang</a>&nbsp;|&nbsp;
                    <a href="{{ route('poll.create', ['option' => $option + 1]) }}">Tambah</a>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><input type="submit" value="Buat!"></td>
            </tr>
        </table>
    </form>
@endsection