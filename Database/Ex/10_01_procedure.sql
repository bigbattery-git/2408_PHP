-- 프로지서 생성
DELIMITER $$

CREATE PROCEDURE add_emp(
IN param_name VARCHAR(50)
	,param_birth VARCHAR(10)
	,param_gender CHAR(1))
BEGIN
	DECLARE cup INT;

	 INSERT INTO employees(
	 	NAME
	 	,birth
	 	,gender
	 	,hire_at
	 )
	 VALUES(
		 param_name
		 ,param_birth
		 ,param_gender
		 ,DATE(NOW())
	 );
	 	 
	 SELECT emp_id
	 INTO cup
	 FROM employees
	 ORDER BY emp_id DESC
	 LIMIT 1
	 ;
-- 	 급여테이블 데이터 작성
	INSERT INTO salaries(
		emp_id
		,salary
		,start_at
	)
	
	VALUES (
		cup
		,25000000
		,DATE(NOW())
	);
	 
END $$

DELIMITER ;

-- 프로시저 실행
CALL add_emp('엠마왓수', '2000-01-01', 'M');

-- 프로시저 삭제
DROP PROCEDURE add_emp;