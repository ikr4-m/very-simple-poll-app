@extends('_layout')

@section('body')
    @if (Session::has('redirect_message'))
        <p>{{ Session::get('redirect_message') }}</p>
    @endif
    <h1>Register</h1>
    <form action="{{ route('auth.register.process') }}" method="post">
        @csrf
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><input type="submit" value="Register"></td>
            </tr>
        </table>
    </form>
@endsection