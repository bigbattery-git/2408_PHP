<?php

// 컨트롤러별 공통된 부분을 정의하는 곳. 자식들이 상속받아 쓸거임

namespace Controllers;

use Lib\Auth;
use Models\BoardsCategory;

class Controller {
	protected $arrErrorMsg = []; // 화면에 표시할 에러 메세지 리스트
	protected $arrBoardNameInfo = []; // 헤더 게시판드롭다운 리스트

	public function __construct(string $action) {
		// 세션 시작
		if(session_status() === PHP_SESSION_NONE){ // 세션이 시작중이 아니라면 세션 시작
			session_start();
		}
		
		// 유저 로그인, 권한체크 
		Auth::checkAuthorization();
		
		// 헤더 드롭다운 리스트 획득
		$boardsNameModel = new BoardsCategory();
		$this->arrBoardNameInfo = $boardsNameModel->getBoardNameList();
		
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