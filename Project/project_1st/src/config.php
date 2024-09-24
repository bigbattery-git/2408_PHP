<?php

define("MY_MARIADB_HOST", "localhost");
define("MY_MARIADB_PORT", "3306");
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "php504");
define("MY_MARIADB_NAME", "mini_board");
define("MY_MARIADB_CHARSET", "utf8mb4");

define("MY_MARIADB_DSN","mysql:host=".MY_MARIADB_HOST
                    .";port=".MY_MARIADB_PORT
                    .";dbname=".MY_MARIADB_NAME
                    .";charset=".MY_MARIADB_CHARSET);

// php Path 설정 관련

define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]); // 웹서버 document root. 지금은 아파치 서버를 말함(C/apachi24/htdocs)
// $_전부대문자 : 슈퍼 전역(Super globals) : 자주 사용해야 하는 값들을 모든 범위에서 언제나 사용할 수 있는 "내장변수"
// 종류가 좀 많음
// 진짜 자주쓰는 것 : $_GET, $_POST
// 자주 쓰는 것 : $_FILES
// 가끔 쓰는 것 : $_SERVER["DOCUMENT_ROOT"] => C:/Apachi24/htdocs/test/public 

define("MY_PATH_DB_LIB", MY_PATH_ROOT."/lib/db_lib.php");