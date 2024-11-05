<?php

// 클래스를 객체화 하기 직전에 실행됨
spl_autoload_register(function($path){
	require_once(str_replace("\\", "/", $path.".php")); // path에 있는 역슬래시 \를 슬래시 /로 바꿈
});