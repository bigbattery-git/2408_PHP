<?php

namespace Models;

use Exception;
use Models\Model;
use Throwable;

class User extends Model{
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
}