<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [AuthController::class, 'login'])->name('post.login');

// 라우트 그룹

Route::middleware('my.auth')->group(function(){
	// 로그아웃
	Route::post('/logout', [AuthController::class, 'logout'])->name('post.logout');

	// 게시글 =========================================
	// 게시글 데이터 가져오기
	Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');

	// 게시글 상세 데이터 가져오기
	Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show');

	// 게시글 작성하기
	Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
});