<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardsCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	// index : 리스트페이지로 이동
	public function index(Request $request)
	{   
		$bc_type = '0';
		if($request->has('bc_type')){
			$validator = Validator::make($request->only('bc_type'), [
				'bc_type' => ['exists:boards_category,bc_type']
			]);
			if($validator->fails()){
				$bc_type = '0';
			} else {
				$bc_type = $request->bc_type;
			}
		}

		// $bc_type = $request->has('bc_type') ? $request->bc_type : '0';

		$result = Board::join('users', 'users.u_id', '=', 'boards.u_id')
						->select('boards.b_id','boards.u_id', 'users.u_name', 'boards.bc_type', 'boards.b_title', 'boards.b_content', 'boards.b_img')
						->where('bc_type', '=', $bc_type)
						->orderByDesc('boards.created_at')
						->orderBy('boards.b_id')
						->get();
		
		$boardInfo = BoardsCategory::where('bc_type', '=', $bc_type)
								->first();
		
		return view('Board')
					->with('datas', $result)
					->with('boardInfo', $boardInfo);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// create : 작성페이지로 이동 
	public function create(Request $data)
	{
		return view('create')->with('bc_type', $data->bc_type);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	// store : 작성페이지에서 작성 처리를 함
	public function store(Request $request)
	{
		// Request->only(['key1', 'key2', 'key3', ...]) : only메소드 안에 들어있는 파라미터의 배열값을 대상으로 이에 해당하는 value와 함께 배열로 반환함
		// return ['key1'=>key1에 해당하는 value값, 'key2'=>key2에 해당하는 value값, ...]
		
		// 유효성 검사 2. Request->validate([ '검사대상1' => 검사목록, '검사대상2' => 검사목록2, ...])
		// 유효성 검사 실패 시, 이전 사이트로 바로 이동 + 에러메시지 자동 전달
		// 단점 : 리다이렉트 맘대로 못함, 추가 데이터도 못보냄(with 못함)
		// $request->validate([
			// 	'b_title' => ['required','min:1', 'max:50']
			// 	,'b_content' => ['required','min1', 'max:200']
			// 	,'b_img' => ['required', 'image']
			// ]);
			
		// 유효성 검사
		// b_title : 필수, 최대 50글자
		// b_content : 필수, 최대 200글자
		// b_img : 필수

		$validator = Validator::make($request->only(['b_title', 'b_content', 'b_img', 'bc_type']), [
			'b_title' => ['required','min:1', 'max:50']
			,'b_content' => ['required','min:1', 'max:200']
			,'b_img' => ['required', 'image']
			,'bc_type' => ['required', 'exists:boards_category,bc_type']
		]);
		
		if($validator->fails()){
			return redirect()->
			route('boards.store')->
			withErrors($validator->errors())->
			with('bc_type', $request->bc_type);
		}

		$path = '.png';
		try{			
			// $path = $request->file('b_img')->storeAs('img', $request->file('b_img')->getClientOriginalName(), 'local');
			$path = $request->file('b_img')->store('img');

			DB::beginTransaction();

			$insertBoardData = new Board();
			$insertBoardData->u_id = Auth::id(); // 유저가 입력하는 정보가 아닌, DB에 저장된 정보를 사용하는거라 유효성 검사를 안함
			$insertBoardData->bc_type = $request->bc_type;
			$insertBoardData->b_title = $request->b_title;
			$insertBoardData->b_content = $request->b_content;
			$insertBoardData->b_img = $path;
			$insertBoardData->save();

			DB::commit();
		} catch(Throwable $th) {
			DB::rollBack();
			
			// 글 작성 실패했음에도 파일이 저장되어있음. 이런 경우 삭제해야 함
			// Storage::delete('path');
			if(Storage::exists($path)){
				Storage::delete($path);
				
				// 디스크 지정 시 
				// Storage::disk('local')->delete($path);
			}

			return redirect()->
			route('boards.store')->
			withErrors('글 작성 실패함. 물떠놓고 기도하셈 ㅅㄱ')->
			with('bc_type', $request->bc_type);

			// 디버깅할 때만 주석 해제하고 사용할 것
			// var_dump($th->getMessage());
			// exit;
		}

		return redirect()->route('boards.index', ['bc_type' => $request->bc_type]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// show : 상세 데이터를 만들어서 보내는 역할
	// 아예 detail 페이지로 보내서 데이터를 보여줄지, json으로 데이터를 전달할 지는 시스템에 따라 다름
	public function show($id)
	{
		// Log::debug('--------------- boards.show start ---------------');
		// Log::debug('b_id : '.$id);

		$result = Board::join('users', 'users.u_id', '=', 'boards.u_id')
		->select('boards.b_id', 'boards.u_id', 'users.u_name', 'boards.bc_type', 'boards.b_title', 'boards.b_content', 'boards.b_img', 'boards.created_at')
		->where('boards.b_id', '=', $id)
		->orderByDesc('boards.created_at')
		->orderBy('boards.b_id')
		->first();

		$responseData = $result->toArray();
		$responseData['delete_flg'] = $result->u_id === Auth::id();

		// Log::debug('result Data', $result->toArray());

		return response()->json($responseData);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// edit : update 페이지로 이동
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// update : update 페이지에서 수정 처리를 함
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// destroy : 삭제 처리를 함 
	// 요즘은 모달창을 이용하거나 alert 함수를 이용하여 삭제 확인을 하므로 삭제페이지를 만들거나 갈 일은 잘 없음
	// 필요하면 삭제페이지로 이동하는 액션메소드 하나 만들어야 함
	public function destroy($id)
	{
		// 유효성 1. 숫자인지 아닌지, 삭제하는 유저와 게시글 작성 유저가 같은지

		$result = null;
		$responseData = [];
		try{
			DB::beginTransaction();
			$resultImgPath = Board::find($id)->b_img;
			if(Storage::exists($resultImgPath)){
				Storage::delete($resultImgPath);
			}
			
			$result = Board::destroy($id);
			if($result !==1){
				throw new Exception('하나의 게시글이 삭제되지 않았습니다 : '.$result.'개');
			}
			DB::commit();			
			$responseData['success'] = true;
		}catch(Throwable $th){
			DB::rollBack();
			$responseData['success'] = false;
			// 디버깅 할 때만 풀어서 사용
			// var_dump($th);
			// exit;
		}

		return response()->json($responseData);
	}
}
