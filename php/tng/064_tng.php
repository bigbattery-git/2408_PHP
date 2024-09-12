<?php

// 로또 번호 생성기
// 1. 1~45 번호가 있음
// 랜덤한 번호 6개를 출력할 것
// 2.1 단, 번호는 중복되지 않는다. 
// 2.2 오름차순으로 정렬하기

// 방법 1

function getRndNumNoOverrap($startNum, $endNum, $count){
  
  $valueNum = [];
  $returnNum = [];

  for($i = 0; $i <= ($endNum - $startNum); $i++ ){
    $valueNum[$i] = $i + $startNum;
  }

  for($i = 0; $i < $count; $i++){
    $rndNumKey = random_int(0, count($valueNum));

    $returnNum[$i] = $valueNum[$rndNumKey];

    unset($valueNum[$rndNumKey]);
  }

  return $returnNum;
}

function getLottoNum(){
  $lottoNums = [];

  $lottoNums = getRndNumNoOverrap(1, 45, 6);

  sort($lottoNums);

  return $lottoNums;
}

foreach(getLottoNum() as $value ){
  echo $value."\n";
}

// 방법 2

$lottoNums = [];

for($i = 1; $i<=45; $i++){
  $lottoNums[$i] = $i;
}

$nums = array_rand($lottoNums, 6);

foreach($nums as $value){
  echo $lottoNums[$value]."\n";
}


$rememberNum = [];
$isOverlap = false;
for($i = 0; $i< 6;){
  $num = random_int(1,45);
  $isOverlap = false;

  for($j = 0 ; $j < count($rememberNum); $j++)
  if($num === $rememberNum[$j]){
    $isOverlap = true;
    break;
  }

  if($isOverlap){
    continue;
  }

  $rememberNum[$i] = $num;
  $i ++;
}

foreach($rememberNum as $value){
  echo $value."\n";
}