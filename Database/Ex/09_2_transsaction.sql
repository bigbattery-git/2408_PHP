-- transaction 시작

START TRANSACTION;

-- insert something on employees

INSERT INTO employees
(
	name
	,birth
	,gender
	,hire_at
)
VALUES(
	'유원상'
	,'1996-10-15'
	,'M'
	,DATE(NOW())
);

SELECT *
FROM employees
WHERE NAME = '유원상'
;

-- 롤백
ROLLBACK;


-- 커밋

COMMIT;

SELECT *
FROM employees
WHERE NAME = '유원상'
;