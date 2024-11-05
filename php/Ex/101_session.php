<?php

// 세션 시작 전에 항상 최상단에 session_start() 실행해야 함
// 절때 세션 시작 전에 echo, printf 등 금지
// 출력하게 되면 유저에게 반응하게 되버려서 세션 사용 안됨 
session_start(); 

// 세션 key에 value 저장
$_SESSION['id'] = '햄버거';		// $_SESSION['key'] = 'value';

echo $_SESSION['id'];

// 세션 제거
unset($_SESSION['id']);			// unset($_SESSION['key']); 배열 value 제거하듯

if(isset($_SESSION['id'])){
	echo $_SESSION['id'];
}
else{
	echo '세션 삭제됨';
}

session_destroy();					// 세션 안쓸땐 꼭 session_destroy()로 세선 끝내자