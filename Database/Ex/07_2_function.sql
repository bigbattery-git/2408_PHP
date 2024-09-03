SELECT 1234, CAST(1234 AS CHAR(4)), CONVERT(1234, CHAR(4))

-- if(수식, 참일 때 결과, 거짓일 때 결과)
-- 수식의 참, 거짓에 따라 결과를 분기하는 함수

SELECT employees.emp_id, gender, if(gender = 'M', '남자', '여자') AS ko_gender
FROM employees
;

SELECT emp_id, fire_at, IFNULL(fire_at, '9999-01-01') as fire_at_not_null
FROM employees
;

SELECT employees.emp_id, gender, NULLIF(gender, 'F') AS null_or_F
FROM employees
;

-- case 체크하려는 수식
-- 	when 분기수식 1 then 결과 1
-- 	when 분기수식 2 then 결과 2
-- 	when...			 then ...
--  	else 결과4
-- end 

SELECT 
	emp_id
	,case gender
		when 'M' then '남자'
		when 'F' then '여자'
		ELSE '모름'
	END AS man_or_woman
FROM employees
;

SELECT
	emp_id
	,salaries.salary
	,case
		when salaries.salary>=40000000 then 'superman'
		when salaries.salary>=30000000 then 'man'
		when salaries.salary>=20000000 then 'average'
		ELSE 'wonder'
	END AS salary_rank
from salaries;

SELECT FORMAT(50000, 0);

SELECT RPAD('321',5,'0');

SELECT TRIM('                                    hello world!!    ') AS hello_world;

SELECT 
	TRIM(LEADING 'ab' FROM 'abcdeab')
	,TRIM(both 'ab' FROM 'abcdeab')
	,TRIM(TRAILING 'ab' FROM 'abcdeab');
	
SELECT 
	SUBSTRING('abcdef', 3, 2) AS sub;
	
SELECT
	SUBSTRING_INDEX('테스트_ABC_가나다','_',1) AS 'INDEX';
	
SELECT
	CEILING(1.5)
	, FLOOR(1.5)
	, ROUND(1.5);
	
SELECT TRUNCATE(1.2345, 2);

SELECT NOW();

SELECT DATE(NOW());

SELECT 
	ADDDATE('2024-01-01', INTERVAL 1 YEAR)
	,ADDDATE('2024-01-01', INTERVAL -1 YEAR)
	,ADDDATE('2024-01-01', INTERVAL 1 MONTH)
	,ADDDATE('2024-01-01', INTERVAL -1 MONTH)
	,ADDDATE('2024-01-01', INTERVAL 1 day)
	,ADDDATE('2024-01-01', INTERVAL -1 day);
	
SELECT SUM(salary) FROM salaries;

SELECT 
	COUNT(employees.fire_at)
	,COUNT(*)
FROM employees
;

SELECT 
	emp_id
	,salaries.salary
	,RANK() OVER(ORDER BY salaries.salary DESC) AS sal_RANK
FROM salaries
LIMIT 5; 

