----------------------------- FUNCTION -------------------------------

--OBTENER SALARIO DE UN EMPLEADO
CREATE OR REPLACE FUNCTION RCJNFRJR_GET_SALARY(
    EMPLOYEE_ID_F NUMBER
)
    RETURN NUMBER
IS
    SALARY_F NUMBER := 0;
BEGIN
    SELECT SALARY INTO SALARY_F
    FROM RCJNFRJR_EMPLOYEE
    WHERE (EMPLOYEE_ID = EMPLOYEE_ID_F);

    RETURN SALARY_F;

    EXCEPTION
        WHEN NO_DATA_FOUND THEN
        RETURN -1;
END;