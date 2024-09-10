<?php

  // 조건문

  $value = 5;
  if($value === gettype(5)){ // 거짓
    echo "value는 10입니다.";
  }
  else if($value > 10){ // 거짓
    echo "value는 10보다 큽니다";
  } // 조건이 더 있으면 조건 더 추가해도 괜찮음
  else{
    echo "value는 10도 아니고, 10보다 크지도 않습니다."; // 출력
  }

  // 1등은 1등 ~ 3등은 3등, 5등은 특별상, 그 외에는 순위외
  $rank = 2;

  if($rank === 1){
    echo "당신은 1등입니다. 축하합니다!";
  }
  else if($rank === 2){
    echo "당신은 2등입니다. 홍진호입니다!\n당신은 2등입니다. 홍진호입니다!";
  }
  else if($rank === 3){
    echo "당신은 3등입니다. 장려상입니다!";
  }
  else if($rank === 5){
    echo "당신은 5등입니다. 특별상입니다!";
  }
  else{
    echo "당신은 순위권 밖입니다. 다음에는 더 잘할 수 있습니다!";
  }


  // IF로 만들어주세요.
// 성적
// 범위 :
//      100   : A+
//      90이상 100미만 : A
//      80이상 90미만 : B
//      70이상 80미만 : C
//      60이상 70미만 : D
//      60미만: F
// 출력 문구 : "당신의 점수는 XXX점 입니다. <등급>"

  $score = 75;
  $rank;
  if($score === 100){
    $rank = "A+";
  }
  else if(90 <= $score){
    $rank = "A";
  }
  else if(80 <= $score){
    $rank = "B";
  }
  else if(70 <= $score){
    $rank = "C";
  }
  else if(60 <= $score){
    $rank = "D";
  }
  else{
    $rank = "F";
  }
  
  echo "당신의 점수는".$score."점 입니다. <$rank>";
?>