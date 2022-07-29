@extends('_layout')

@section('result')
    <h4>Hasil Akhir</h4>
    @if (count($percentage) > 0)
        <ul>
            @foreach ($percentage as $v)
                <li>{{ $v['name'] }} - {{ $v['percentage'] }}%</li>
            @endforeach
        </ul>
    @else
        <p>Belum ada suara</p>
    @endif
@endsection

@section('body')
    @if (Session::has('redirect_message'))
        <p>{{ Session::get('redirect_message') }}</p>
    @endif

    <h1>Poll</h1>
    <h3>{{ $data->poll_name }}</h3>
    @if (!$is_voted)
        <form action="{{ route('poll.stages.add') }}" method="post">
            @csrf
            <input type="hidden" name="poll_id" value="{{ $poll_id }}">
            <table>
                <tr>
                    <td>Pilihanmu</td>
                    <td>:</td>
                    <td>
                        <select name="poll_choice">
                            @foreach ($data->PollChoices as $v)
                                <option value="{{ $v->id }}">{{ $v->poll_choice_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><input type="submit" value="Pilih!"></td>
                </tr>
            </table>
        </form>
    @else
        <p>Vote telah ditutup karena anda telah melakukan voting.</p>
        @if (\App\SessionManager::getSession()->aud != $data->user_id)
            @yield('result')
        @endif
    @endif

    @if (\App\SessionManager::getSession()->aud == $data->user_id)
        @yield('result')
    @endif
@endsection