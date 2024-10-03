<?php

  // PDO 클래스

  // 현업에서 가장 많이 사용하는 DB 엑세스 방법
  // 이를 통해 DB 접속, 쿼리문으로 데이터 가져오기, 가공 (연관배열) 등을 쉽게 할 수 있음
  // Maria DB에서 Oracle로 바뀐다 한들 설정 조금만 바꿔주면 다시 그대로 쓸 수 있음

  // DB에 접속하기 
  // DB 접속 정보 미리 만들어두기
  $my_host = "127.0.0.1";   // 접속하고자 하는 서버의 ip주소. 자기 컴퓨터로 접속하면 "localhost"라고 적어도 됨
  $my_user = "root";        // DB 계정명
  $my_password = "php504";  // DB 비밀번호
  $my_db_name = "dbsample"; // 접속할 DB 이름
  $my_charset = "utf8mb4";  // DB Character set

  $my_dsn = "mysql:host=".$my_host.";dbname=".$my_db_name.";charset=".$my_charset; // DB에 접속하기 위한 정보를 담고 있는 문자열

  //  PDO 옵션 설정
  $my_otp = [
    // Prepared Statement. 쿼리문을 준비할 때, PHP와 DB 어디에서 에뮬레이션을 할 것인가
    PDO::ATTR_EMULATE_PREPARES    => false, // DB에서 하겠다는 뜻

    // PDO에서 예외를 처리하는 방법 (에러 등을 어떻게 처리할 것인가)
    PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,

    // DB 정보를 가져와서 fetch하는 방법
    PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC
  ];

  // DB 접속
  $conn = new PDO($my_dsn, $my_user, $my_password, $my_otp);

  // select
  $sql = "SELECT *
          FROM employees
          ORDER BY employees.emp_id ASC
          LIMIT 5
          ;";

  // 작성한 select를 이용하여 DB에 데이터 요청하기 
  $stmt = $conn->query($sql); // 쿼리 준비 후 실행까지 하는 메서드

  $result = $stmt->fetchAll(); // 우리가 쿼리문을 통해 검색한 데이터를 연관 배열의 형태로 패치해줌

  // print_r($result);

  // 사번과 이름만 출력하고 싶을 때 
  foreach($result as $value){
    echo $value["emp_id"]." ".$value["name"]."\n";
  }