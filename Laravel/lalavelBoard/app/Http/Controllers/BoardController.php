<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

		return view('Board')->with('datas', $result);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// create : 작성페이지로 이동 
	public function create()
	{
		//
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
		//
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
