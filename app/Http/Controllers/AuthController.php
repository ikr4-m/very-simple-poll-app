<?php

namespace App\Http\Controllers;

use App\Models\PollDescription;
use App\Models\User;
use App\SessionManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginValidation(Request $request)
    {
        $username = $request->username;
        $data = User::where('username', $username)->firstOrFail();
        
        if (Hash::check($request->password, $data->password)) {
            SessionManager::create($data);
            return redirect()->route('index')->with('redirect_message', 'Login berhasil!');
        } else {
            return redirect()->route('index')->with('redirect_message', 'Login gagal!');
        }
    }

    public function logout()
    {
        SessionManager::destroy();
        return redirect()->route('index')->with('redirect_message', 'Berhasil logout!');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerValidation(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'USER'
        ];

        foreach ($data as $key => $value) {
            if (empty($value))
                return redirect()->route('auth.register')->with('redirect_message', 'Ada isian yang kosong!');
        }

        $data = User::create($data);
        SessionManager::create($data);
        return redirect()->route('index')->with('redirect_message', 'Berhasil register! Anda telah login dengan otomatis.');
    }

    public function deleteAccount(Request $request)
    {
        // Ambil poll yang sudah dibuat semua
        $data = PollDescription::where('user_id', SessionManager::getSession()->aud)->get();

        if ($data->count() > 0) {
            foreach ($data as $v) {
                PollDescription::deleteData($v->id);
            }
        }

        User::where('id', SessionManager::getSession()->aud)->delete();
        SessionManager::destroy();
        return redirect()->route('index')->with('redirect_message', 'Akun anda berhasil dihapus!');
    }
}
