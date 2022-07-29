<?php

namespace App\Http\Controllers;

use App\SessionManager;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
