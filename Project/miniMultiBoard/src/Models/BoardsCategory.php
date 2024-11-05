<?php

namespace Models;

use Exception;
use Models\Model;
use Throwable;

class BoardsCategory extends Model{
	public function getBoardName($paramArr){
		try{
			$sql = 
			' SELECT 								'
			.' bc_name 							'
			.' FROM 								'
			.' boards_category 			'
			.' WHERE 								'
			.' bc_type = :bc_type 	'
			;

			$stmt = $this->conn->prepare($sql);
			$resultFlg = $stmt->execute($paramArr);

			if(!$resultFlg){
				throw new Exception('sql error : User->getBoardName');
			}

			return $stmt->fetch();
		} catch(Throwable $th){
			echo $th->getMessage();
			exit;
		}
	}

	public function getBoardNameList(){
		try{
			$sql = 
			' SELECT 			'
			.' bc_name 			'
			.' ,bc_type 		'
			.' FROM 			'
			.' boards_category 	'
			.' ORDER BY 		'
			.' bc_type ASC 		'
			;

			$stmt = $this->conn->query($sql);
			return $stmt->fetchAll();

		} catch(Throwable $th){
			echo $th->getMessage();
			exit;
		}
	}
}