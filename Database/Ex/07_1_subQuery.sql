-- where절에서 사용하는 서브쿼리
-- D001 부서장의 이름을 출력하시오
-- 부서장 : department_managers
-- 이름 : employess
SELECT employees.emp_id
		,employees.name
FROM employees
WHERE 
	employees.emp_id = (
		SELECT department_managers.emp_id
		FROM department_managers
		WHERE department_managers.end_at IS NULL
			AND department_managers.dept_code = 'D001'
	)
;

-- 전체 부서장의 사번과 이름을 출력하시오
SELECT employees.emp_id
		,employees.name
FROM employees
WHERE 
	employees.emp_id IN (
		SELECT department_managers.emp_id
		FROM department_managers
		WHERE department_managers.end_at IS NULL
	)
;

-- 현재 직책이 부장인 사원의 사번과 이름, 생일을 출력해주세요

SELECT 
	employees.emp_id AS '사번'
	,employees.name AS '이름'
	,employees.birth AS '생일'
FROM employees
WHERE employees.emp_id IN (
	SELECT title_emps.emp_id
	FROM title_emps
	WHERE title_emps.title_code = 'T006'
		AND title_emps.end_at IS NULL
	)
;

SELECT title_emps.emp_id, title_emps.title_code
FROM title_emps
WHERE title_emps.title_code = 'T006'
	AND title_emps.end_at IS NULL
;

--  현재 D002의 부서장이 해상 부서에 소속된 날짜 출력
SELECT 
	department_managers.emp_id
	,department_managers.dept_code
FROM department_managers
WHERE 
	department_managers.end_at IS null
	AND department_managers.dept_code = 'D002'
;

--  현재 D002의 부서장이 해상 부서에 소속된 날짜 출력
SELECT department_emps.*
FROM department_emps
WHERE 
	(department_emps.emp_id, department_emps.dept_code) 
	IN (
		SELECT 
		department_managers.emp_id
		,department_managers.dept_code
		FROM department_managers
		WHERE 
			department_managers.end_at IS null
			AND department_managers.dept_code = 'D002'
	)
;

-- 사원별 평균 연봉, 사번, 이름 가져오기
SELECT 
	employees.emp_id
	,employees.name
	,(
		SELECT AVG(salaries.salary) 
		FROM salaries
		WHERE 
			employees.emp_id = salaries.emp_id
	) AS 'avg_salaries'
FROM employees
;

SELECT 
	tmp.*, qwer.* -- FROM에 서브쿼리 사용 시 AS를 써야 하는 이유
FROM (
	SELECT 
		employees.emp_id
		,employees.name
	FROM employees
) AS tmp-- 이친구는 테이블 인식을 위해
;			-- 반드시 AS를 써야 함 
			
-- 해석 : 내가 새로운 테이블을 즉석에서 만들겠다.

-- insert문에서 서브쿼리 사용
INSERT INTO employees(
	employees.name
	,employees.birth
	,employees.gender
	,employees.hire_at
	,employees.fire_at
	,employees.sup_id
	,employees.created_at
	,employees.updated_at
	,employees.deleted_at
)
VALUES(
-- 서브쿼리 넣는 부분
	(SELECT emp.NAME FROM employees AS emp WHERE emp.emp_id = 1000)
	,'2000-01-01'
	,'M'
	,DATE(NOW())
	,NULL
	,NULL
	,NOW()
	,NOW()
	,NULL
);

-- update에서 사용하기
UPDATE employees
SET 
	employees.gender = (
		SELECT emp.gender
		FROM employees as emp
		WHERE emp.emp_id = 100000 
	)
WHERE employees.emp_id = (
	SELECT MAX(emp2.emp_id)
	FROM employees AS emp2
);