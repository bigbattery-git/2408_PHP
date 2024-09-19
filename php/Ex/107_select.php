<?php

  require_once("./my_db.php");

  try{
    $conn = my_db_conn();
    
    // prepared Statement
    // sql쿼리문에서 연결연산자를 써서 이어붙이는 행위는 매우 위험하다
    $id = 1;
    $name = "홍길동";
  
    // $sql = " SELECT           " 
    //       ." *                "
    //       ." FROM employees   " 
    //       ." WHERE            "
    //       ." emp_id = :emp_id "
    //       ." OR name = :name  "
    //       ;
    
    // $arr_prepare = [
    //   "emp_id" => $id,
    //   "name"   => $name
    // ];

    // select with prepared Statement

    $sql = " SELECT                       "
          ." *                            "
          ." FROM                         "
          ." employees                    "
          ." WHERE                        "
          ." emp_id IN (:emp_id1, :emp_id2) "
          ;
    
    $arr_prepare = [ 
      "emp_id1" => 10001,
      "emp_id2" => 10002
    ];
  
    $stmt = $conn->prepare($sql); // sql 질의 준비
    $stmt->execute($arr_prepare); // sql 질의 실행
  
    $result = $stmt->fetchAll();  // 질의 결과 패치
    
    print_r($result);
  }
  catch(Throwable $th){
    // echo $th->getMessage()."\n";  // 예외 메시지 출력
  }
  finally{

  }