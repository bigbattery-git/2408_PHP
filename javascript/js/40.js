// 이벤트

// 인라인 이벤트를 위한 함수
const inlineEvent = function(){
	const dom = document.createElement('h1');
	dom.textContent = "이벤트 생성됨";

	document.body.appendChild(dom);
}

const setColorBlue = (element) => element.classList.add('blueTitle');

// eventListener
const BTN_EVENTLISTENER = document.querySelector('#btn1');
BTN_EVENTLISTENER.addEventListener('click', () => {alert('이벤트리스너 이벤트 실행');}); // 이벤트리스너 삽입방법

// eventListener tng
const BTN_TOGGLE = document.querySelector('#btn_toggle');
const setColorRed = (element) => element.classList.toggle('redTitle');
BTN_TOGGLE.addEventListener('click', () => setColorRed(document.querySelector('h1')));


// removeEventListener

const del = function(){
	alert('삭제 하게 해야 함 ');
}

BTN_EVENTLISTENER.addEventListener('click', del);
BTN_EVENTLISTENER.removeEventListener('click', del); // 이벤트리스너 삭제, 이벤트 삽입할 때 무명함수가 아닌 
// 콜백함수 형식으로 넣어야 이벤트가 정상적으로 삭제됨

// 테스트용 
const TESTDOM = document.querySelector('h2');
const activeAlert = function(){
	alert('테스트용 알람');
	// TESTDOM.removeEventListener('click', activeAlert);
}
TESTDOM.addEventListener('click', activeAlert, {once : true});

const TITLE = document.querySelector('h1');

TITLE.addEventListener('mouseenter', ()=>TESTDOM.removeEventListener('click', activeAlert));

// 이벤트용 객체 : 이벤트가 실행됬을 때 자바스크립트에서 만들어주는 객체 
// 이벤트 실행 후 이벤트가가 실행된 객체의 정보를 담고 있음

const H3 = document.querySelector('h3');
H3.addEventListener('mouseup', (e) => {e.target.style.color = 'red'}); // e에 이벤트 객체가 담겨있음

// 모달창
const BTN_MODAL = document.querySelector('#btn_modal');
BTN_MODAL.addEventListener('click', ()=>{
	const MODAL = document.querySelector('.modal-container');
	MODAL.classList.remove('display-none');
})
const BTN_MODALCLOSE = document.querySelector('#btn_close');
BTN_MODALCLOSE.addEventListener('click', ()=>{
	const MODAL = document.querySelector('.modal-container');
	MODAL.classList.add('display-none');
})

// 팝업

const NAVER = document.querySelector('#naver');
NAVER.addEventListener('click', ()=>{
	open('https://www.naver.com', '', 'width=500 height=500'); // open('url', 창을 여는 위치, 옵션);
})