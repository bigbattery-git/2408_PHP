-- Insert문 : 신규 데이터 저장

-- 기본 구조
-- insert info 테이블명(컬럼1, 컬럼2, ...)
-- value (값1, 값2, ...);
-- 주의 : value값이 들어가는 순서는 insert info에 적은 컬럼
-- 순서대로 들어감
-- 꼭 컬럼 순서대로 적을 필요 없음. 근데 보통은 컬럼 순서대로
-- 적는 편. 안해깔리게

INSERT INTO employees (
	NAME, 
	birth, 
	gender, 
	hire_at, 
	fire_at, 
	employees.sup_id,
	created_at, 
	updated_at, 
	deleted_at 
)
VALUES(
	'유원상', 
	'1996-10-15', 
	'M', 
	'2024-09-02', 
	NULL, 
	null,
	'2024-09-02 10:08:15',
	'2024-09-02 10:08:15', 
	NULL
);
-- 날자타입에 종류가 있음. '연월일' or '연월일 시분초' 둘로 나뉨

-- 그냥 보고 넘어가자 -> select insert : 기존에 있는 데이터를 이용하여 데이터를 추가 
INSERT INTO employees (
	NAME, 
	birth, 
	gender, 
	hire_at, 
	fire_at, 
	employees.sup_id,
	created_at, 
	updated_at, 
	deleted_at 
)
SELECT 
	NAME, 
	birth, 
	gender, 
	hire_at, 
	fire_at, 
	employees.sup_id,
	created_at, 
	updated_at, 
	deleted_at
FROM employees
WHERE emp_id = 100002 
;
-- 대량의 데이터를 넣을 때 사용함
-- 신입에게 잘 안시킴. 복잡하고 어려운 일
-- where 안쓰면 모든 데이터를 전부 다 복붙함

-- 직급정보 삽입
INSERT INTO title_emps (
	title_emps.emp_id
	,title_emps.title_code
	,title_emps.start_at
	,title_emps.end_at
	,title_emps.created_at
	,title_emps.updated_at
	,title_emps.deleted_at
)
VALUES(
	100002
	,'T001'
	,'2024-09-02'
	,NULL
	,'2024-09-02 10:43:00'
	,'2024-09-02 10:43:00'
	,null
);
-- 급여정보 삽입
INSERT INTO salaries(
	salaries.emp_id
	,salaries.salary
	,salaries.start_at
	,salaries.end_at
	,salaries.created_at
	,salaries.updated_at
	,salaries.deleted_at
)
VALUES(
	100002
	,1000000000
	,'2024-09-02'
	,null
	,'2024-09-02 10:52:00'
	,'2024-09-02 10:52:00'
	,null
);
-- 소속부서 정보 삽입
INSERT INTO department_emps (
	department_emps.emp_id
	,department_emps.dept_code
	,department_emps.start_at
	,department_emps.end_at
	,department_emps.created_at
	,department_emps.updated_at
	,department_emps.deleted_at
)
VALUES(
	100002
	,'D009'
	,'2024-09-02'
	,null
	,'2024-09-02 10:57:00'
	,'2024-09-02 10:57:00'
	,null
);

SELECT *
FROM department_emps
WHERE department_emps.emp_id = 100002
;