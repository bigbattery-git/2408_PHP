<?php

  try{
    
    // 에러 또는 예외가 발생할 수 있는 소스코드 작성
    5/0;
    echo "try";
  }
  catch(Throwable $th){
    // try문에서 예외, 에러 발생 시 작동하는 소스코드
    echo $th." \n";
  }
  finally{
    echo "finally";
  }