<?php

namespace App\Utils;

use Illuminate\Support\Str;
class MyEncrypt{
	/**
	 * base64 URL 인코드
	 * 
	 * @param string $json
	 * @return string base64 URL encode 
	 */
	public function base64UrlEncode(string $json){
		// base64_encode로 인코딩하면서 나오는 '+, /'을 수정하기 위해 strtr(encode string, '+/', '-_'); 를 사용
		// rtrim으로 끝에 나오는 '='를 없애주자
		// strtr(이문자열에서, 이기호를, 이기호로바꾸자);
		return rtrim(strtr(base64_encode($json),'+/','-_'), '=');
	}

	/**
	 * base64 Url decode
	 * @param string $base64 Url encode
	 * @return string $base64
	 */
	public function base64UrlDecode(string $base64){
		return base64_decode(strtr($base64, '-_', '+/'));
	}

	/**
	 * 솔트(특정 길이만큼 랜덤한 문자열) 생성 
	 * 
	 * @param int $saltLength
	 * 
	 * @return string rnd string
	 */
	public function makeSalt(int $saltLength){
		return Str::random($saltLength);
	}

	/**
	 * 문자열 암호화 
	 * 
	 * @param string $alg 알고리즘명
	 * @param string $str 암호화 할 문자열
	 * @param string $salt 솔트
	 * 
	 * @return string 암호화된 문자열
	 */

	public function hashWithSalt(string $alg, string $str, string $salt){
		return hash($alg, $str).$salt;
	}

	/**
	 * 특정 길이의 솔트를 제거한 문자열을 반환
	 * 
	 * @param string $signature 솔트 포함된 시그니쳐
	 * @param int $saltLength 솔트 길이
	 * @return string 솔트 제거한 문자열 반환
	 */
	public function subSalt(string $signature, int $saltLength){
		return mb_substr($signature, 0, (-1 * $saltLength));
	}
}