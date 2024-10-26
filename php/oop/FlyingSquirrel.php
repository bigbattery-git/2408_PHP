<?php
namespace PHP\oop;

require_once('./Mammal.php');
require_once('./Pet.php');
// use쓰는 법
use PHP\oop\Mammal;
use PHP\oop\Pet;

class FlyingSquirrel extends Mammal implements Pet{
  public function printInfo(){
    return "룰루랄라";
  }

  public function action(){
    return parent::action()."날아댕깁니다.";
  }

  public function printPet()
  {
    return '펫입니다 찍 찍';
  }
}