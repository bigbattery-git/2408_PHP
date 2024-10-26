<?php
namespace PHP\oop;

require_once('./Mammal.php');
require_once('./Swim.php');

use PHP\oop\Mammal;
use PHP\oop\Swim;

class Whale extends Mammal implements Swim{
  public function printInfo(){
    return "이 고래의 이름은 ".$this->name."이고, 사는 곳은 ".$this->residence."입니다!";
  }

  public function action(){
    return "수영합니다.";
  }

  public function swimming(){
    return "수우우우우우우여어어어어엉하아아아ㅂ니이이이이이이다아아아아아아";
  }
}


// abstract class Animal{
//   abstract function breath();
//   abstract function getInfo();
//   abstract function move();
// }

// class Whale extends Animal{
//   // 프로퍼티
//   private $name;
//   private $age;

//   public function __construct(string $name, int $age){
//     $this->name = $name;
//     $this->age = $age;
//   }

//   // 메서드
//   public function breath(){
//     return $this->name."은(는) 숨을 쉽니다.";
//   }

//   public function getInfo(){
//     return "EI의 이름은".$this->name."이구요.\n나이는 ".$this->age."에요!\n";
//   }

//   public function move(){
//     return $this->name."은 움직이고 있습니다.\n";
//   }

//   public static function shout(){
//     echo "크아앙!!";
//   }

//   // getter
//   public function getName(){return $this->name;}
//   public function getAge(){return $this->age;}

//   // setter
//   public function setName($name){return $this->name = $name;}
//   public function setAge($age){return $this->age = $age;}
// }

// Whale::shout();