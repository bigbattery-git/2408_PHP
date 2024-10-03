<?php

  require_once("./my_db.php");
$conn = null;

try{
  // DB 연결
  $conn = my_db_conn();

  // 트랜색션 시작
  $conn -> beginTransaction();

  $emp_name = "유원상";
  $emp_birth = "1996-10-15";
  $emp_gender = "M";
  // 쿼리문 작성
  // 직원정보문서
  $sql=
  " INSERT INTO employees( "
	." NAME,                 "
	." birth,                "
	." gender,               "
	." hire_at               "
  ." )                     "
  ." VALUE(                "
	." :emp_name,            "
	." :emp_birth,           "
	." :emp_gender,          "
	." DATE(NOW())           "
  ." )                     ";

  // statement prepare 작성
  $arr_prepare = [
    "emp_name" => $emp_name,
    "emp_birth" => $emp_birth,
    "emp_gender" => $emp_gender
  ];

  $stmt = $conn->prepare($sql);                   // 쿼리 연결
  $result_bool = $stmt -> execute($arr_prepare);  // 쿼리 실행
  $result_count = $stmt->rowCount();              // 영향받은 레코드 개수

  // 예외 처리
  if(!$result_bool){
    throw new Exception("Insert Query Error : employees");
  }

  if($result_count !== 1){
    throw new Exception("Insert Count Error : employees");
  }
  // insert한 pk번호 얻기
  $emp_id = $conn->lastInsertId(); // 가장 마지막에 삽입한 쿼리문의 pk 번호를 획득 가능

  // ================================ 급여테이블 ====================================
  $Salary = 1000000000;
  $sql =   
  " INSERT INTO salaries( "
	." emp_id,              "
	." salary,              "
	." start_at             "
  ." )                    "
  ." VALUE(               "
	." :emp_id,             "
	." :salary,             "
	." DATE(NOW())          "
  ." )                    ";

  $arr_prepare = [
    "emp_id" => $emp_id,
    "salary" => $Salary
  ];

  $stmt = $conn->prepare($sql);
  $result_bool = $stmt ->execute($arr_prepare);
  $result_count = $stmt -> rowCount();

  if(!$result_bool){
    throw new Exception("Insert Query Error : salaries");
  }

  if($result_count !== 1){
    throw new Exception("Insert Count Error : salaries");
  }

  // ============================= 직급 테이블 ========================================
  $title_code = 'T001';
  $sql =   
  " INSERT INTO title_emps( "
	." emp_id,                "
	." title_code,            "
	." start_at               "
  ." )                      "
  ." VALUE(                 "
	." :emp_id,               "
	." :title_code,           "
	." DATE(NOW())            "
  ." )                      ";

  $arr_prepare = [
    "emp_id" => $emp_id,
    "title_code" => $title_code
  ];

  $stmt = $conn->prepare($sql);
  $result_bool = $stmt ->execute($arr_prepare);
  $result_count = $stmt -> rowCount();

  if(!$result_bool){
    throw new Exception("Insert Query Error : title_emps");
  }

  if($result_count !== 1){
    throw new Exception("Insert Count Error : title_emps");
  }

  // ===================================== 부서 테이블 ==========================================================
  $dept_code = 'D005';
  $sql =   
  " INSERT INTO department_emps( "
	." emp_id,                     "
	." dept_code,                  "
	." start_at                    "
  ." )                           "
  ." VALUE(                      "
  ." :emp_id,                    "
  ." :dept_code,                 "
	." DATE(NOW())                 "
  ." )                           ";

  $arr_prepare = [
    "emp_id" => $emp_id,
    "dept_code" => $dept_code
  ];

  $stmt = $conn->prepare($sql);
  $result_bool = $stmt ->execute($arr_prepare);
  $result_count = $stmt -> rowCount();

  if(!$result_bool){
    throw new Exception("Insert Query Error : department_emps");
  }

  if($result_count !== 1){
    throw new Exception("Insert Count Error : department_emps");
  }

  // 트랜색션 종료, 커밋
  $conn->commit();
}
catch(Throwable $tr){
  if(!is_null($conn)){
    $conn->rollBack();
  }

  echo $tr->getMessage();
}