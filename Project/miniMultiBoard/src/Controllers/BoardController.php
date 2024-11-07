<?php

// 현진스
namespace Controllers;
use Controllers\Controller;
use Models\Board;
use Models\BoardsCategory;

class BoardController extends Controller{
	private $arrBoardList = [];
	private $boardName = '';
	protected $boardType = '';

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

		$this->boardType = $requestData['bc_type'];

		// 게시글 정보 획득
		$boardModel = new Board();
		$this->setArrBoardList($boardModel->getBoardList($requestData));

		// 보드 이름 획득
		$boardCategory = new BoardsCategory();
		$resultBoardCategory = $boardCategory->getBoardName($requestData);
		$this->setBoardName($resultBoardCategory['bc_name']);
		return 'board.php';
	}

	/**
	 * 요청받은 상세페이지 데이터를 가져와 json으로 반환 
	 */
	public function show(){
		$requestData =[
			'b_id' => isset($_GET['b_id']) ? (int)$_GET['b_id'] : 0
		];

		$boardModel = new Board();
		$resultBoard = $boardModel->getBoardDetail($requestData);

		// Json 변환
		$responseData = json_encode($resultBoard);

		header('Content-type: application/json');
		echo $responseData;
		exit;
	}

	/**
	 * 작성 페이지로 이동하는 메소드
	 */
	public function create(){
		$this->boardType = $_GET['bc_type'];
		return 'insert.php';
	}

	/**
	 * 글작성 후 데이터를 보관하기 위한 함수
	 */
	public function store(){
		$requestData = [
			'b_title' 		=> $_POST['b_title']
			,'b_content' 	=> $_POST['b_content']
			,'b_img' 			=> ''
			,'bc_type'		=> $_POST['bc_type']
			,'u_id'				=> $_SESSION['u_id']
		];

		$requestData['b_img'] = $this->saveImage($_FILES['file']);

		$boardModel = new Board();

		$boardModel->beginTransaction();
		$resultBoardInsert = $boardModel->insertBoard($requestData);

		if($resultBoardInsert !== 1){
			$boardModel->rollBack();
			$this->arrErrorMsg[] = '게시글 작성 실패';
			$this->boardType = $requestData['bc_type'];
			return 'insert.php';
		}

		$boardModel->commit();

		return 'Location: /boards?bc_type='.$requestData['bc_type'];
	}

	private function saveImage($file){
		$type = explode('/', $file['type']); // Image/png 형태로 저장되어 있으므로 / 기준으로 자름 ['Image', '확장자']
		$fileName = uniqid().'.'.$type[1];	// 2gg848941g.확장자
		$filepath = _PATH_IMG.'/'.$fileName;	// /View/img/2gg848941g.확장자
		move_uploaded_file($file['tmp_name'], _ROOT.$filepath); // 파일 복사 

		return $filepath;
	}
}