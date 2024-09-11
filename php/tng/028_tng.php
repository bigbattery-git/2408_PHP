<?php

  // 구구단 출력하기 
  $multiplication = 6;

  for($i = 1; $i < 10; $i++){
    echo $multiplication." X ".$i." = ".$multiplication * $i."\n";
  }

// =============================================================================================
// 1. 3의 배수 게임 (100까지)
// 출력 예) 1, 2, 짝, 4, 5, 짝, 7, 8, 짝, 10, 11, 짝, ... 
  $count = 100;
  for($i = 1; $i <= $count; $i++){

    if($i % 3 === 0)
      echo "짝 ";
    else
      echo $i." ";

    if($i % 10 === 0)
      echo "\n";
  }

// 2. 반복문을 이용하여 급여가 5000이상이고, 성별이 남자인 사원의 id와 이름을 출력해주세요.

  $arr = [
    ["id" => 1, "name" => "미어캣", "gender" => "M", "salary" => "6000" ],
    ["id" => 2, "name" => "홍길동", "gender" => "M", "salary" => "3000" ],
    ["id" => 3, "name" => "갑순이", "gender" => "F", "salary" => "10000" ],
    ["id" => 4, "name" => "갑돌이", "gender" => "M", "salary" => "8000" ]
  ];

  foreach ($arr as $value){
    if($value["salary"] < 5000)
      continue;

    if($value["gender"] !== "M")
      continue;

    echo "id : ".$value["id"]." ";
    echo "name : ".$value["name"]."\n";
  }