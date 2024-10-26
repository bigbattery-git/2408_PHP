<?php


// 일반적으로 네임스페이스 이름은 경로를 적어주는 것
namespace PHP\oop;

abstract class Mammal{
  protected $name;
  protected $residence;

  public function __construct($name, $residence){
    $this->name = $name;
    $this->residence = $residence;
  }

  abstract public function printInfo();
  public abstract function action();
}

// class Mammal{
//   private $name;
//   private $residence;

//   public function __construct($name, $residence){
//     $this->name = $name;
//     $this->residence = $residence;
//   }

//   public function printInfo(){
//     return $this->name."(이)가 ".$this->residence."에 삽니다.";
//   }

//   public function action(){
//     return "행동합니다.";
//   }

//   public final function stopOverride(){
//     "오버라이딩을 못하게 막아버림";
//   }
// }