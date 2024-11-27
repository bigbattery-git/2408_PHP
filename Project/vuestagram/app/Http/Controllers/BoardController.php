<?php

namespace App\Http\Controllers;

use App\Models\Board;
use MyToken;
use Illuminate\Http\Request;

class BoardController extends Controller
{
	public function index(){
		$boardList = Board::orderBy('created_at', 'DESC')->paginate(8);

		$responseData = [
			'success' => true
			,'msg' => '게시글 획득 성공'
			,'boardList' => $boardList->toArray()
		];
		return response()->json($responseData, 200);
	}

	public function show($id){
		// 이거 사용할 때 주의사항 : join 자체는 엘리펀트 모델인게 맞는데, 그 내부에 들어가는 것은 엘리펀트 모델이 아님 -> soft delete된 데이터도 같이 가져오게 됨
		// 그냥 relationship 쓰셈
		// $board = Board::join('users', 'boards.user_id', '=', 'users.user_id')
		// 				->select('boards.*', 'users.name')
		// 				// ->where('boards.boards_id', '=', $id)
		// 				// ->first();
		// 				->find($id);

		// 모델에서 relation ship 맺어두고 사용하기 
		$board = Board::with('users') // Board 모델에 relation ship 맺어둔 메소드 이름 넣어야 함
							->find($id);

		$responseData = [
			'success' => true
			,'msg' => '상세 정보 획득 성공'
			,'board' => $board->toArray()
		];

		return response()->json($responseData, 200);
	}

	public function store(Request $request){
		// TODO 유효성 체크 넣어야 함

		$insertData = $request->only('content');
		$insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
		$insertData['like'] = 0;
		$insertData['img'] = '/'.$request->file('file')->store('img');

		$board = Board::create($insertData);

		$responseData = [
			'success' => true
			,'msg' => '개시글 작성 성공'
			,'board' => $board->toArray()
		];

		return response()->json($responseData, 200);
	}
}
