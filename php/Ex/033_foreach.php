<?php

  $arr = [1,2,3,4,5,6];

  foreach ($arr as $ar){
    echo $ar.", ";
  } // 1, 2, 3, 4, 5, 6,

  foreach($arr as $키 => $값){
    echo "키 : ".$키."="."값 : ".$값.", ";
  }
  // 키 : 0=값 : 1, 키 : 1=값 : 2, 키 : 2=값 : 3, 키 : 3=값 : 4, 키 : 4=값 : 5, 키 : 5=값 : 6, 

  $arr2 = [1,2,3,4,5,6,7,8,9];
  $multi = 9;

  echo $multi."단입니다! \n \n";
  foreach ($arr2 as $multies){
    echo $multi." X ".$multies." = ".($multi * $multies)."\n";
  }

  $arr3 =[
    "name" => "유원상",
    "age" => 20,
    "gender" => "M"
  ];

  foreach ($arr3 as $key => $value){
    echo $key." : ".$value."\n";
  }