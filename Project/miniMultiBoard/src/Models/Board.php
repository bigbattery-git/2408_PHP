<?php

namespace Models;

use Exception;
use Models\Model;
use Throwable;

class Board extends Model{
	public function getBoardList($paramArr){
		try{
			$sql =
			' SELECT  																	'
			.' users.u_name															'
			.' ,boards.b_id															'
			.' ,boards.b_title													'
			.' ,boards.b_content												'
			.' ,boards.b_img														'
			.' FROM boards 															'
			.' JOIN users																'
			.' ON	users.u_id = boards.u_id							'
			.' WHERE 																		'
			.' boards.bc_type = :bc_type 								'
			.' AND boards.deleted_at IS NULL 						'
			.' ORDER BY 																'
			.' boards.created_at DESC, boards.b_id DESC	'
			;

			$stmt = $this->conn->prepare($sql);
			$resultFlg = $stmt->execute($paramArr);

			if(!$resultFlg){
				throw new Exception('sql error : User->getBoardList');
			}

			return $stmt->fetchAll();
		} catch(Throwable $th) {
			echo 'Board->getBoardList(), '.$th->getmessage();
			exit;
		}
	}

	public function getBoardDetail($paramArr){
		try{
			$sql =
			' SELECT  												'
			.' users.u_name										'
			.' ,boards.b_id										'
			.' ,boards.b_title								'
			.' ,boards.b_content							'
			.' ,boards.b_img									'
			.' FROM boards 										'
			.' JOIN users											'
			.' ON	users.u_id = boards.u_id		'
			.' WHERE 													'
			.' boards.b_id = :b_id 						'
			.' AND boards.deleted_at IS NULL 	'
			;

			$stmt = $this->conn->prepare($sql);
			$resultFlg = $stmt->execute($paramArr);

			if(!$resultFlg){
				throw new Exception('sql error : User->getBoardList');
			}

			return $stmt->fetch();
		} catch(Throwable $th) {
			echo 'Board->getBoardDetail(), '.$th->getmessage();
			exit;
		}
	}
}