<?php

namespace App;

use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SessionManager
{
    public static function create(mixed $data)
    {
        $key = env('APP_KEY');
        $payload = [
            'iss' => 'lksppoll',
            'sub' => 'login_token',
            'aud' => $data->id,
            'role' => $data->role
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        Session::push('login', $jwt);
    }

    public static function getSession()
    {
        try {
            $key = env('APP_KEY');
            return JWT::decode(session('login')[0], new Key($key, 'HS256'));
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function check()
    {
        $data = self::getSession();
        return $data != null;
    }

    public static function destroy()
    {
        Session::flush();
    }
}