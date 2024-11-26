<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use PDOException;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array<int, class-string<Throwable>>
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->reportable(function (Throwable $e) {
			//
		});
	}

	// 우리가 일어나는 모든 예외처리는 report 메서드를 거쳐서 발생하게 됨
	// 그 report 메서드를 override하는 것
	// 시스템이 작동하다가 에러 발생하면 기록하기 위해 사용(log 등)
	public function report(Throwable $th){
		// Log::error('report: '.$th->getMessage());
	}

	/** 커스텀 에러 핸들링 
	 * 예외 or 에러, 브라우저로 렌더링 되기 직전에 호출됨
	 * 커스텀 HTTP 응답 전달
	 * 예도 override하는 친구임
	*/
	public function render($request, Throwable $th){
		// 예외 코드 초기화
		$code = 'E99';

		// 인스턴스 확인 후 예외 정보 변경
		if($th instanceof AuthenticationException){
			$code = 'E01';
		}	else if($th instanceof PDOException){
			$code = 'E80';
		}

		// 에러 정보 가져오기
		$errInfo = $this->contest()[$code];

		// 커스텀 Exception 인스턴스 확인
		if($th instanceof MyAuthException){
			$code = $th->getMessage();
			$errInfo = $th->context()[$code];
		}
		
		// response Data 생성
		$responseData = [
			'success' => false
			,'msg' => $errInfo['msg']
			,'code' => $code			
		];

		// response: 라라벨이 response한다는 것을 인식시켜주기 위한 메서드
		// json도 편하게 보내줄 수도 있고 객체도 보낼 수 있고
		return response()->json($responseData, $errInfo['status']);
	}

	/** 
	 * 에러 메시지, 에러 코드 반환함
	 * 얘도 override라서 잘 써야함(기존 에러 메시지를 새롭게 바꿔쓰는 개념)
	 * 
	 * @return Array 에러메시지 배열
	 */
	public function contest(){
		return [
			"E01" => ['status' => 401, 'msg' => '비밀번호 틀렸음 ㅅㄱ']
			,'E80' => ['status' => 500, 'msg' => 'DB 서버 터짐 ㅅㄱ']
			,'E99' =>['status' => 500, 'msg' => '원인 불명의 오류']
		];
	}
}