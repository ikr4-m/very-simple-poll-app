<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PollManagerController;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['as' => 'auth'], function () {
    Route::group(['as' => '.login', 'prefix' => 'login'], function () {
        Route::get('/', [AuthController::class, 'login']);
        Route::post('validation', [AuthController::class, 'loginValidation'])->name('.process');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('.logout');
    Route::group(['as' => '.register', 'prefix' => 'register'], function () {
        Route::get('/', [AuthController::class, 'register']);
        Route::post('validation', [AuthController::class, 'registerValidation'])->name('.process');
    });
    Route::middleware(CheckLogin::class)
        ->get('delete_account', [AuthController::class, 'deleteAccount'])->name('.delete_account');
});

Route::group(['as' => 'poll', 'prefix' => 'poll', 'middleware' => 'App\Http\Middleware\CheckLogin'], function () {
    Route::group(['as' => '.create', 'prefix' => 'create'], function () {
        Route::get('/', [PollManagerController::class, 'createIndex']);
        Route::post('add', [PollManagerController::class, 'createAddItem'])->name('.add');
    });
    Route::group(['as' => '.stages', 'prefix' => 'stages'], function () {
        Route::get('/', [PollManagerController::class, 'stagesIndex']);
        Route::post('add', [PollManagerController::class, 'stagesAddAnswer'])->name('.add');
    });
    Route::group(['as' => '.list', 'prefix' => 'list'], function () {
        Route::get('/', [PollManagerController::class, 'listIndex']);
        Route::get('delete', [PollManagerController::class, 'listDeletePoll'])->name('.delete');
    });
});
