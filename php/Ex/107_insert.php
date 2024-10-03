<?php

require_once("./my_db.php");

try{
  $conn = my_db_conn();

  $name = "테스트";
  $birth = "2020-02-02";
  $gender = "M";
  $sqr = // insert문으로 삽입하기
    "INSERT INTO employees("
    ." NAME, "
    ." birth, "
    ." gender, "
    ." hire_at "
    ." ) "
    ." VALUE( "
    ." :NAME, "
    ." :birth, "
    ." :gender, "
    ." date(now()) "
    ." ) ";

    $arr_prepare=[
      "NAME" => $name,
      "birth" => $birth,
      "gender"=> $gender
    ];

    // transsaction 시작
    $conn->beginTransaction();

    $stmt = $conn->prepare($sqr);               // 쿼리 준비
    $exec_flg = $stmt->execute($arr_prepare);   // 쿼리 실행
    $result_cnt = $stmt->rowCount();            // 영향 받은 레코드 수 반환 

    if(!$exec_flg){
      throw new Exception("execute 예외 발생");
    }
    if($result_cnt !== 1){
      throw new Exception("경고. 레코드가 한 번에 둘 이상 삽입되었습니다.");
    }

    $conn->commit();
}
catch(Throwable $th){
  echo $th->getMessage();
  $conn -> rollBack();
}