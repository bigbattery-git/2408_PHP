<?php

namespace APP\UTILS;

use APP\UTILS\MyEncrypt;
use App\Models\User;
use Illuminate\Support\Facades\App;

class MyToken{
	/**
	 * 엑세스 토큰, 리프래시 토큰 생성
	 * 
	 * @param App\Models\User
	 * @return Array [$accessToken, $refreshToken]
	 */
	public function createTokens(User $user){
		$accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS'));
		$refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'), false);

		return [$accessToken, $refreshToken];
	}

	/**
	 * JWT 생성
	 * 
	 * @param App\Models\User $user; 
	 * @param int $ttl (time to limit)
	 * @param bool $accessFlg = true
	 * 
	 * @return string JWT
	 */
	private function createToken(User $user, int $ttl, bool $accessFlg = true){
		$header=$this->createHeader();
		$payload=$this->createPayload();
		$signiture=$this->createSigniture();

		return $header.'.'.$payload.'.'.$signiture;
	}

	/**
	 * JWT Header 생성
	 * 
	 * return string base64UrlEncode
	 */
	private function createHeader(){
		$header = [
			// 일반적으로 HEADER의 key는 3글자 약어를 사용함
			'alg' => env('TOKEN_ALG')
			,'typ' => env('TOKEN_TYPE')
		];

		return MyEncrypt::base64UrlEncode(json_encode($header));
	}
}