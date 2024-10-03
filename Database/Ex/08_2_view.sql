-- 사원의 사번, 이름, 현재직급명, 현재 소속 부서명, 현재 연봉 조회하는 쿼리문
SELECT employees.emp_id
		,employees.name
		,titles.title
		,departments.dept_name
		,salaries.salary
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
		AND title_emps.end_at IS NULL
		AND employees.fire_at IS NULL
	JOIN titles
		ON title_emps.title_code = titles.title_code
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id
		AND department_emps.end_at IS null
	JOIN departments
		ON department_emps.dept_code = departments.dept_code
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at IS NULL
ORDER BY employees.emp_id ASC
;

-- view 생성
CREATE VIEW view_emp_now_data 
AS
	SELECT employees.emp_id
		,employees.name
		,titles.title
		,departments.dept_name
		,salaries.salary
	FROM employees
		JOIN title_emps
			ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL
			AND employees.fire_at IS NULL
		JOIN titles
			ON title_emps.title_code = titles.title_code
		JOIN department_emps
			ON employees.emp_id = department_emps.emp_id
			AND department_emps.end_at IS null
		JOIN departments
			ON department_emps.dept_code = departments.dept_code
		JOIN salaries
			ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
	ORDER BY employees.emp_id ASC
;

-- VIEW 사용
SELECT *
FROM view_emp_now_data
;

-- VIEW 삭제
DROP VIEW view_emp_now_data;