<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
	public function index()
	{        
		$result = Board::join('users', 'users.u_id', '=', 'boards.u_id')
						->select('boards.b_id', 'users.u_name', 'boards.bc_type', 'boards.b_title', 'boards.b_content', 'boards.b_img')
						->orderByDesc('boards.created_at')
						->orderBy('boards.b_id')
						->get();

		return view('Board')
					->with('datas', $result)
					->with('title', '자유')
					->with('bc_type', '0');
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
		$validator = Validator::make($request->only(['b_title', 'b_content', 'b_img']), [
			'b_title' => ['required', 'max:50']
			,'b_content' => ['required', 'max:200']
			,'b_img' => ['required']
		]);

		// 유효성 검사
		// b_title : 필수, 최대 50글자
		// b_content : 필수, 최대 200글자
		// b_img : 필수

		if($validator->fails()){
			return redirect()->
			route('boards.store')->
			with('bc_type', $request->bc_type);
		}
		// $path = $request->file('b_img')->storeAs('img', uniqid(), 'local');
		$path = $request->file('b_img')->store('img');

		try{			
			DB::beginTransaction();

			$insertBoardData = new Board();
			$insertBoardData->u_id = Auth::id();
			$insertBoardData->bc_type = $request->bc_type;
			$insertBoardData->b_title = $request->b_title;
			$insertBoardData->b_content = $request->b_content;
			$insertBoardData->b_img = $path;
			$insertBoardData->save();

			DB::commit();
		} catch(Throwable $th) {
			// 디버깅할 때만 주석 해제하고 사용할 것
			// var_dump($th->getMessage());
			// exit;

			DB::rollBack();
		}

		return redirect()->route('boards.index')->with('bc_type', $request->bc_type);
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
		Log::debug('--------------- boards.show start ---------------');
		Log::debug('b_id : '.$id);

		$result = Board::join('users', 'users.u_id', '=', 'boards.u_id')
		->select('boards.b_id', 'users.u_name', 'boards.bc_type', 'boards.b_title', 'boards.b_content', 'boards.b_img', 'boards.created_at')
		->where('boards.b_id', '=', $id)
		->orderByDesc('boards.created_at')
		->orderBy('boards.b_id')
		->first();

		Log::debug('result Data', $result->toArray());

		return response()->json($result->toArray());
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
		//
	}
}
