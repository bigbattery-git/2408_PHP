-- update문 : 기존 데이터를 수정
-- UPDATE 테이블_명
-- SET 컬럼1 = 값1, 컬럼2 = 값2, ...
-- WHERE 조건 -> 반드시 들어가야함. 안그러면 테이블_명의 모든 데이터가 수정됨

SELECT *
FROM salaries
WHERE salaries.salary=50000000
;

UPDATE employees
SET employees.gender = 'F'
WHERE emp_id = 100002
;

-- 내 직급을 부장으로 바꾸기 T005
UPDATE title_emps
SET title_emps.title_code = 'T005'
WHERE title_emps.emp_id = 100002;
-- 현재 급여가 26000000원 이하 직원의 급여를 50000000원으로 수정
UPDATE salaries
SET salaries.salary = 50000000
WHERE salaries.salary <= 26000000
;
