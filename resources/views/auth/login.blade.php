@extends('_layout')

@section('body')
    <h1>Login</h1>
    <form action="{{ route('auth.login.process') }}" method="post">
        @csrf
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>
@endsection