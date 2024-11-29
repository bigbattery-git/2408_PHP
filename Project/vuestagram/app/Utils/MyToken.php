<?php

namespace App\Utils;

use App\Exceptions\MyAuthException;
use MyEncrypt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;

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
	 * 리프래시 토큰 업데이트
	 * 
	 * @param App\models\User $userInfo 유저정보
	 * @param string $refreshToken
	 * 
	 * @return bool true 
	 */
	public function updateRefreshToken(User $userInfo, string|null $refreshToken){
		// 유저 모델의 리프래시 토큰 변경
		$userInfo->refresh_token = $refreshToken;

		if(!($userInfo->save())){
			throw new PDOException('Error updateRefreshToken()'); // db 관련에러
		}

		return true;
	}

	/**
	 * 토큰 유효성 체크
	 * 
	 * @param string|null $bearerToken
	 * 
	 * @return boolean true
	 */
	public function chkToken(string|null $bearerToken){
		Log::debug('=== chkToken 시작 ===');

		// 토큰 존재 유무 체크
		if(empty($bearerToken)){
			Log::error('토큰 없음');
			throw new MyAuthException('E20');
		}

		// 토큰 위조 검사
		list($header, $payload, $signature) = $this->explodeToken($bearerToken);

		if(MyEncrypt::subSalt($this->createSigniture($header, $payload), env('TOKEN_SALT_LENGTH')) !== MyEncrypt::subSalt($signature, env('TOKEN_SALT_LENGTH'))){
			throw new MyAuthException('E22');
		}

		if($this->getValueInPayload($bearerToken, 'exp') < time()){
			throw new MyAuthException('E21');
		}

		Log::debug('=== chkToken 종료 ===');
		return true;
	}

	/**
	 * Payload에서 key에 해당하는 값 받아오기
	 * 
	 * @param string $token
	 * @param string $key
	 * 
	 * @return 
	 */

	public function getValueInPayload($token, $key){
		// 토큰 분리		
		list($header, $payload, $signature) = $this->explodeToken($token);
		$decodePayload = json_decode(MyEncrypt::base64UrlDecode($payload));

		// 페이로드에 해당 키가 있는지 확인
		if(empty($decodePayload) || !isset($decodePayload->$key)){
			throw new MyAuthException('E24');
		}

		return $decodePayload->$key;
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
		$payload=$this->createPayload($user, $ttl, $accessFlg);
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

	/**
	 * 토큰 분리 메소드
	 * 
	 * @param string $token
	 * @return array $header, $payload, $signature
	 */
	private function explodeToken($token){
		$arrToken = explode('.',$token);

		// 토큰 길이 검사
		// 토큰은 3개로 이루어져있는데, 그 이상, 그 이하가 나오면 문제있는 것
		if(count($arrToken) !== 3){
			throw new MyAuthException('E23');
		}

		return $arrToken;
	}
}