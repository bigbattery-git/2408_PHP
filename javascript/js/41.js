// 타이머 함수

// setTimeout(callback, ms) 일정 시간이 흐른 후 callback 함수 실행함
// 반환값 : setTimeout의 고유 id -> setTimeout을 지울 때 사용
setTimeout(() => {
	console.log('시간초과');
}, 5000); // 5초 뒤에 시간초과 출력

// 주의할 점
// setTimeout은 비동기처리 함수 
// 이전 setTimeout을 기다리지 않고 곧바로 다음 setTimeout 또는 다음 처리를 실행함 
// 잘 제어하도록 하자

// before
setTimeout(() =>{console.log('A');}, 1000);
setTimeout(() =>{console.log('B');}, 2000);
setTimeout(() =>{console.log('C');}, 3000);

// after
let abc = setTimeout(() => {
	console.log('a');
	setTimeout(() => {
		console.log('b'); 
		setTimeout(() => {
			console.log('c');	
		}, 1000);
	}, 2000)
}, 3000); // 콜백 지옥 callback hell
// 비동기 처리로 만들어진 로직이 있고 이를 그대로 실행할 시 발생하는 문제가 있기 때문에 이렇게 작성하는 것

// clearTimeout(timeoutID); 해당 timeoutID의 setTimeout을 제거함
clearTimeout(abc);

// setInterval(callback, ms) // 일정 시간마다 callback 실행해줌. interval id를 반환함
const INTERVAL_ID = setInterval(() => {
	console.log('인터벌');
}, 1000);

// clearInterval(id) 해당 id의 interval을 제거
clearInterval(INTERVAL_ID);