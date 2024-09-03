-- JOIN문
-- 두 개 이상의 테이블을 묶어서 하나의 결과 집합으로 출력

-- INNER JOIN
-- 두 테이블이 공통적으로 만족하는 레코드를 출력(교집합)

-- 사원번호emp_id, 이름name, 소속부서코드dept_code를 출력하라
-- 사용법 1
SELECT employees.emp_id, employees.name, departments.dept_code
FROM employees -- 메인이 될 테이블
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id -- 반드시 테이블 이름 적어줘야함
WHERE
	department_emps.end_at IS NULL
;	

-- 사용법2
SELECT employees.emp_id, employees.name, department_emps.dept_code
FROM employees -- 메인이 될 테이블
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id -- 반드시 테이블 이름 적어줘야함, 묶어줄 테이블 컬럼이 무엇인가
		AND department_emps.end_at IS NULL -- on : join으로 묶을 때 어떤걸 묶을 것인가
;

-- 사원번호emp_id, 이름name, 소속부서코드dept_code, 부서명을 출력하라

-- Join 여러개 쓰기
SELECT employees.emp_id, employees.name, department_emps.dept_code, departments.dept_name
FROM employees 
	JOIN department_emps 
		ON employees.emp_id = department_emps.emp_id 
	JOIN departments -- 그냥 join 하나 더 쓰면 됨
		ON department_emps.dept_code = departments.dept_code
WHERE department_emps.end_at IS NULL 
;

-- left outer join

-- 모든 사원의 사번, 이름, 부서장 시작날짜

SELECT employees.emp_id, employees.name, department_managers.start_at, departments.dept_code
FROM employees
	LEFT JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
	JOIN departments
		ON department_managers.dept_code = departments.dept_code
WHERE department_managers.end_at IS NULL
ORDER BY department_managers.start_at DESC
;

-- union
SELECT *
FROM employees
WHERE emp_id IN(1,3)

UNION ALL

SELECT *
FROM employees
WHERE emp_id IN(3, 6);

-- 슈퍼바이저인 사원의 정보 출력
SELECT emp1.emp_id, emp1.name
FROM employees AS emp1 -- 사원 정보
	JOIN employees AS emp2 -- 슈퍼바이저인 사원 정보
		ON emp1.emp_id = emp2.sup_id
;