-- DB 생성
-- CREATE DATABASE Shop;

-- DB 선택
-- USE shop;

-- DB 삭제
-- DROP DATABASE shop;

-- Table 만들기
-- usertable
CREATE TABLE users(

	id					BIGINT(20)		PRIMARY KEY AUTO_INCREMENT
	,NAME    		VARCHAR(50)		NOT NULL
	,addr				VARCHAR(150)	NOT NULL
 	,gender			CHAR(1)			NOT NULL 	COMMENT 'M = 남자, F = 여자'
	,tel				VARCHAR(20)		NOT NULL		COMMENT '- 없이 숫자만'
	,created_date	TIMESTAMP		NOT NULL		DEFAULT CURRENT_TIMESTAMP()
	,updated_date	TIMESTAMP		NOT NULL		DEFAULT CURRENT_TIMESTAMP()
	,deleted_date	TIMESTAMP			 NULL    -- null 허용하는 것이 디폴트
				  			
);

CREATE TABLE products(

	id						BIGINT(20)		PRIMARY KEY AUTO_INCREMENT
	,product_name		VARCHAR(100) 	NOT NULL 
	,product_price		BIGINT(20) 		NOT NULL
	,created_date		TIMESTAMP		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_date		TIMESTAMP		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_date		TIMESTAMP			 NULL

);

CREATE TABLE orders(

	id					BIGINT(20)	PRIMARY KEY AUTO_INCREMENT 
	,user_id			BIGINT(20)	NOT NULL
	,order_id		VARCHAR(50)	NOT NULL
	,total_price	BIGINT(20) 	NOT NULL
	,created_date	TIMESTAMP	NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_date	TIMESTAMP	NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_date	TIMESTAMP		 NULL  
	
);

-- 테이블 제거
-- DROP TABLE orders;
-- 
-- DROP TABLE users,products;
-- 
-- TRUMCATE 

-- FK 추가방법

/*
	ALTER TABLE [테이블명] ADD CONSTRAINT [Constraint명] FOREIGN KEY (Constraint 부여 컬럼명)
	REFERENCES 참조테이블명(참조테이블 컬럼명) [ON DELETE 동작 / ON UPDATE 동작];
*/

-- FK를 추가하는 방법
ALTER TABLE orders ADD CONSTRAINT fk_orders_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE orders ADD CONSTRAINT fk_orders_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
--  갱신합니다. 테이블 이름 orders에 fk_orders_user_id 이름으로 제약조건을 추가합니다. 제약 조건은 user_id에 외래키를 추가하는 것입니다. 
--  외래키의 참조 컬럼명은 users의 id 컬럼입니다. 삭제 시 Cascade 하도록 합니다.

ALTER TABLE users MODIFY COLUMN addr VARCHAR(100) NOT NULL;

ALTER TABLE users ADD COLUMN birth DATE NOT NULL;

ALTER TABLE users DROP COLUMN BIRTH;

ALTER TABLE orders DROP CONSTRAINT fk_orders_user_id;

ALTER TABLE users DROP COLUMN id;

ALTER TABLE users ADD COLUMN id BIGINT(20) UNSIGNED NOT NULL;

ALTER TABLE users ADD CONSTRAINT pk_users_id PRIMARY KEY (id);

ALTER TABLE users MODIFY COLUMN id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE products MODIFY COLUMN id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE orders MODIFY COLUMN id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;