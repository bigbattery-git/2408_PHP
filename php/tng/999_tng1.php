<?php

/**
 * @param int $num to matrix num
 */
function get_matrix_table(int $num){

  for($i = 1; $i <= 9; $i++ ){
    echo $num." X ".$i." = ".$num * $i."\n";
  }
  echo "\n";

}

for($i = 2; $i <= 9; $i++){
  get_matrix_table($i);
}

// ---------------------------------------------------------------------------------------------------------------------------

function sum(int $a = 0, int $b = 0) : int{
  return $a + $b;
}

// ----------------------------------------------------------------------------------------------------------------------------

// try{

// } 
// catch(Throwable $th){
//   echo $th -> getMessage();
// }
// finally{
//   echo "예외 발생?";
// }

// echo "\n처리 종료";

try{
  echo "outside try";

  try{
    echo "inside try";
  }
  catch(Throwable $tr){
    echo "inside catch";
  }
}
catch(Throwable $th){
  echo "outside catch";
}

try{
  throw new Exception("");
}

catch(Throwable $th){
  echo "echo";
}