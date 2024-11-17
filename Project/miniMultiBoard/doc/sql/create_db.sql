-- users table
-- pk, 이메일, 비밀번호, 이름, 가입일자, 수정일자, 탈퇴일자

-- boards table
-- pk, 유저pk, 게시판타입, 제목, 내용, 이미지파일, 작성일자, 수정일자, 삭제일자

-- boards_category table
-- pk, 게시판타입, 게시판이름, 작성일자, 수정일자, 삭제일자

CREATE DATABASE mini_multi_board;
USE mini_multi_board;

CREATE TABLE users(
	u_id 			BIGINT(30) UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,u_email		VARCHAR(100)			NOT NULL
	,u_password	VARCHAR(256) BINARY 	NOT NULL	-- 대소문자 구분 위해 BINARY 사용
	,u_name		VARCHAR(50)				NOT NULL
	,created_at	TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at	TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at	TIMESTAMP 				
);

CREATE TABLE boards(
	b_id			BIGINT(30) UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,u_id			BIGINT(30) UNSIGNED 	NOT NULL
	,bc_type		CHAR(1)				  	NOT NULL 
	,b_title		VARCHAR(50)				NOT NULL
	,b_content	VARCHAR(200)			NOT NULL
	,b_img		VARCHAR(100)			NOT NULL
	,created_at	TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at	TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at	TIMESTAMP 		
);

CREATE TABLE boards_category(
	bc_id			BIGINT(30) UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,bc_type		CHAR(1)					NOT NULL UNIQUE
	,bc_name		VARCHAR(20)				NOT NULL
	,created_at	TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at	TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at	TIMESTAMP 
);

ALTER TABLE boards ADD CONSTRAINT fk_boards_u_id FOREIGN KEY (u_id) 
REFERENCES users(u_id);

ALTER TABLE boards ADD CONSTRAINT fk_boards_bc_type FOREIGN KEY (bc_type) 
REFERENCES boards_category(bc_type);

-- 게시판 카테고리 정보 추가

INSERT INTO boards_category(bc_type, bc_name)
VALUES 	('0', '자유게시판')
,			('1', '질문게시판')
;

INSERT INTO users(u_email, u_name, u_password)
VALUES	('admin@admin.com', '관리자', 'cXdlcjEyMzQ=');

INSERT INTO boards(
u_id, 
bc_type, 
b_title, 
b_content, 
b_img )
VALUES	(
1, 
'0', 
'자유1', 
'자유내용1', 
'/View/img/nondam_f.png'
)
,			(1, '0', '자유2', '자유내용1', '/View/img/nondam_f.png')
,			(1, '0', '자유3', '자유내용1', '/View/img/nondam_f.png')
,			(1, '1', '질문1', '질문내용1', '/View/img/nondam_f.png')
,			(1, '1', '질문2', '질문내용2', '/View/img/nondam_f.png')
;


SELECT *
FROM users
WHERE u_email = :u_email
;

INSERT INTO boards_category(bc_type, bc_name)
VALUES 	('2', '문희게시판');

SELECT COUNT(*) AS cnt, bc_type
FROM boards
-- WHERE deleted_at IS NULL
GROUP BY bc_type
;

SELECT b_id, b_title
FROM boards
ORDER BY b_id
LIMIT 1
OFFSET 2
;

SELECT *
FROM boards
WHERE (b_title LIKE '%자유%' OR b_title LIKE '%질문%')  
AND deleted_at IS NULL
ORDER BY bc_type;

DROP TABLE boards_category;

SELECT boards.b_id, users.u_name, boards.bc_type, boards.b_title, boards.b_content, boards.b_img
FROM boards
JOIN users
ON users.u_id = boards.u_id
AND boards.deleted_at IS NULL
ORDER BY boards.created_at DESC, boards.b_id ASC
LIMIT 100
;

DELETE FROM boards
WHERE b_id NOT IN (1, 2, 3);