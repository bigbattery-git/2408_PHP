// string

let str = '문자열입니다.';						// new String('문자열입니다');

str.length;                 					// 문자열의 길이
console.log(str.length);    					// 7

str.charAt(2);              					// 해당 index의 문자를 반환함. 음수, index의 길이를 벗어난 숫자는 ''를 반환함.
                        						// 아무 값도 안넣으면 첫 번째 문자를 반환함.
console.log(str.charAt(2)); 					// '열'

str.indexOf('열'); 								// 문자열에서 해당 문자를 찾아 첫 번째 인덱스를 반환
												// 문자열에서 해당 문자가 없으면 -1 반환
console.log(str.indexOf('열'));					// 2
console.log(str.indexOf('자열'));				// 1

str = '문자열입니다. 문자열입니다.'
console.log(str.indexOf('열', 5))				// 11. 두 번째 파라미터는 문자 찾기 시작할 위치

str = '문자열입니다.';

str.includes('열');								// 문자열에서 해당 문자가 있는지 확인
console.log(str.includes('열'));				// true
console.log(str.includes('php'));				// false

str = '문자열입니다. 문자열입니다.';
str.replace('문자열', 'php');					// 첫 번째로 찾은 특정 문자열을 찾아 지정한 문자열로 치환하여 반환함
console.log(str.replace('문자열', 'php'));		// 'php입니다. 문자열입니다.'

str.replaceAll('문자열', 'php');				// 찾은 특정 문자열 전부 지정한 문자열로 치환하여 반환함
console.log(str.replaceAll('문자열', 'php'));	// 'php입니다. php입니다.'
console.log(str.replaceAll('문자열', ''));		// '입니다. 입니다'

str.substring(0, 1);							// 시작 index 부터 종료 index까지 문자열을 자른 것을 반환함
console.log(str.substring(1, 3));				// '자열'
console.log(str.substring(10));					// '자열입니다.' // 종료 index를 생략하면 끝까지 잘라서 반환함

// substr은 비표준이라 사용을 지양할 것

str.split('. ');								// 문자열을 파라미터 기준으로 잘라서 배열을 반환함.
												// 두 번째 파라미터에 값을 주면 배열의 길이에 제한을 둠. 이런경우 잘 없음 
console.log(str.split('. '));					// ['문자열입니다', '문자열입니다.']

str.trim(); 									// 좌우공백 제거. 유저가 입력하는 값에 있어서 trim 다 씀
												// 자매품 : trimEnd, trimStart

str.toUpperCase();								// 모든 소문자를 대문자로 변환
str.toLowerCase();								// 모든 대문자를 소문자로 변환 

str.padStart(18, '이것은');						// (문자열 길이, '부족하면 추가할 문자열') 문자열 길이만큼 부족하면
												// 부족한 만큼 앞에 문자열 추가함
console.log(str.padStart(17, '이것은'));		// '이것문자열입니다. 문자열입니다.'