-- FK 제약조건 때문에 삭제가 안됨

DELETE FROM employees
WHERE emp_id = 1;

-- Trigger을 이용하여 하위 데이터 우선으로 삭제되게끔 하기

-- 트리거 생성
DELIMITER $$

CREATE TRIGGER del_emp
BEFORE DELETE 
	ON employees
FOR EACH ROW
BEGIN 
	DELETE FROM department_emps WHERE emp_id = OLD.emp_id;
	DELETE FROM department_managers WHERE emp_id = OLD.emp_id;
	DELETE FROM salaries WHERE emp_id = OLD.emp_id;
	DELETE FROM title_emps WHERE emp_id = OLD.emp_id;
END $$ 	

DELIMITER ;


Delimiter $$

CREATE TRIGGER 트리거_이름
BEFORE 행동
	ON 테이블명
FOR EACH ROW -- 하위 모든 열에게 적용 
BEGIN
	행동할 시 실행할 쿼리들 작성;
END

delimiter;

-- 트리거 덕분에 이제 실행 됨
DELETE FROM employees
WHERE emp_id = 1;

SHOW TRIGGERS;