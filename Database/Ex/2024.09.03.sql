-- 사원별 평균 연봉, 사번, 이름 가져오기

SELECT employees.emp_id, employees.name
	,(
		SELECT AVG(salaries.salary)
		FROM salaries
		WHERE employees.emp_id = salaries.emp_id
	)AS '평균연봉'
FROM employees
;

-- 직원의 emp_id, 이름을 가져오시오

SELECT emp.*
FROM (
	SELECT employees.emp_id, employees.name
	FROM employees
)AS emp
;

-- 현재 근무중인 매니저들의 이름과 부서이름, 현재 급여를 가져오시오
SELECT employees.name, departments.dept_name, salaries.salary
FROM employees
	JOIN department_managers -- 매니저
		ON employees.emp_id = department_managers.emp_id
	JOIN departments -- 부서이름
		ON department_managers.dept_code = departments.dept_code
	JOIN salaries -- 급여
		ON salaries.emp_id = employees.emp_id
WHERE department_managers.end_at IS NULL
	AND salaries.end_at IS NULL
;

-- 매니저들의 사번과 이름, 직급코드를 가져오시오 
SELECT employees.emp_id, employees.name, department_managers.dept_code
FROM employees
	LEFT JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
ORDER BY department_managers.dept_code DESC
;

-- 슈퍼바이저의 정보를 가져오시오
SELECT emp2.* 
FROM employees AS emp1
	JOIN employees AS emp2
		ON emp1.emp_id = emp2.sup_id
;

SELECT *
FROM employees
WHERE employees.emp_id = employees.sup_id
;