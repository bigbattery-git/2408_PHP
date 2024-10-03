<?php

  // 연산자
  // 대입 연산자 : 값을 변수에 대입하는 연산자
  // 대입당할 대상 = 대입할 대상
  $select = "sum";

  // 산술 연산자 : 사칙연산 + 나머지
  $addition = 1 + 2;
  $subtraction = 1 - 2;
  $Multiplication = 1 * 2;
  $division = 1 / 2;
  $remainder = 1 % 2;

  echo $addition, $subtraction, $Multiplication, (int)$division, $remainder; // 3, -1, 2, 0, 1

  // 산술 대입 연산자
  $temp1 = 0;          // 0

  // 산출 대입 연산자 모를 때

  $temp1 = $temp1 + 5; // 5

  // 산출 대입 연산자를 사용할 때 

  $temp1 += 5;         // 10

  $temp2 = "안녕";
  $temp2 .="하세요";
  echo $temp2; // 안녕하세요

  // $tng_num = 100
  // $tng_num에 10 더하기
  // 에 5로 나누기
  // 에 4를 빼기
  // 에 7로 나눈 나머지
  // 에 3을 곱하기 

  $tng_num = 100;
  $tng_num += 10;
  $tng_num /= 5;
  $tng_num -= 4;
  $tng_num %= 7;
  $tng_num *= 3;
  echo $tng_num; // 12

  $tng_num = ((((100 + 10)/5)-4)%7)*3;
  echo $tng_num; // 12

  // 비교 연산자

  // 크다
  var_dump(1 > 0); // true

  // 작다
  var_dump(1 < 0); // false

  // 크거나 같다
  var_dump(1 >= 0); // true

  // 작거나 같다
  var_dump(1 <= 0); // false

  // 같다(값만 같다) 불완전 비교
  $num1 = 1;
  $str1 = "1";

  var_dump($num1 == $str1); // true

  // 같다(데이터 형식까지 같다) 완전 비교

  var_dump($num1 === $str1); // false // 값은 같지만, 데이터형식이 다름

  // 같지 않다(값만 다르다) 불완전 비교

  var_dump($num1 != $str1); // false

  // 같지 않다(데이터 형식까지 다르다) 완전 비교
  var_dump($num1 !== $str1); // true

  // 논리 연산자
  var_dump(1 === 1 && 2 === 1); // false. 참 그리고 거짓 -> 거짓
  var_dump(1 === 1 || 1 === 2); // true. 참 또는 거짓 -> 참
  var_dump(!(1 === 1));         // false. 참이 나와야 하는데 Not 연산자 때문에 결과가 뒤집힘

  $three = 1===1 ? "참입니다" : "거짓입니다";
  echo $three; // 참입니다

  
?>