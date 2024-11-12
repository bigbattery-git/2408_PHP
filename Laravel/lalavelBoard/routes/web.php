<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // 이제 이 링크로 접속해도 /login으로 접속함
    // return redirect()->route(라우트명);
    return redirect()->route('goLogin');
});

Route::get('/login', [UserController::class, 'goLogin'])->name('goLogin');