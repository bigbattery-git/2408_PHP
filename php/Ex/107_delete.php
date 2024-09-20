<?php

require_once("./my_db.php");

try{
  $conn = my_db_conn();

  $conn -> beginTransaction();
  $id = 100005;

  $sql = 
    " DELETE FROM employees "
    ." WHERE "
    ." emp_id = :emp_id "
    ;

  $arr_prepare = [
    "emp_id" => $id
  ];

  $stmt = $conn->prepare($sql);                 // 쿼리 준비
  $result_flg = $stmt->execute($arr_prepare);   // 쿼리 실행, 쿼리 성공 여부
  $result_count = $stmt->rowCount();            // 영향 받은 레코드 수

  if(!$result_flg){
    throw new Exception("예외 발생");
  }

  if($result_count > 1){
    throw new Exception("둘 이상의 레코드 변화 감지");
  }

  $conn -> commit();
}
catch(Throwable $tr){
  if(!is_null($conn)){
    $conn->rollBack();
  }
}

?>