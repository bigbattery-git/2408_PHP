-- delete 문 : 데이터 삭제

-- 기본구조
-- delete from 테이블_명
-- where 조건;

-- 물리 삭제 잘 안함. 대신 deleted_at 일자를 추가하여 
-- '삭제된 것'으로 간주하여 함
SELECT *
FROM salaries
WHERE salaries.emp_id = 100002;

DELETE FROM salaries
WHERE salaries.emp_id = 100002;

SELECT *
FROM salaries
WHERE salaries.emp_id = 100002;

-- 내 직급 정보 삭제하기
SELECT *
FROM title_emps
WHERE title_emps.emp_id = 100002;

DELETE FROM title_emps
WHERE title_emps.emp_id = 100002;

SELECT *
FROM title_emps
WHERE title_emps.emp_id = 100002;