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
  test2($testNum);

  echo $testNum; // 0

  // 스코프 : 변수나 함수의 유효 범위

  // 전역 스코프

  $intA = 10;     // 전역 스코프
  $strA = "abc";  // 전역 스코프

  function TestTest($testParam){
    global $intA;   // 지역 스코프 영역에서 전역 스코프 변수를 사용하려면 global로 선언해야 함
    echo $intA;

    $intB = 20;     // 지역 스코프
    $strB = "def";  // 지역 스코프
  }

  TestTest(1);