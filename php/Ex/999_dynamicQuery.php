<?php

  $data =[
    "name" => "둘리",
    "gender" => "M"
  ];

  $sql =
  " SELECT     "
  ." *         "
  ." FROM      "
  ." employees "
  ;

  $where = 
  "";
  $arr_prepare =[];

  foreach($data as $key => $value){
    if(empty($where)){
      $where .= " WHERE ";
    }
    else{
      $where .= " AND ";
    }

    $where .= " ".$key." = :".$key;

    $arr_prepare[$key] = $value;
  }

  $sql .= $where;
?>