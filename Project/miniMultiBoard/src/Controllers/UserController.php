<?php


namespace Controllers;

use Controllers\Controller; // index에 autoload 덕분에 require_once 안적어도 됨
use Lib\UserValidator;
use Models\User;

class UserController extends Controller {

	protected $userInfo = [
		'u_email' 		=> ''
		,'u_name' 		=> ''
	];

	/**
	 * 로그인 창으로 이동
	 */
	protected function goLogin() {
		return 'login.php';
	}
	
	/**
	 * 로그인 처리 및 게시글 보드로 이동
	 */
	protected function login(){
		// 유저 입력 정보 획득
		$requestData = [
			'u_email' 		=> $this->이즈셋($_POST['u_email'])
			,'u_password' => $this->이즈셋($_POST['u_password'])
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

	/**
	 * 로그아웃 후 로그인창으로 이동
	 */
	public function logout(){
		unset($_SESSION['u_email']);
		session_destroy();

		return 'Location: /login';
	}

	/**
	 * 회원가입 창으로 이동
	 */
	protected function goRegist() {
		return 'regist.php';
	}

	/**
	 * 이즈셋 깔끔하게하는 함수
	 */
	private function 이즈셋(string $value){
		if(isset($value)) {
			return $value;
		} 
		else {
			return '';
		}
	}

	/**
	 * 회원가입 및 로그인창 이동
	 */
	protected function regist(){
		$requestData = [
			'u_email' 				=> $this->이즈셋($_POST['u_email'])
			,'u_password' 		=> $this->이즈셋($_POST['u_password'])
			,'u_password_chk' => $this->이즈셋($_POST['u_password_chk'])
			,'u_name' 				=> $this->이즈셋($_POST['u_name'])
		];

		$this->userInfo = [
			'u_name' => $requestData['u_name']
			,'u_email'=> $requestData['u_email']
		];

		// 유효성 쳌
		$resultValidator = UserValidator::chkValidator($requestData);
		if(count($resultValidator) > 0){
			$this->arrErrorMsg = $resultValidator;
			return 'regist.php';
		}

		// 이메일 중복 췍
		$userModel = new User();
		$prepare =[
			'u_email' => $requestData['u_email']
		];
		$resultUserInfo = $userModel->getUserInfo($prepare);
		if($resultUserInfo){
			$this->arrErrorMsg[] = '이미 존재하는 이메일입니다.';
			return 'regist.php';
		}

		// 회원가입 위한 데이터 삽입 과정
		$userModel->beginTransaction();
		$prepare =[
			'u_email'			=>	$requestData['u_email']
			,'u_password'	=>	password_hash($requestData['u_password'], PASSWORD_DEFAULT)
			,'u_name'			=>	$requestData['u_name']
		];

		$resultRegistUserInfo = $userModel->registUserInfo($prepare);

		if($resultRegistUserInfo !== 1) {
			$userModel->rollBack();
			$this->arrErrorMsg[] = '회원가입에 실패했습니다.';
			return 'regist.php';
		}

		$userModel->commit();

		return 'login.php';
	}
}