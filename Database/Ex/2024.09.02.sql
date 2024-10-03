-- 가장 나이가 많은사람 10명의 emp_id와 고용일자를 가져오시오

SELECT employees.emp_id, employees.hire_at
FROM employees
ORDER BY employees.birth ASC
LIMIT 10
;

-- 처음 업무 시작한 사람부터 sal_id, salary 데이터5개를 가져오되, 네 번째 부터 가져오시오
SELECT salaries.sal_id, salaries.salary
FROM salaries
ORDER BY salaries.start_at
LIMIT 5 OFFSET 3;

-- 내 정보를 employees에 추가하시오
INSERT INTO employees (
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
	'유원상'
	,'1996-10-15'
	,'M'
	,DATE(NOW())
	,null
	,null
	,NOW()
	,NOW()
	,null
);

-- 수정 전
SELECT *
FROM employees
WHERE NAME = '유원상'
;

-- 수정
UPDATE employees
SET employees.name = '유원상짱',
	employees.updated_at = NOW()
WHERE employees.emp_id = 100002
;

-- 수정 후
SELECT *
FROM employees
WHERE employees.emp_id = 100002
;

-- 삭제 전
SELECT *
FROM employees
WHERE employees.emp_id = 100002
;

-- 삭제
DELETE FROM employees
WHERE employees.emp_id = 100002
;

-- 삭제 후
SELECT *
FROM employees
WHERE employees.emp_id = 100002
;

SELECT *
FROM employees
LIMIT 10
;

-- 숫자 -> 문자
SELECT
	1234
	,CAST(1234 AS CHAR)
	,CONVERT(1234, CHAR);
	
-- 문자 -> 숫자
SELECT 
	'1234'
	,CAST('1234' AS UNSIGNED)
	,CONVERT('1234', UNSIGNED);
	

SELECT employees.name
		, if(employees.gender = 'M', '남자', '여자') AS kr_gender
FROM employees;

-- 퇴사했으면 퇴사일자, 그게 아니라면 '재직중' 출력
SELECT employees.name, IFNULL(employees.fire_at, '재직중')
FROM employees;

SELECT employees.name, employees.birth,
	case 
		when employees.birth <= '1979-12-31' then '70년도생'
		when employees.birth <= '1989-12-31' then '80년도생'
		when employees.birth <= '1999-12-31' then '90년도생'
		ELSE 'MZ세대'
END AS birth_rank
FROM employees;

SELECT CONCAT('이 편지는 ', '영국에서부터', ' ','시작 되었으며...');

SELECT CONCAT('취미목록 : ', CONCAT_WS(', ','게임하기','독서','운동'));

SELECT FORMAT(3000000, 1);

SELECT SUBSTRING('123456789', 3, 4);

SELECT RPAD('123', 5, '0');