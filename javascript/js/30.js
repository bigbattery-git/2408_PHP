// date 객체

const NOW = new Date(); 				// 현재 날짜, 시간 획득 
console.log(NOW);						// '요일 월 일 년 시:분:초 GMT+NNNN (ㅇㅇ표준시)'

NOW.getFullYear();						// 연도만 가져오는 메소드(yyyy)
const YEAR = NOW.getFullYear(); 		// 2024



const setDateToKor = (day) => {
	const ARR_DAY = ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'];
	if(day >= 0 && ARR_DAY.length > day){
		return ARR_DAY[day];
	}
	else{
		return '';
	}
}

const addZeroStart = (num, length) =>{
	return String(num).padStart(length, '0');
}

// 자매품 : getYear(); => 버그남

const MONTH = NOW.getMonth() +1;		// 월을 가져오는 메소드. 0 ~ 11

const DATE = NOW.getDate();				// 일을 가져오는 메소드. 1 ~ 31

const HOUR = NOW.getHours();			// 시를 가져오는 메소드. 

const MIN = NOW.getMinutes();			// 분을 가져오는 메소드.

const SEC = NOW.getSeconds();			// 초를 가져오는 메소드. 

const MILSEC = NOW.getMilliseconds();	// 밀리초를 가져오는 메소드.

const DAY = NOW.getDay();				// 요일을 가져오는 메소드 0: 일요일, 6: 토요일. 0 ~ 6

const FORMAT_DATE = `${YEAR}-${MONTH}-${DATE} ${HOUR}:${MIN}:${SEC}.${MILSEC} ${setDateToKor(DAY)}`;

const TIME = NOW.getTime(); 			// UNIX TIMESTAMP를 반환함
										// 1970년부터 오늘까지 얼마나 지났는지 milisecond 단위로 반환

// 두 날짜의 차를 구하기. (이 데이터는 오늘 기준으로 몇 일 전 데이터인가)
const TARGET = new Date('2025-03-13 18:10:00');

const DATEDIV = 86400000
let diff_date = Math.abs(NOW - TARGET); // 1000 * 60 * 60 * 24 * 30 = 86400000
let diff_date_day = Math.floor(diff_date / DATEDIV);

// 문제. 2024-01-01 13:00:00과 2025-05-30 00:00:00은 몇 개월 차인가

const BEFOREDAY = new Date('2024-01-01 13:00:00');
const AFTERDAY = new Date('2025-05-30 00:00:00'); 

diff_date = Math.abs(BEFOREDAY - AFTERDAY);

diff_date = Math.floor(diff_date/(DATEDIV * 30));