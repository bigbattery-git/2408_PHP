<?php
  // 변수 (Variable)
  $head = 2;

  echo "$head * 1 = 2\n";
  echo "$head * 2 = 4\n";
  echo "$head * 3 = 6\n";
  echo "$head * 4 = 8\n";
  echo "$head * 5 = 10\n";
  echo "$head * 6 = 12\n";
  echo "$head * 7 = 14\n";
  echo "$head * 8 = 16\n";
  echo "$head * 9 = 18\n\n";

  // 변수 값을 담아서 출력하시오
  /**
   * 점심메뉴
   * 탕수육 8,000
   * 짜장면 6,000
   * 짬뽕 6,000
   */

  $title = "점심메뉴";
  $price_tang = "탕수육 8,000";
  $price_jjajang = "짜장면 6,000";
  $price_jjampong = "짬뽕 6,000";

  echo "$title\n$price_tang\n$price_jjajang\n$price_jjampong";

  // 변수 스왑 : 변수 A와 변수 B의 값을 서로 바꾼다는 거임

  $num1 = 10;
  $num2 = 20;
  $temp;

  $temp = $num2;
  $num2 = $num1;
  $num1 = $temp;
  // $num2 = $num1  -> 이렇게 하면 num2랑 num1이 같아짐
  // 임시 변수 만들어서 거기에 넣고 스왑 해야 함

  // 데이터타입
  // 정수 int
  $int = 0;
  var_dump($int); // int(0)

  // 실수 float, double
  $double = pi();
  var_dump($double); // double(3.1415926535898)

  // 문자열 string
  $str = "가나다";
  var_dump($str); // string(9) "가나다"

  // 논리 boolean
  $bool = true;
  var_dump($bool); // bool(true)

  // null  값 없음
  $null = null;
  var_dump($null); // NULL

  // 배열 array
  $arr = [1,2,3];
  var_dump($arr); 
  /** array(3) {
    * [0] =>
    * int(1)
    * [1] =>
    * int(2)
    * [2] =>
    * int(3)
    * } 
  */

  // 객체 object
  $obj = new DateTime();
  var_dump($obj);
  /** class DateTime#1 (3) {
    *  public $date =>
    *  string(26) "2024-09-10 11:53:08.327400"
    *  public $timezone_type =>
    *  int(3)
    *  public $timezone =>
    *  string(10) "Asia/Seoul"
    *  }
  */

   // 형변환
  $int = 0;
  $casting = (string)$int;
  var_dump($casting); // string(1) "0"
?>