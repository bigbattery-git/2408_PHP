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
}