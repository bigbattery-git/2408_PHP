<?php

namespace Models;

use Exception;
use Models\Model;
use Throwable;

class User extends Model{
	/**
	 * 유저정보 찾는 모델 메소드
	 */
	public function getUserInfo($paramArr){
		try{
			$sql = 
			' SELECT * 									'
			.' FROM users 							'
			.'WHERE u_email = :u_email 	'
			;

			$stmt = $this->conn->prepare($sql);
			$resultFlg = $stmt->execute($paramArr);

			if(!$resultFlg){
				throw new Exception('sql error : User->getUserInfo');
			}

			return $stmt->fetch();

		} catch(Throwable $th){
			echo 'User->getUserInfo(), '.$th -> getMessage();
			exit;
		}
	}

	/**
	 * 회원가입 담당 모델 메소드
	 * @return 삽입된 레코드 개수
	 */
	public function registUserInfo($paramArr){
		try{
			$sql = 
			' INSERT INTO users(		'
			.'	u_email							'
			.'	,u_password					'
			.'	,u_name	)						'
			.'	VALUES (						'
			.'	:u_email						'
			.'	,:u_password				'
			.'	,:u_name )					'
			;

			$stmt = $this->conn->prepare($sql);
			$stmt->execute($paramArr);

			return $stmt->rowCount();
		} catch(Throwable $th) {
			echo 'User->registUserInfo(), '.$th -> getMessage();
		}
	}
}