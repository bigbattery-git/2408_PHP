<?php

// 컨트롤러별 공통된 부분을 정의하는 곳. 자식들이 상속받아 쓸거임

namespace Controllers;

class Controller {
	public function __construct(string $action) {
		// 세션 시작

		// 유저 로그인, 권한체크 
		
		// 해당 Action 호출
		$resultAction = $this->$action();

		// view 호출
		$this->callView($resultAction);
		exit;
	}

	/**
	 * View or Loaction 처리용 메소드
	 */
	private function callView($path){
		if(strpos($path, 'Location:') === 0){
			header($path);
		} else {
			require_once(_PATH_VIEW.'/'.$path);
		}
	}
}