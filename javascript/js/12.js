// console.log(함수명(1, 2));

// function 함수명(하나, 둘) {
//   return 하나 + 둘;
// }

// console.log(함수명(1,2)); //3

// const 함수명 = function(매개변수1, 매개변수2){
//   return 매개변수1 + 매개변수2;
// }

// console.log(함수명(1, 2));

// 즉시실행 함수 

const 함수명 = (function(파라미터1, 파라미터2){
  return 파라미터1 + 파라미터2
})(1,2);

function pool(){
  console.log('바보당');
}

// 콜백 함수
/**
 * 걷는 사람한테 바보라고 하는 함수
 * @param {console.log 있는 함수} execute 
 * @param {boolean} flg1 
 * @param {boolean} flg2 
 */
function 걷기(execute, flg1, flg2){

  if(flg1){
    execute();
  }
}

걷기(pool, true, false);