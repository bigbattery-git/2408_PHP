<?php

  require_once("./Shark.php");
  // 클래스
  // 관습적으로 파일명과 클래스명을 동일하게 지어야함
  class Whale{
    // 프로퍼티
    // 클래스 내부에 만드는 변수 이름
    public $name = "김철수"; 
    private $age = 20;
    // 접근제어지시자 public, private, protected
    // 변수를 외부에서 접근하게 할 것인지 여부
    // 공통점 : Class 내부에서는 언제든 접근 가능
    // public : 외부에서 접근 가능
    // private : 외부에서 접근 불가능 
    // protected : 이 클래스를 상속한 자식 래래스들만 접근 가능

    // 메소드 (=함수)
    function breath(){
      echo "숨을 쉽니다";
    }

    function info(){
      echo "나이는 ".$this->age; //$this : class 자신. 클래스 내부에서 본인의 프로퍼티 사용할 땐 이렇게 써줘야 함

      $this->breath();
    }

    public static function myStatic(){
      echo "스테틱 메소드";
    }

    // 프로퍼티 + 변수 = 멤버
  }

  $whale = new Whale();

  // 클래스 내 메소드 사용
  $whale->breath(); // 숨을 쉽니다

  // 프로피터를 사용하는 방법
  echo $whale->name;
  echo $whale->info();

  $shark = new Shark("상어", 20, "엄청 무서운 상어");

  echo $shark->name;


  // 스테틱 맴버에 접근
  // 스태틱의 단점
  // 스태틱은 메모리가 이미 올라가있는 상황 -> 필요 없어도 메로리를 잡아먹음
  // 꼭 필요한 놈만 사용해야 함

  Whale::myStatic();