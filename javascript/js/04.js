// 변수
// var : 중복선언 O, 재할당 O, 함수레벨 스코프 
var num1 = 1;
var num1 = 2; // 중복 선언 중
num1 = 3;     // 재할당 중
// num = 0;      // 만약 var, let 등 키워드 안적어주면 자동으로 var로 할당됨. 주의할 것

// let : 중복선언 X, 재할당 O, 블록레벨 스코프
let num2 = 2;
// let num2 = 3; // 중복선언 X 
num2 = 3;     // 재할당 중

// const : 상수. 중복 X, 재할당 X, 블록레벨 스코프
const NUM3 = 3;

console.log(NUM3);

// ---------------------------------------------------
// 스코프 : 변수, 함수를 사용할 수 있는 범위 

// 전역레벨 : 어디서든 접근할 수 있는 영역. 전역변수
let globalScope = '전역변수';
function printGlobal(){
	console.log(globalScope);
}

// 지역레벨 : 함수, 객체 영역에서만 사용가능한 변수, 함수 
function printLocal(){
	let localScope = "지역변수";
	console.log(localScope);
}

// 블록레벨 : 중괄호 단위에서 사용가능한 변수, 함수
function printBlock(){
	if(true)
	{
		var test1 = 'var';
		let test2 = 'let';
		const TEST3 = 'const';
	}

	console.log(test1);
	console.log(test2);
	console.log(TEST3);
}

// -----------------------------------------------------------
// 호이스팅 : 변수, 함수를 알아서 미리 선언하는 것
// 문제점 : var에서 발생함

// console.log(test);
// test = 'aaa';
// console.log(test);
// let test;

// 데이터타입 

// 숫자 : number
let num = 1;
console.log(typeof(num));

let str1 = 'aaa';
let str2 = 'aaa';