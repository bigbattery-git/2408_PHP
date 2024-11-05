<?php


namespace Controllers;

use Controllers\Controller; // index에 autoload 덕분에 require_once 안적어도 됨
use Lib\UserValidator;
use Models\User;

class UserController extends Controller {
	protected function goLogin() {
		return 'login.php';
	}
	
	protected function login(){
		// 유저 입력 정보 획득
		$requestData = [
			'u_email' 		=> $_POST['u_email']
			,'u_password' => $_POST['u_password']
		];

		// 유효성 검사
		$resultValidator = UserValidator::chkValidator($requestData);
		if(count($resultValidator) > 0){
			$this->arrErrorMsg = $resultValidator;
			return 'login.php';
		}

		// 유저 정보 획득
		$usersModel = new User();
		$prepare = [
			'u_email' => $requestData['u_email']
		];
		$resultUserInfo = $usersModel->getUserInfo($prepare);

		// 유저 비밀번호 암호화
		$encryptPassword = password_hash($requestData['u_password'], PASSWORD_DEFAULT);
		password_verify($requestData['u_password'], $encryptPassword);
		
		// 유저 존재 유무 체크
		if(!$resultUserInfo){
			$this->arrErrorMsg[] = '존재하지 않는 유저입니다.';
			return 'login.php';
		}

		// password 체크
		else if(!password_verify($requestData['u_password'], $resultUserInfo['u_password'])){
			$this->arrErrorMsg[] = '비밀번호가 일치하지 않습니다.';
			return 'login.php';
		}

		// 세션에 유저 id 저장 
		$_SESSION['u_email'] = $requestData['u_email'];

		// location 처리
		return 'Location: /boards';
	}
}