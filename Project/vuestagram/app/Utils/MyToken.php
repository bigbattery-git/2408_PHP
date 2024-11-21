<?php

namespace App\Utils;

use MyEncrypt;
use App\Models\User;

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
		$payload=$this->createPayload($user, $ttl);
		$signiture=$this->createSigniture($header, $payload);

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

	/**
	 * JWT Payload 생성
	 * @param App\Models\User $user; 
	 * @param int $ttl (time to limit)
	 * @param bool $accessFlg = true
	 * @return string base64Payload 
	 */
	private function createPayload(User $user, int $ttl, $accessFlg = true){
		$now = time(); // 현재시간

		$payload = [
			'idt' => $user->user_id
			,'iat' => $now
			,'exp' => $now + $ttl
			,'ttl' => $ttl
		];

		if($accessFlg){
			$payload['acc'] = $user->account;
		}

		return MyEncrypt::base64UrlEncode(json_encode($payload));
	}

	/**
	 * JWT signiture 생성
	 * 
	 * 현업은 기업마다 만드는방법이 다 다름
	 * 주로 Header, payload에 secret키, salt를 섞어서 만듬
	 * 
	 * 여기서는 $header + $secretkey + $payload
	 * @param string $header
	 * @param string $payload
	 * 
	 * @return string base64Signature
	 */
	private function createSigniture(string $header, string $payload){
		return MyEncrypt::hashWithSalt(env('TOKEN_ALG'), $header.env('TOKEN_SECRET_KEY').$payload, MyEncrypt::makeSalt(env('TOKEN_SALT_Length')));
	}
}