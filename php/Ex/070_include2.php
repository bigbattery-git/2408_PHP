<?php

  // 다른 파일의 소스코드 불러오기

  // include
  include("./070_include1.php");      // 해당 파일을 불러옴 (중복 작성 할 시 여러번 불러옴)

  include_once("./070_include1.php"); // 해당 파일을 불러옴 (중복 작성해도 한 번만 불러옴)

  require("./070_include1.php");      // 해당 파일을 불러옴 (중복 작성 할 시 여러번 불러옴, 오류 발생 시 에러 후 종료)

  require_once("./070_include1.php"); // 해당 파일을 불러옴 (중복 작성해도 한 번만 불러옴, 오류 발생 시 에러 후 종료)
  
  echo "include 2 \n";