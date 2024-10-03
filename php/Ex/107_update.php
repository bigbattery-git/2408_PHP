<?php

  require_once("./my_db.php");

  try{
    $conn = my_db_conn();

    $conn -> beginTransaction();
    $name = "가나다";
    $whereName = "홍길동";

    $sql = 
    " UPDATE              "
    ." employees          "
    ." SET                " 
    ." NAME = :name,      "
    ." updated_at = NOW() "
    ." WHERE              " 
    ." NAME = :whereName  "
    ;

    $arr_prepare=[
      "name"      => $name,
      "whereName" => $whereName
    ];

    $stmt = $conn -> prepare($sql);
    $stmt -> execute($arr_prepare);
    
    $conn -> commit();
  }
  catch(Throwable $tr){

    if(!is_null($conn)){
      $conn -> rollBack();
    } 
    echo $tr->getMessage();
  }