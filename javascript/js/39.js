// 요소 선택

// id로 요소 선택 
const TITLE = document.getElementById('title'); // document.getElementById('접근할ID'); 

// 요소 사용
// 색상 변경
TITLE.style.color = 'blue';
TITLE.style.fontSize = '4rem';

// 태그명으로 요소들을 선택하는 방법
const H1 = document.getElementsByTagName('h1'); // document.getElementsByTagName('태그이름'); 배열이 아님
H1[1].style.color = 'red';						// 요소 하나 선택해서 수정할 시. 배열처럼 접근

for(let i = 0; i<H1.length; i++)
	H1[i].style.color = 'pink';					// 요소 전체를 수정할 시

// 클래스로 요소들을 선택하는 방법
const NONE_LI = document.getElementsByClassName('none-li'); // document.getElementsByClassName('클래스이름');

// CSS 선택자를 이용해서 요소를 선택
// 현업에서 자주 쓰는 방법
// 해당하는 요소가 여러 개 있으면 가장 첫 번째 요소만 접근함

const SICK = document.querySelector('#sick'); // document.querySelector('접근자');

// 모든 요소를 접근하려면
const ALL_NONE_LI = document.querySelectorAll('li'); // 예는 foreach 쓸 수 있음
ALL_NONE_LI.forEach((a, i) => {
	if(i%2 === 0){
		a.style.color = `red`;
	}
	else{
		a.style.color = `blue`;
	}
});

// ============================================================================================
// 요소(컨텐츠, 속성 등) 조작

// 콘텐츠 조작 
TITLE.textContent = 'DOM 실습. 텍스트 컨텐츠 수정'; // 요소.textContent : 텍스트 컨텐츠가 담겨있음. 이를 수정하면, 텍스트가 수정됨
// 만약 <a>링크</a>라고 입력하게 된다면 그냥 <a>링크</a> 이런식으로 입력됨 -> 순수하게 텍스트로 입력됨

TITLE.innerHTML = '<a href = "#">DOM</a> 실습. 텍스트 수정 2'; // 요소.innerHTML : 컨텐츠가 담겨있음. 근데 태그를 전달하면 그 태그가 작동함.

// 속성 조작
const A = document.querySelector('#title > a');
A.setAttribute('href','https://www.naver.com'); // 요소.setAttribute('속성명', '속성값'); 속성 추가 및 수정하기

const 하하하하=document.querySelector('#하하하하');
하하하하.setAttribute('placeholder', '하하하하');

A.removeAttribute('href');						// 요소.removeAttribute('속성명'); 속성 제거

// 요소의 스타일링
TITLE.style.margin = '100px';					// 요소.style.속성명 = '속성값' : 인라인 스타일로 속성주기

// classList : 클래스로 스타일 추가, 및 삭제
TITLE.classList.add('class-1', 'class-2');		// 해당 태그에 클래스 추가
TITLE.classList.remove('class-1');				// 해당 태그에 클래스 제거
TITLE.classList.toggle('toggle');				// 해당 태그에 그 클래스가 없으면 추가, 있으면 제거

// 새로운 요소 생성 
const NEW_LI = document.createElement('li');	// document.createElement('태그명') 요소 생성
NEW_LI.textContent = '떡볶이';					// 새로 생성한 요소에 콘텐츠 삽입 (innerHTML도 사용가능)

const NUMS = document.querySelector('#nums');	
NUMS.appendChild(NEW_LI);						// 부모요소.appendChild(추가할요소) 해당 부모의 태그 안에 마지막 자식 태그로 추가함 

NUMS.removeChild(NEW_LI);						// 부모요소.removeChild(삭제할요소) 해당 부모의 태그 안에 선택한 자식 태그가 제거됨
												// Body 지명하면 최상위 부모

NUMS.insertBefore(NEW_LI, document.querySelector('#sick')); // 부모태그 내 자식태그 하나 기준으로 그 위에 태그를 추가하려고 할 때