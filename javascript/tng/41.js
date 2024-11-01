//#region 두둥둥장

// 1. html 건들지 말 것
(()=>{
	(() =>{
		// 2. 두둥둥장을 띄우기
		const 두둥둥장 = document.createElement('h1');
		두둥둥장.textContent = '두둥둥장';
		두둥둥장.classList.add('red');
		두둥둥장.style.fontSize = '10rem';
		두둥둥장.style.textAlign = 'center';
		document.body.appendChild(두둥둥장);
	
		// 3. 빨파빨파
		const 두둥둥장INTERVAL_ID = setInterval(() => {
			두둥둥장.classList.toggle('blue');
		}, 10);
	})();
	(() => {
		const 윙크 = document.createElement('h1');
		윙크.textContent = "(●'◡'●)";
		윙크.style.fontSize = '10rem';
		윙크.style.textAlign = 'center';
		document.body.appendChild(윙크);

		const 윙크INTERVAL_ID = setInterval(() =>{
			윙크.textContent = 윙크.textContent === "(●'◡'●)" ? "(●'▽'●)" : "(●'◡'●)";
		}, 500);
	})();
});
//#endregion

//#region 현재시간 출력하기
// 현재시간 출력하기 
// 멈춰 누르면 시간 멈춰야 함
// 재시작 누르면 시간 재시작 되야 함

(()=>{
	// 노드 가져오기
	const NOWTIME = document.querySelector('#nowTime');
	const BTN_STOP = document.querySelector('#btn_stop');
	const BTN_RESTART = document.querySelector('#btn_restart');
	const BTN_RECORD = document.querySelector('#btn_record');
	const BTN_RESET = document.querySelector('#btn_reset');
	const UL = document.querySelector('ul');

	// 타이머 실행
	NOWTIME.textContent = getCurrentTime();
	let interval_ID = setInterval(() => {
		NOWTIME.textContent = getCurrentTime();
		}, 500);

	// 이벤트 할당
	BTN_STOP.addEventListener('click',() => {clearInterval(interval_ID); interval_ID = null;});
	BTN_RESTART.addEventListener('click',()=>{
		if (interval_ID) return;

		NOWTIME.textContent = getCurrentTime();
		interval_ID = setInterval(() => {
						NOWTIME.textContent = getCurrentTime();
						}, 500);
	});

	BTN_RECORD.addEventListener('click', () => {
		UL.innerHTML += `<li>${UL.childElementCount + 1}번째 : ${getRecordTime()}</li>`;
	});

	BTN_RESET.addEventListener('click', () => {
		UL.innerHTML = "";
	});
})();

//#endregion

//#region 타이머 만들기
(()=>{
	const STOPWATCH_TIME=document.querySelector('#stopwatch_time');
	const BTN_STOPWATCH_START = document.querySelector('#btn_stopwatch_start');
	const BTN_STOPWATCH_STOP = document.querySelector('#btn_stopwatch_stop');
	const BTN_STOPWATCH_RECORD = document.querySelector('#btn_stopwatch_record');
	const BTN_STOPWATCH_RESET = document.querySelector('#btn_stopwatch_reset');
	const UL_STOPWATCH_RECORD = document.querySelector('#ul_stopwatch_reset');
	const FLOW_TIME = 10;
	
	let currentTime = 0;
	let stopwatchIntervalId = null;
	const setTIMETextContent = () => STOPWATCH_TIME.textContent = getMsToFormatTime(currentTime);
	setTIMETextContent();

	BTN_STOPWATCH_START.addEventListener('click', ()=>{
		if(stopwatchIntervalId) return;

		stopwatchIntervalId = setInterval(() => {
			currentTime += FLOW_TIME;
			setTIMETextContent();
		}, FLOW_TIME);
	});

	BTN_STOPWATCH_STOP.addEventListener('click', ()=>{
		clearInterval(stopwatchIntervalId);
		stopwatchIntervalId = null;
		setTIMETextContent();
	});

	BTN_STOPWATCH_RECORD.addEventListener('click', () => {
		if(!stopwatchIntervalId) return;
		UL_STOPWATCH_RECORD.innerHTML += `<li>${UL_STOPWATCH_RECORD.childElementCount +1}번 : ${getMsToFormatTime(currentTime)}</li>`
	});

	BTN_STOPWATCH_RESET.addEventListener('click', () =>{
		clearInterval(stopwatchIntervalId);
		stopwatchIntervalId = null;
		currentTime = 0;
		setTIMETextContent();
		UL_STOPWATCH_RECORD.innerHTML = '';
	});
})();

//#endregion

//#region 함수
// 현재 시간 가져오기
function getCurrentTime(){
	const NOW = new Date();

	const HOUR = String(NOW.getHours() > 12 ? NOW.getHours() - 12 : NOW.getHours()).padStart(2,'0');
	const MIN = String(NOW.getMinutes()).padStart(2,'0');
	const SEC = String(NOW.getSeconds()).padStart(2,'0');
	const AMPM = NOW.getHours() >= 12 ? '오후' : '오전';

	return `현재 시간 ${AMPM} ${HOUR}:${MIN}:${SEC}`;
}

function getRecordTime(){
	const NOW = new Date();

	const HOUR = String(NOW.getHours() > 12 ? NOW.getHours() - 12 : NOW.getHours()).padStart(2,'0');
	const MIN = String(NOW.getMinutes()).padStart(2,'0');
	const SEC = String(NOW.getSeconds()).padStart(2,'0');
	const AMPM = NOW.getHours() >= 12 ? '오후' : '오전'; 

	return `${AMPM} ${HOUR}:${MIN}:${SEC}`;
}

function getMsToFormatTime(milisec){
	if(milisec <0) milisec = 0;

	let hour;
	let min;
	let sec;
	let ms;

	sec = Math.floor(milisec /  5000);
	min = Math.floor(milisec /  5000 * 60);
	hour = Math.floor(milisec /  5000* 60 * 60);
	ms = milisec;

	if(ms >= 5000){
		ms -= Math.floor(ms / 5000) * 5000;
		sec += Math.floor(ms / 5000);
	}

	if(sec >= 60){
		sec -= Math.floor(sec / 60) * 60;
		min += Math.floor(sec / 60);
	}

	if(min >= 60){
		min -= Math.floor(min/60) * 60;
		hour += Math.floor(min / 60);
	}

	return `${hour} : ${formatTimes(min, 2)} : ${formatTimes(sec, 2)} : ${formatTimes(ms, 3)}`;
}

function formatTimes(time, count){
	return String(time).padStart(count, '0');
}

//#endregion