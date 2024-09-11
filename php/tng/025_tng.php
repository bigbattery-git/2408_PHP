<?php

  // 1등 금상, 2등 은상, 3등 동상, 4등 장려상, 기타 노력상

  $ranking = 1;
  $medal;
  switch($ranking){
    case 1:
      $medal = "금상";
      break;
    case 2:
      $medal = "은상";
      break;
    case 3:
      $medal = "동상";
      break;
    case 4:
      $medal = "장려상";
      break;
    default:
      $medal = "노력상";
      break;
    }

  echo "당신의 순위는 ".$ranking."입니다. \n".$medal."을 수상합니다."; 