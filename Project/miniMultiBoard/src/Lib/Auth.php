<?php

namespace Lib;

class Auth{

	/**
	 * 로그인 필요한 웹 사이트에서 로그인 했는지 여부을 확인.
	 * 또는 로그인했는데 로그인 or 회원가입 페이지에 있는지 여부를 확인하는 함수
	 */
	public static function checkAuthorization() {
		$arrNeedAuth = [
			'boards'
			,'boards/detail'
			,'logout'
			,'boards/insert'
		]; // 로그인 했을 때만 접속 가능한 url
		
		$url = $_GET['url'];

		// 로그인 안했는데 로그인 필요한 사이트 들어가려고 하면 'login'으로 보내버림
		if(!isset($_SESSION['u_email']) && in_array($url, $arrNeedAuth)){
			header('Location: /login');
			exit;
		}

		// 로그인 했는데 로그인 페이지에 있으면 보드로 보내버림
		if(isset($_SESSION['u_email']) && ($url === 'login' || $url === 'regist')){
			header('Location: /boards');
			exit;
		}
	}
}