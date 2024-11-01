/**
 * promise 객체
 * 
 * 비동기 프로그래밍의 근간
 * 비동기 작업의 최종 완료 또는 실패를 나타내는 독자적인 객체
 * 비동기 작업이 끝날 때 까지 결과를 기다리는 게 아니라 결과를 제공한다는 약속을 반환한다는 의미
 * 프로미스 사용 시 콜백함수 대체, 비동기 작업의 흐름 쉽게 제어 가능 
 * 콜백지옥에서 벗어나기 위한 대체제 
 */

// 프로미스 객체 생성 및 사용하기
// resolve : 성공했을 때 처리
// reject : 실패했을 때 처리
// 재사용성, 가독성, 확장성 등 이유로 함수로 만들어서 사용
const PRO = (str, ms) => {
	return new Promise((resolve, reject) => {
		setTimeout(() => {
			if(str === 'a'){
				resolve('성공 : A임');
			}
			else{
				reject('실패 : A아님')
			}
		}, ms);
	});
}

// 이렇게 만들 일은 거의 없음. 그냥 어떻게 쓰는건지 알고 가자.

function iAmSleepy(str, ms){
	return new Promise((resolve, reject)=>{
		setTimeout(() =>{			
			console.log(str);
			if(str === 'a' || str === 'b' || str === 'c')
				resolve(); // resolve가 실행되면 then이 실행
			else
				reject('에러임'); //  reject가 실행되면 catch가 실행
		}, ms);
	});
}

iAmSleepy('a', 3000)
.then(() => iAmSleepy('b', 2000))
.then(() => iAmSleepy('d', 1000))
.catch((e) => console.log(e));

function iAmSleep(flg){
	return new Promise((resolve, reject) => {
		if(flg)
			resolve('성공');
		else
			reject('실패');
	});
}

iAmSleep(true)
.then(data => console.log(data))
.catch(error => console.error(error))
.finally(() => console.log('finally'));