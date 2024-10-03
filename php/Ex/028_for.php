<?php

  // 0부터 4까지 숫자 출력하기
  for($i = 0; $i<5; $i++){
    echo $i."\n";
    if($i === 3){
      break;
    }
  } // 0, 1, 2, 3

  // 0부터 10까지 출력하되, 짝수는 출력 X
  for($i = 0; $i <11; $i++){
    if($i%2 === 0 && $i !== 0){
      continue;
    }
    echo $i."\n";
  }// 0, 1, 3, 5, 7, 9

  // multi loop 
  for($i = 0; $i<3; $i++){
    echo $i."번 반복 중";

    for($j = 0; $j < 3; $j++){
      echo $j." ";
    }
    
    echo "\n";
  }

  // 구구단 전체 출력하기
  $maxMulti = 9;

  for($i = 1; $i <= $maxMulti; $i++){
    echo $i."단 \n";
    for($j = 1; $j < 10; $j++){
      echo $i." X ".$j." = ".($i * $j)."\n"; 
    }
    echo "\n";
  }

  // 연습문제 2 : 별찍기 1
  for($i = 0; $i<5; $i++){
    echo "*****\n";
  }

  // 연습문제 3 : 삼각형
  $pry = 5;
  for($i = 1; $i <= $pry; $i ++){
    for($j = 1; $j <= $i; $j ++){
      echo "*";
    }
    if($i !== $pry){
      echo "\n";
    }
  }

  echo "*\n";
  echo "**\n";
  echo "***\n";
  echo "****\n";
  echo "*****\n";

  // 연습문제 4 : 역삼각형
  $pry = 5;
  for($i = 1; $i <= $pry; $i ++){
    for($j = 1; $j <= ($pry - $i); $j ++){
      echo " ";
    }
    for($j = 1; $j <= $i; $j ++){
      echo "*";
    }
    if($i !== $pry){
      echo "\n";
    }
  }

  echo "    *\n";
  echo "   **\n";
  echo "  ***\n";
  echo " ****\n";
  echo "*****";
