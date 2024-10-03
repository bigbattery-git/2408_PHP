<?php

  // 함수 선언
  //  예시) 두 수의 합을 반환하는 함수
  /**
   * 두 수의 합을 반환하는 함수 
   * @param $numA : 숫자1
   * @param $numB : 숫자2
   */
  function sum($sumA, $sumB){
    return $sumA + $sumB;
  }

  echo sum(5,3);

  // function 함수명($매개변수1, $매개변수2, ...){
  //   실행할;
  //   코드;
  //   작성;
  //   return 반환값;
  // }

  // 연습문제 : 두 수를 받아서 -, *, /, % 결과를 반환하는 함수를 만드시오

  /**
   * 뺄셈
   */
  function calSub($sumA, $sumB){
    return $sumA - $sumB;
  }

  /**
   * 곱셈
   */
  function calMulti($sumA, $sumB){
    return $sumA * $sumB;
  }

  /**
   * 나눗셈
   * @param $sumA : 나뉘어질 값
   * @param $sumB : 나누는 값
   */
  function calDiv($sumA, $sumB){
    if($sumB == 0){
      return null;
    }

    return (int)($sumA / $sumB);
  }

  /**
   * 나머지
   * @param $sumA : 나뉘어질 값
   * @param $sumB : 나누는 값
   */
  function calRem($sumA, $sumB){
    if($sumB == 0){
      return null;
    }

    return $sumA % $sumB;
  }

  // 가변 길이 아규먼트
  // 예시)전달하는 모든 숫자를 더해서 반환하는 함수 
  function sumAll(...$numbers){
    $sumResult = 0;

    foreach ($numbers as $value){
      $sumResult += $value;
    }

    return $sumResult;
  }

  echo sumAll(1,2,3,4,5,6,7,8,9,10); // 55
  // function 함수명(...변수명){
  //   실행할;
  //   코드;
  //   작성;
  //   return 반환값;
  // }

  echo array_sum([1,2,3,4,5,6,7,8,9,10]); // 55

  // php 5.5 이하일 때 가변길이 아규먼트 사용 방법 
  function my_sum_all(){
    $numbers = func_get_args();

    $sum = 0;
    foreach($numbers as $value){
      $sum += $value;
    }

    return $sum;
  }

  echo my_sum_all(1,2,3,4,5,6,7,8,9,10); // 55