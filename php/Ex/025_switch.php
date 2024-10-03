<?php
  // switch문
  $food = "햄버거";
  $genre;
  switch($food){
    case "짜장면":
      $genre = "중식";
      break;
    case "떡볶이":
      $genre = "한식";
      break;
    case "햄버거":
      $genre = "양식";
      break;
    default:
      $genre = "영국음식";
      break;
  }

  echo $food."의 음식장르는 ".$genre."입니다."; // 햄버거의 음식장르는 양식입니다.