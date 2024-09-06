SELECT emp_id, end_at
FROM salaries
WHERE salaries.emp_id = 100000;

UPDATE salaries
	SET salaries.updated_at = NOW()
		,salaries.end_at = NOW()
WHERE salaries.emp_id = 100000
	AND salaries.end_at IS NULL;

INSERT INTO salaries(
	emp_id
	,salary
	,start_at
	,created_at
	,updated_at
)

VALUES(
	100000
	,40000000
	,DATE(NOW())
	,NOW()
	,NOW()
);

-- 프로시저 만들기

DELIMITER $$

	CREATE PROCEDURE update_salary(
		_change_emp_id BIGINT(20)
		, _change_salary BIGINT(20))
	BEGIN
		UPDATE salaries
		SET salaries.updated_at = NOW()
			,salaries.end_at = DATE(NOW())
		WHERE salaries.emp_id = _change_emp_id
			AND salaries.end_at IS NULL;
			
		INSERT INTO salaries(
			emp_id
			,salary
			,start_at
			,created_at
			,updated_at
		)
		
		VALUES(
			_change_emp_id
			,_change_salary
			,DATE(NOW())
			,NOW()
			,NOW()
		);
	END $$
	
DELIMITER;

DROP PROCEDURE update_salary;

CALL update_salary(100000, 55000000);