<?php

namespace APP\UTILS;

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
}