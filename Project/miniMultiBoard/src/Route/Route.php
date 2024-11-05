<?php

namespace Route;

use Controllers\BoardController;
use Controllers\UserController;

// Route : 유저의 요청을 분석하여 해당 Controller로 연결해주는 클래스 

class Route{

	public function __construct() {
		$url = $_GET['url']; // 요청경로
		$httpMethod = strtoupper($_SERVER['REQUEST_METHOD']); // 요청 메소드 획득

		if($url === 'login') {
			// 회원 로그인 관련
			if($httpMethod === 'GET') {				
				new UserController('goLogin');
			} else if($httpMethod === 'POST') {
				new UserController('login');
			} 
		}
		// 현진스 
		else if($url === 'boards'){
			if($httpMethod === 'GET'){
				new BoardController('index');
			}
		}
	}
}