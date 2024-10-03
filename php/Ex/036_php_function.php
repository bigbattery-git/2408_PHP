<?php

  // php 내장함수

  // trim(문자열) : 공백제거
  $str1 = "       유원상         ";
  echo trim($str1); // 유원상

  // strtoupper(문자열), strtolower(문자열) 문자열을 대문자, 소문자로 변환
  $strUpper = "abCde";
  echo strtoupper($strUpper)."\n"; // ABCDE

  $strLower = "ABcdE";
  echo strtolower($strLower); // abcde

  // strlen(문자열); // 영어 숫자 간단한_특수기호를 인식하여 문자열의 길이를 알려줌 (한글 인식 X). 잘 안씀
  // mb_strlen(문자열); //한글 포함 모든 글씨들을 인식해서 문자열의 길이를 알려줌
  $stringLen = "다람쥐헌챗바퀴에타고파";

  echo strlen($stringLen)."\n"; // 33
  echo mb_strlen($stringLen); // 11

  // str_replace(바꾸고싶은_문자열, 바꿀_문자열, 문자열) : 특정 문자를 치환하여 반환함

  $rep = "key: qq1w98189149q1w981f";
  echo str_replace("key: ", "", $rep);

  // mb_substr(대상문자열, 자를개수, 출력할_개수) : 문자열을 잘라서 반환

  $substr = "php입니다.";
  echo mb_substr($substr, 3, 2); // 입니

  $substr = "php입니다.";
  echo mb_substr($substr, -3, 4); // 니다

  // mb_strpos(문자열, 검색할_문자열) : 검색할 문자열의 특정 위치를 반환함
  $strpos = "점심 뭐먹지?";
  
  echo mb_substr($strpos, mb_strpos($strpos, "뭐"), 4); // 뭐먹지?

  echo mb_strpos($strpos, "뭐"); // 3

  // sprintf(포맷문자열, 대입문자열1, 대입문자열2, ...) : 포맷 문자열에 대입문자열(들)을 순서대로 대입해서 반환함
  // 연결연산자 등을 사용할 때 발생하는 번거로움과 가독성 문제를 해결하기 위해 상당히 자주 많이 대부분 사용함

  $str_format = "당신의 점수는 %u점입니다. <%s>";

  echo sprintf($str_format, 50, "F");

  // isset(변수) : 변수가 설정되어 있는지 확인 후 boolean값으로 반환함

  $str_setting = "";
  $str_nosetting = null;

  var_dump(isset($str_setting)); // bool(true)
  var_dump(isset($str_nosetting)); // bool(false)
  var_dump(isset($no)); // bool(false)

  // empty(변수) : 변수에 값이 비어있는지 확인 후 boolean값으로 반환함
  $empty1 = "abc";
  $empty2 = "";
  $empty3 = 0;
  $empty4 = [];
  $empty5 = null;

  var_dump(empty($empty1)); // bool(false)
  var_dump(empty($empty2)); // bool(true)
  var_dump(empty($empty3)); // bool(true)
  var_dump(empty($empty4)); // bool(true)
  var_dump(empty($empty5)); // bool(true)

  // is_null(변수) : 변수가 null인지 아닌지 확인 후 true/false 반환

  $chk_null = null;

  var_dump(is_null($chk_null)); // bool(true)

  $chk_null = 12345;

  var_dump(is_null($chk_null)); // bool(false)

  // gettype(변수) : 변수의 데이터 형식을 문자열로 반환함

  $typeStr = "abc";
  $typeInt = 0;
  $typeFloat = 1.2;
  $typeArr = [];
  $typeBoolean = true;
  $typeNull = null;
  $typeObj = new DateTime();

  echo gettype($typeStr)."\n";     // string
  echo gettype($typeInt)."\n";     // integer
  echo gettype($typeFloat)."\n";   // double
  echo gettype($typeArr)."\n";     // array
  echo gettype($typeBoolean)."\n"; // boolean
  echo gettype($typeNull)."\n";    // NULL
  echo gettype($typeObj)."\n";     // object

  // settype(변수, "데이터_형식") : 변수의 데이터 형식을 변환, 일단 반환값은 boolean
  // (casting)과의 차이
  // (casting) : 캐스팅 할 때만 바꿈 -> 원본은 바꾸지 않음
  // settype : 원본 자체를 바꿔버림

  $castTarget = "1";
  var_dump((int)$castTarget);            // int(1)
  var_dump($castTarget);                 // string(1) "1"

  var_dump(settype($castTarget, "int")); // bool(true)
  var_dump($castTarget);                 // int(1)

  // time() : 현재시간을 반환 (타임스탬프 초단위)
  // 타임스탬프 : MariaDB의 그 TimeStamp
  echo time(); // 1726109011 -> 1970년 1월 1일로부터 1726109011초 지남

  // date(시간포멧, 타임스탬프값) : 시간 포맷 형식으로 문자열 반환함
  echo date("Y-m-d H:i:s", time()); // 2024-09-12 11:48:44

  // ceil(변수), round(변수), floor(변수) : 올림, 반올림, 버림

  $flo = 1.5;

  echo ceil($flo);  // 2
  echo round($flo); // 2
  echo floor($flo); // 1

  // random_int(시작값, 끝값) : 시작값부터 끝깞까지의 난수 반환 (시작값 이상 ~ 끝깞 이하)
  echo random_int(1, 10); // 6, 8, 9, 5, 4