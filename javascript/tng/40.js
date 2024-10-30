// 0. div 박스는 무작위 위치로 이동해야 함

const HIDDENDIV = document.querySelector('#hiddenDiv');
const COREDIV = document.querySelector('#hiddenDiv > .hidden-core')
const BTN_INTRO = document.querySelector('#introduce');


function setHiddenDivNewPosition(){
	let rndPosX = Math.random() * 1000;
	let rndPosY = Math.random() * 1000;
	const VW = window.innerWidth - 100;
	const VH = window.innerHeight - 100;

	if(rndPosX > VW){
		rndPosX = VW;
	}
	if(rndPosY > VH){
		rndPosY = VH;
	}

	HIDDENDIV.style.top = `${rndPosY}px`;
	HIDDENDIV.style.left = `${rndPosX}px`;
}

setHiddenDivNewPosition();

// 1. 버튼 클릭 시 alert
// 안녕하세요 숨어있는 div를 찾아주세요

BTN_INTRO.addEventListener('click', (e) => { alert('안녕하세요. 숨어있는 div를 찾아주세요'); console.log(e);});

// 2. 숨어있는 div에 마우스가 enter하면 아래메시지 alert
// 두근두근

function callDokiDoki(){
	alert('두근두근');
}

HIDDENDIV.addEventListener('mouseenter', callDokiDoki);

let isShowing = false;
function checkFinding(){
	// 3 숨어있는 div를 마우스로 click하면 
	// 3.1 메시지 alret '들켰다'
	// 3.2 div 나타나기
	// 3.3 더이상 '두근두근' alret 안뜸
	if(!isShowing){
		alert('들켰다');
		HIDDENDIV.classList.remove('hidden-div');
		COREDIV.classList.remove('hidden-div');
		HIDDENDIV.removeEventListener('mouseenter', callDokiDoki);
		isShowing = true;
	}

	// 4. 나타난 div를 다시 click하면
	// 4.1 메시지 alret '숨는다'
	// 4.2 div 숨기기
	else{
		alert('숨는다');
		HIDDENDIV.classList.add('hidden-div');
		COREDIV.classList.add('hidden-div');
		HIDDENDIV.addEventListener('mouseenter', callDokiDoki);
		// 5. 다시 숨을 때 랜덤한 위치로 이동
		setHiddenDivNewPosition();
		isShowing = false;
	}
}

COREDIV.addEventListener('click', checkFinding);