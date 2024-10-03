<?php

  class Shark{

    public $name;
    public $age;
    public $description;
    // 생성자
    // 객체 생성 시 딱 한번만 실행하는 함수
    public function __construct(string $name, int $age, string $description){
      $this->name = $name;
      $this->age = $age;
      $this->description = $description;
    }

  }