<?php

function my_db_conn(){
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
  return new PDO($my_dsn, $my_user, $my_password, $my_otp);
}