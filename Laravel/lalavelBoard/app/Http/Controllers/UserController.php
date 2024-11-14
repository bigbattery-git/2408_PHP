<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	public function goLogin(){
		return view('login');
	}

	public function login(Request $data){
		// 유효성 검사에 걸린 문제가 있으면 배열로 담아서 반환함
		$validator = Validator::make(
			// login 액션 메소드 실행 시 $data의 값이 연관배열로 들어감 ['u_email' => $data->u_email, 'u_password' => $data->u_password]
			$data->only('u_email', 'u_password') 
			,[
				'u_email' => ['required', 'email', 'exists:users,u_email'] 	// 'unique:테이블명,컬럼명 -> 컬럼명에서 이미 존재하는 데이터라면, 유효성 검사에서 걸러냄 -> 중복검사할 때 걸러냄
																			// 'exists:테이블명,컬럼명 -> 컬럼명에서 존재하지 않는 데이터라면, 유효성 검사에서 걸러냄 -> 회원정보 확인 여부 때 걸러냄
				,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-z0-9!@]+$/']
			]
		);

		//Validator->fails() 유효성 검사 실패 시 true, 성공 시 false 반환
		if($validator->fails()){
			return redirect()
				->route('goLogin')
				->withInput()
				->withErrors($validator->errors()); // Validator->errors() : 에러메시지를 담고 있는 배열 반환
		}

		// 유저 정보 획득
		$userInfo = User::where('u_email', '=', $data->u_email)
						->first();
		
		// 유저 비밀번호 체크
		if(!(Hash::check($data->u_password, $userInfo->u_password))){
			return redirect()->route('goLogin')->withErrors('님 비번 틀림 ㅅㄱ')->withInput();
		}

		// 유저 인증 처리하기
		Auth::login($userInfo);	// 로그인 처리

		// var_dump(Auth::id()); // 로그인한 유저의 pk 획득
		// echo '==============================';
		// var_dump(Auth::user()); // 로그인한 유저의 정보 획득
		// echo '==============================';
		// var_dump(Auth::check()); // 로그인을 했는지 안했는지 여부 획득

		return redirect()->route('boards.index');
	}

	public function logout(){

		// 라라벨 쓸 시 로그아웃에서 거의 고정임
		
		Auth::logout(); // 로그아웃 처리 -> 이걸로 로그아웃이 되는데, 보안상 세션을 좀 초기화 해주자
		
		Session::invalidate(); // 세션 생성시, 발급되는 id를 초기화, 새로운 세션 ID를 발급하는 하는 메소드

		// 기존 발급한 CSRF 토큰 재발급
		Session::regenerateToken(); // 보안상의 공격을 막기위해 기존 것을 제거하고 새로운 토큰을 발급 

		return redirect()->route('goLogin');
	}
}