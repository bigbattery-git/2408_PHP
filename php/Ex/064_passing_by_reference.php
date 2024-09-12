<?php
  $num1 = 100;
  $num2 = $num1;

  $num2 -= 50;

  echo $num1.", ", $num2; // 100, 50

  $num1 = 100;
  $num2 = &$num1;

  $num2 -= 50;

  echo $num1.", ", $num2; // 50, 50

  function test($num){
    $num--;
  }

  $testNum = 1;
  test($testNum);

  echo $testNum; // 1

  function test2(&$num){
    $num--;
  }

  $testNum = 1;
  test($testNum);

  echo $testNum; // 0