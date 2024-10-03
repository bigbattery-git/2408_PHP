<?php

  require_once("../Ex/my_db.php");

  $conn = null;
  try{
    $conn = my_db_conn();

    $conn -> beginTransaction();

    $data = [
      ["name" => "둘리", "birth" => "1986-01-01", "gender"=> "M"],
      ["name" => "희동이", "birth" => "1990-01-01", "gender"=> "F"],
      ["name" => "고길동", "birth" => "1968-01-01", "gender"=> "M"]
    ];

    foreach($data as $value){
      $sql = 
      " INSERT INTO employees( "
      ." name, "
      ." birth, "
      ." gender, "
      ." hire_at "
      ." ) "
      ." values( "
      ." :name, "
      ." :birth, "
      ." :gender, "
      ." date(now())"
      ." ) "
      ;

      $arr_prepare = [
        "name"    => $value["name"],
        "birth"   => $value["birth"],
        "gender"  => $value["gender"]
      ];

      $stmt = $conn -> prepare($sql);
      $result_bool = $stmt -> execute($arr_prepare);
    }

    $conn -> commit();
  }
  catch(Throwable $tr){
    if(!is_null($conn)){
      $conn -> rollBack();
    }
  }