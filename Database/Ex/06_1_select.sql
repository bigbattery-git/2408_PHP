

-- select 문 : 데이터를 조회하기 위해 사용하는 쿼리
-- 테이블에서 특정 컬럼만 가져오는 쿼리
SELECT emp_id, NAME
FROM employees
;

-- 테이블의 모든 컬럼이 필요하면 *(Asterisk) 입력
SELECT * 
FROM employees
;

SELECT *
FROM titles
;

-- 모든  사원의 직책과 사번을 조회해주세요
SELECT title_code ,emp_id
FROM title_emps
;

-- where절 : 특정 조건의 데이터 조회할 때 사용
-- 예시) 사번이 10000번인 사원의 모든 정보 조회

SELECT *
FROM employees
WHERE employees.emp_id = 10000
;

SELECT *
FROM employees
WHERE NAME = '원성현'
;

-- 비교연산자 >, <, =, >=, <=, !=
SELECT *
FROM employees
WHERE employees.emp_id >=6  emp_id < 10
;

-- 생일이 1990-01-01 이후인 사원을 조회해주세요
SELECT *
FROM employees
WHERE birth >= '1990-01-01'
;

-- AND, OR : 복수의 조건을 적용시키는 키워드
-- 생일이 1990-01-01 이후이고, 남자사원을 조회해주세요
SELECT *
FROM employees
WHERE employees.birth >= '1990-01-01' 
  AND employees.gender ='M'
;

-- 이름이 원성현이거나 반승현인 사원을 조회해주세요

SELECT *
FROM employees
WHERE employees.name = '원성현'
	OR employees.name ='반승현'
;

-- 이름이 원성현 또는 반승현이고 생일이 1990-01-01 이후인 사원을 조회해주세요
SELECT *
FROM employees
WHERE 
 	(NAME = '원성현' 
 OR NAME = '반승현')
AND birth >= '1990-01-01'
;

SELECT *
FROM employees
WHERE 
	(NAME = '원성현' AND birth >= '1990-01-01') 
 OR NAME = '반승현'
;

-- 직급코드가 T001 또는 T002이고, 직급시작일자가 2000-01-01이후인 사원의 사번과 직급코드 조회
SELECT title_emps.emp_id, title_emps.title_code
FROM title_emps
WHERE 
	(title_emps.title_code = 'T001' 
				OR title_code = 'T002') 
AND title_emps.start_at >= '2000-01-01'
;

-- 2000-01-01 ~ 2001-01-01

SELECT *
FROM employees
WHERE 
	employees.birth >= '2000-01-01'
AND employees.birth <= '2001-01-01'
;

-- in 연산자 : 지정한 값과 일치한 데이터 조회
SELECT *
FROM employees
WHERE 
	NAME IN('염문창', '지도연', '안소정')
;
-- between 연산자
SELECT *
FROM employees
WHERE 
	birth BETWEEN '2000-01-01' AND '2001-01-01'
;

-- LIKE 연산자 : 문자열의 내용을 조회할 때 사용
-- 한글은 문제가 없지만, 영어는 대소문자 구분을 하지 않으니 주의
SELECT *
FROM employees
WHERE
	employees.birth LIKE '%01'
;

-- orderby절 
SELECT *
FROM employees
order BY NAME DESC
;

-- 성별이 여자인 사원을 이름, 생일 순으로 오름차순 정렬 
SELECT *
FROM employees
WHERE gender = "F"
ORDER BY NAME ASC, birth DESC
;

-- distinct 키워드 : 성능이슈 있음 -> 웬만하면 쓰지 마
-- 검색결과에서 중복되는 레코드를 없앰
-- 레코드 한 줄이 다 중복되야 함 -> 매우 제한적
-- 직급테이블에서 사원번호 조회
SELECT DISTINCT title_emps.emp_id, title_emps.title_code
FROM title_emps
;

-- GROUP BY 절 : 그룹으로 묶어서 조회
-- HAVING 절 : Group by절의 조건절

-- 사원별 최고 연봉 조회
SELECT 
	emp_id
	,max(salary)
FROM salaries
GROUP BY emp_id
;

-- 사원별 최고 연봉이 5000만원 이상인 사원 조회
SELECT
	emp_id
	,MAX(salary)
FROM salaries
GROUP BY emp_id
	having Max(salaries.salary) >= 50000000
;

-- 사원의 현재 소속 부서코드 조회하기
-- Null을 어떻게 검색하는가 
SELECT *
FROM department_emps
WHERE 
	department_emps.end_at IS NULL
;

-- 부서별 소속 사원의 수를 구해라
SELECT department_emps.dept_code, COUNT(*) AS empsCount
FROM department_emps
WHERE department_emps.end_at IS null
GROUP BY department_emps.dept_code
;

SELECT *
FROM employees
;

-- 사원 아이디가 10000인 데이터만 가져오시오
SELECT *
FROM employees
WHERE employees.emp_id = 10000
;

-- 생일이 1990년 1월 1일 이상인 사람만 가져오시오
SELECT *
FROM employees
WHERE birth >= '1990-01-01'
;

-- 생일이 1990-01-01 이상'이고' 성별이 남자인 사람을 가져오시오
SELECT *
FROM employees
WHERE employees.birth >= '1990-01-01' 
  AND employees.gender ='M'
;

-- 이름이 '원성현' 이거나 '반승현'인 사람을 가져오시오 
SELECT *
FROM employees
WHERE employees.name = '원성현'
	OR employees.name ='반승현'
;

-- 직급코드가 T001 또는 T002 이고 근무시작일자가 2000-01-01 인 직원 id, 직급코드를 가져오시오 

SELECT title_emps.emp_id, title_emps.title_code
FROM title_emps
WHERE 
	(title_emps.title_code = 'T001' 
				OR title_code = 'T002') 
AND title_emps.start_at >= '2000-01-01'

-- 직원번호가 1, 10, 또는 100인 직원의 sal id와 salary, emp_id값을 가져오시오
SELECT salaries.sal_id, salaries.salary, salaries.emp_id
FROM salaries
WHERE salaries.emp_id IN(1, 10, 100)

-- 생일이 '2000-01-01' 에서 '2001-01-01'인 데이터를 가져오시오
SELECT *
FROM employees
WHERE 
	birth BETWEEN '2000-01-01' AND '2001-01-01'
;

-- 생일이 01일인 데이터를 가져오시오
SELECT *
FROM employees
WHERE
	employees.birth LIKE '%01'
;

-- 이름이 세 글자이고 가운데 글자가 '원'인 데이터를 가져오시오
SELECT *
FROM employees
WHERE employees.name LIKE '_원_'
;

-- 성별이 F인 데이터를 Name 기준으로 오름차순, birth 기준으로 내림차순으로 가져오시오
SELECT *
FROM employees
WHERE gender = "F"
ORDER BY NAME ASC, birth DESC
;

-- emp_id 기준으로 셀러리 합계를 가져오시오
SELECT emp_id, max(salary)
FROM salaries
GROUP BY emp_id
;

-- 최고 연봉이 50,000,000 이상인 emp_id, 같은 emp_id에서 최고연봉을 가져오시오  
SELECT emp_id ,MAX(salary)
FROM salaries
GROUP BY emp_id
	having Max(salaries.salary) >= 50000000
;