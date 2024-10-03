<?php

  // 배열(Array)
  // 변수에 여러개의 값을 넣어서 다루고 싶을 때

use function PHPSTORM_META\map;

  $arr = [4,3,6,1];

  // echo $arr[1]; // 3

  $arr[0] = "안녕하세요";
  echo $arr[0];

  // 연관배열
  $arr2 = [
    "key1" => "안녕하세요",
    "key2" => "반갑습니다",
    "key3" => "사랑합니다"
  ];

  // echo $arr2["key1"]; // 안녕하세요

  $arr2["key4"] = "안녕히계세요";
  echo $arr2["key4"];

  // 다차원 배열 : 배열안에 배열
  $arr3 =[
    [1,2,3],
    [4,5,6],
    [7,8,9]
  ];

  echo $arr3[0][1]; // 2

  // 사용예시 : DB
  $result = [
      "namer1" => [
        "id" => 10001
        ,"name" => "홍길동"
      ]
      ,"namer2" =>[
        "id" => 10002
        ,"name" => "김철수"
      ]
      ,"namer3" => [
        "id" => 10003
        ,"name" => "갑돌이"
      ]
    ];

    echo $result["namer3"]["name"];

  $arrcount=[1,3,5,8,7,5,8,7,5,2];
  echo count($arrcount); // 10

  // unset
  $arr_unset =[1,2,3,4,5,6];
  unset($arr_unset[0]);
  echo $arr_unset[0]; // Warning: Undefined array key

  // 정렬
  $arr_sort = [1,9,8,2,3,5,6,4,7];

  // 오름차순 정렬
  asort($arr_sort);

  // 내림차순 정렬
  arsort($arr_sort);

  $arr_sort_key =[
    "d" => 1
    ,"a" => 2
    ,"c" => 3
    ,"b" => 4
  ];

  ksort($arr_sort_key);