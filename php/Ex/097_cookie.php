<?php

// 쿠키 생성
setcookie('test_cookie','yammy', time() + 3600); // setcookie('key','value', time);

// 쿠키 값 사용 
echo $_COOKIE['test_cookie']; // $_COOKIE['cookie key'];

// 쿠키 삭제
setcookie('test_cookie', '', 0); // setcookie('key', 'value', -1);