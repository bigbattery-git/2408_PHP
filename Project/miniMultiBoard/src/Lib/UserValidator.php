<?php

namespace Lib;

class UserValidator{
	/**
	 * 로그인, 회원가입 유효성 검사
	 * 
	 * @param $data : 'u_email', 'u_password_chk', ' ,('u_name')
	 */
	public static function chkValidator(array $data){
		$arrErrMsg = [];

		$patternEmail = "/^[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}@[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}\.[a-zA-Z]{2,3}$/u";
		$patternPassword = "/^[a-zA-Z0-9!@]{8,20}$/u";
		$patternName = "/^[가-힣]{1,50}$/u";

		// 이메일 체크
		if(array_key_exists('u_email', $data)){
			if(preg_match($patternEmail, $data['u_email'], $matches) === 0){
				$arrErrMsg[] = '이메일 형식이 맞지 않습니다';
			}
		}

		// 패스워드 체크
		if(array_key_exists('u_password', $data)){
			if(preg_match($patternPassword, $data['u_password'], $matches) === 0){
				$arrErrMsg[] = '비밀번호는 영어 대소문자 및 숫자, 특수문자(!,@) 8~20자로 작성해주세요';
			}
		}

		// 패스워드 확인 체크
		if(array_key_exists('u_password_chk', $data)){
			if($data['u_password'] !== $data['u_password_chk']){
				$arrErrMsg[] = '비밀번호와 비밀번호 확인이 다릅니다.';
			}
		}

		// 이름 체크
		if(array_key_exists('u_name', $data)){
			if(preg_match($patternName, $data['u_name'], $matches) === 0){
				$arrErrMsg[] = '이름은 한글만 입력해주세요.';
			}
		}
		
		return $arrErrMsg;
	}
}