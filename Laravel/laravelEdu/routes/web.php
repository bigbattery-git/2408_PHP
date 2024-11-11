<?php

use App\Http\Controllers\QueryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestContoller;
use Illuminate\Http\Request;
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
    return view('welcome');
});

Route::get('/hi', function(){ return 'hello world'; });

Route::get('/lunch', function(){
    return view('myView');
});

Route::get('/home', function(){
    return view('home');
});

Route::post('/home', function(){
    return 'Home Post';
});

Route::put('/home', function () {
    return 'put';
});

Route::delete('/home', function () {
    return 'delete';
});

Route::patch('/home', function () {
    return 'PATCH';
});

Route::get('/param', function(Request $request){
    return 'ID : '.$request->key;
});

// // 세그먼트 파라미터
// Route::get('/param/{id}/{name}', function($id, $name){
//     return $id.'  '.$name;
// });

// 세그먼트 파라미터2
Route::get('/param/{id}/{name}', function(Request $request){
    return $request->id.'  '.$request->name;
});

// 세그먼트 파라미터 default 값 설정하기
Route::get('/param3/{id?}', function($id = 0){
    return $id;
});

// 라우트명 지정
Route::get('/name', function(){
    return view('name');
});

Route::get('/home/na/hon/php', function(){
    return '좀 긴 url'; 
})->name('long');

// Route::get('/ayo',function(){
//     return view('ayo');
// });

Route::get('/send', function(){
    return view('send')
    ->with('gender', '무성');
});

// 대체 라우트

Route::fallback(function(){
    return '님 잘못 들어옴 인생망함 ㅅㄱ';
});

// 라우트 그룹
Route::get('/users',function(){
    return 'GET : /users';
});
Route::post('/users',function(){
    return 'POST : /users';
});
Route::put('/users',function(){
	return 'PUT : /users';
});
Route::delete('/users',function(){
    return 'DELETE : /users';
});
// 예네들을 그룹으로 만들꺼임

Route::prefix('/users')->group(function(){
	Route::get('/', function(){
		return 'GET : /users';
	});
	Route::post('/',function(){
		return 'POST : /users';
	});
	Route::put('/',function(){
		return 'PUT : /users';
	});
	Route::delete('/',function(){
		return 'DELETE : /users';
	});
});

// 왜씀?
// 미들웨어때문 : 라우트의 앞, 뒤에 붙여눌 수 있는 객체 
// 예) 사전에 로그인이 되었는지 확인해야 할 경우, 라우트 그룹을 쓰면 한 번만 써도 됨
// 안 쓰면 네 번 써야함

// =========================
// 컨트롤러 연결 

Route::get('/test', [TestContoller::class, 'index']);

// Route::get('/task', [TaskController::class, 'index']);
// Route::get('/task/create', [TaskController::class, 'create']);
// Route::post('/task',[TaskController::class, 'store']);
// Route::get('/task/edit/{id}',[TaskController::class,'edit']);
// Route::get('/task/{id}',[TaskController::class,'show']);
// Route::put('/task/{id}',[TaskController::class,'update']);
// Route::delete('/task/{id}',[TaskController::class,'destroy']);

// --resource로 생성한 컨트롤러를 라우터로 연결하기

Route::resource('/task', TaskController::class)->except(['show']);

// 블레이드 탬플릿 테스트
Route::get('/edu', function(){
    return view('edu')->with('data', ['name' => '홍길동', 'id' => 54, 'content'=>'<script>alert("tt");</script>']);
});

Route::get('/board', function(){
    return view('board');
});

Route::get('/extends', function(){
    $result = [
        ['id' => 1, 'name' => '홍길동', 'gender' => 'M']
        ,['id' => 2, 'name' => '갑순이', 'gender' => 'F']
        ,['id' => 3, 'name' => '갑돌이', 'gender' => 'M']
    ];

    return view('extends')->with('data', $result)->with('data2', []);
});

Route::get('/query', [QueryController::class, 'index']);