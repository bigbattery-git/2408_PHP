// 0. div 박스는 무작위 위치로 이동해야 함

(()=>{
	// 1. 버튼 클릭 시 alert
	// 안녕하세요 숨어있는 div를 찾아주세요
	const BTN_INTRO = document.querySelector('#introduce');
	BTN_INTRO.addEventListener('click', () => alert('안녕하세요. \n숨어있는 div를 찾아주세요'));

	// 2번 영역
	const HIDDENDIV = document.querySelector('#hiddenDiv');
	HIDDENDIV.addEventListener('mouseenter', callDokiDoki);

	// 3, 4, 5, 6번 영역
	const COREDIV = document.querySelector('#hiddenDiv > .hidden-core');
	COREDIV.addEventListener('click', onClickCoreDiv);

	setHiddenDivNewPosition(HIDDENDIV);
})();

//#region 함수 부분
function setHiddenDivNewPosition(){
	const HIDDENDIV = document.querySelector('#hiddenDiv');

	let rndPosX = Math.random() * (window.innerWidth - HIDDENDIV.offsetWidth);
	let rndPosY = Math.random() * (window.innerHeight - HIDDENDIV.offsetHeight);

	HIDDENDIV.style.top = `${rndPosY}px`;
	HIDDENDIV.style.left = `${rndPosX}px`;
}

// 2. 숨어있는 div에 마우스가 enter하면 아래메시지 alert
// 두근두근
function callDokiDoki(){
	alert('두근두근');
}

function onClickCoreDiv(){
	// 3 숨어있는 div를 마우스로 click하면 
	// 3.1 메시지 alret '들켰다'
	// 3.2 div 나타나기
	// 3.3 더이상 '두근두근' alret 안뜸
	const HIDDENDIV = document.querySelector('#hiddenDiv');
	const COREDIV = document.querySelector('#hiddenDiv > .hidden-core');

	if(COREDIV.classList.contains('hidden-div')){
		alert('들켰다');
		HIDDENDIV.classList.remove('hidden-div');
		COREDIV.classList.remove('hidden-div');
		HIDDENDIV.removeEventListener('mouseenter', callDokiDoki);
	}

	// 4. 나타난 div를 다시 click하면
	// 4.1 메시지 alret '숨는다'
	// 4.2 div 숨기기
	else{
		alert('숨는다');
		HIDDENDIV.classList.add('hidden-div');
		COREDIV.classList.add('hidden-div');
		// 6. 다시 숨었을 때 도키도키해야함
		HIDDENDIV.addEventListener('mouseenter', callDokiDoki);
		// 5. 다시 숨을 때 랜덤한 위치로 이동
		setHiddenDivNewPosition(HIDDENDIV);
	}
}
//#endregion