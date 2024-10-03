-- index 확인
SHOW INDEX FROM employees;

-- index 성능 확인
SELECT *
FROM employees
WHERE NAME = '주정웅';

-- index 생성
ALTER TABLE employees
	ADD INDEX idx_employees_name (NAME);
	
-- index 제거 
DROP INDEX idx_employees_name ON employees;