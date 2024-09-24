CREATE DATABASE IF NOT EXISTS mini_board; -- if not exists DB명 : 그 DB가 존재하지 않으면,

USE mini_board;

DROP TABLE if EXISTS board;

CREATE TABLE board(

	id  		  	BIGINT(30) UNSIGNED PRIMARY KEY AUTO_INCREMENT
	,title 	  	VARCHAR(50) 		  NOT NULL
	,content 	VARCHAR(1000) 		  NOT NULL
	,created_at TIMESTAMP 			  NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP 			  NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP 
	
);