<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LKS Poll</title>
</head>
<body>
    <a href="{{ route('index') }}">Index</a>&nbsp;|&nbsp;
    @if (Session::has('login'))
        <a href="{{ route('poll.create', ['option' => 2]) }}">Buat Poll</a>&nbsp;|&nbsp;
        <a href="{{ route('poll.list') }}">Poll Anda</a>&nbsp;|&nbsp;
        <a href="{{ route('auth.delete_account') }}">Hapus Akun</a>&nbsp;|&nbsp;
        <a href="{{ route('auth.logout') }}">Logout</a>
    @else
        <a href="{{ route('auth.login') }}">Login</a>&nbsp;|&nbsp;
        <a href="{{ route('auth.register') }}">Register</a>
    @endif
    <hr>
    @yield('body')
</body>
</html>