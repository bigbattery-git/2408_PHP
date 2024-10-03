<?php

require_once("../Ex/my_db.php");

$conn = null;
try{

  $conn = my_db_conn();

  $conn->beginTransaction();

  // 내 이름의 emp_id 찾기

  $emp_name = '유원상';
  $sql =
  "	SELECT                      "
  ." employees.emp_id           "
	." FROM employees             "
	." WHERE                      " 
  ." employees.name = :emp_name "
  ;

  $arr_prepare = [
    "emp_name" => $emp_name
  ];

  $stmt = $conn->prepare($sql);
  $result_bool = $stmt -> execute($arr_prepare);

  $result = $stmt -> fetch();

  if(is_null($result)){
    throw new Exception("no data");
  }

  $my_empid = $result["emp_id"];
  // =========================== 현재 월급 종료 ========================================

  $sql = 
  " UPDATE salaries               "
  ." SET                          "
	." end_at = DATE(NOW()),        "
	." updated_at = NOW()           "
  ." WHERE                        "
	." emp_id = :my_empid           "
  ." AND end_at IS NULL           "
  ;

  $arr_prepare =[
    "my_empid" => $my_empid
  ];

  $stmt = $conn->prepare($sql);
  $result_bool = $stmt->execute($arr_prepare);
  $result_count = $stmt->rowCount();

  if(!$result_bool){
    throw new Exception("Error update query : salaries");
  }
  if($result_count !== 1){
    throw new Exception("Error update count : salaries");
  }

  // ======================= 새 월급정보 삽입 =============================================

  $salary = 25000000;
  $sql =
  " INSERT INTO salaries( "
	." emp_id,              "
	." salary,              "
	." start_at             "
  ." )                    "
  ." VALUE(               "
  ." :emp_id,             "
  ." :salary,             "      
  ." date(now())          "
  ." )                    "
  ;

  $arr_prepare = [
    "emp_id" => $my_empid,
    "salary" => $salary
  ];

  $stmt = $conn->prepare($sql);
  $result_bool = $stmt->execute($arr_prepare);
  $result_count = $stmt->rowCount();

  if(!$result_bool){
    throw new Exception("Error insert query : salaries");
  }
  if($result_count !== 1){
    throw new Exception("Error insert count : salaries");
  }

  $conn -> commit();
}
catch(Throwable $tr){

  if(!is_null($conn)){
    $conn->rollBack();
  }
  echo $tr->getMessage();
}