<?php

class Single{

  private function __construct(){}

  public static function GetInstance(){
    
    return $this::class;

  }
}