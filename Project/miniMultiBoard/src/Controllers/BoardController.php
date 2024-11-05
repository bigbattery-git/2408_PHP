<?php

// 현진스
namespace Controllers;
use Controllers\Controller;
use Models\Board;
use Models\BoardsCategory;

class BoardController extends Controller{
	private $arrBoardList = [];
	private $boardName = '';

	// getter : arrBoardList
	public function getArrBoardList(){
		return $this->arrBoardList;
	}

	// setter : arrBoardList
	public function setArrBoardList(array $arrBoardList){
		$this->arrBoardList = $arrBoardList;
	}

	// getter : boardName
	public function getBoardName(){
		return $this->boardName;
	}

	// setter : boardName
	public function setBoardName($boardName){
		$this->boardName = $boardName;
	}

	public function index(){
		// 보드 정보 획득
		$requestData = [
			'bc_type' => isset($_GET['bc_type']) ? $_GET['bc_type'] : '0'
		];

		// 게시글 정보 획득
		$boardModel = new Board();
		$this->setArrBoardList($boardModel->getBoardList($requestData));

		// 보드 이름 획득
		$boardCategory = new BoardsCategory();
		$resultBoardCategory = $boardCategory->getBoardName($requestData);
		$this->setBoardName($resultBoardCategory['bc_name']);
		return 'board.php';
	}
}