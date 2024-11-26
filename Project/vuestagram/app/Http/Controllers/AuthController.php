<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MyToken;

class AuthController extends Controller
{
	public Function login(UserRequest $request){
		// TODO : 비밀번호 체크 다음주

		// 계정 체크
		$userInfo = User::where('account', $request->account)
								->withCount('boards') // 해당 모델에서 지어줬던 관계 메서드 명
								->first();								

		//비밀번호 체크
		if(!(Hash::check($request->password, $userInfo->password))){
			// AuthenticationException(); 로그인 중 잘못된 부분이 있을 때 에러메시지를 출력하는 클래스
			throw new AuthenticationException('비번 오류');
		}

		// 토큰 발급
		list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);
		
		// 리프래시 토큰 저장
		MyToken::updateRefreshToken($userInfo, $refreshToken);

		$response =[
			'success' => true
			,'msg' => '로그인 성공'
			,'accessToken' => $accessToken
			,'refreshToken' => $refreshToken
			,'userInfo' => $userInfo->toArray()
		];

		return response()->json($response);
	}

	/**
	 * 로그아웃
	 * 
	 * @param Illuminate\Http\Request;
	 * 
	 * @return response Json
	 */
	public function logout(Request $request){

		// payload에서 유저 id 가져오기
		$id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

		$user = User::find($id);

		// 리프래시 토큰 갱신
		DB::beginTransaction();
		Mytoken::updateRefreshToken($user, null);
		DB::commit();

		$response =[
			'success' => true
			,'msg' => '로그아웃 성공'
		];

		return response()->json($response, 200);
	}
}