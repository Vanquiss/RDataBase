<?php



class EmployeeStruct {
    public $name;
    public $last_name;
    public $salary;
    public $hire_date;
    public $job_id;
    public $bank_name;
    public $account_type;
    public $account_number;

    // Constructor para inicializar los valores
    public function __construct($name, $last_name, $salary, $hire_date, $bank_name, $account_type, $account_number,$job_id) {
        $this->name = $name;
        $this->last_name = $last_name;
        $this->salary = $salary;
        $this->hire_date = $hire_date;
       
        $this->bank_name = $bank_name;
        $this->account_type = $account_type;
        $this->account_number = $account_number;
        $this->job_id = $job_id;



    }
}




include_once __DIR__ . '/../BaseModel.php';
class LoginModel extends BaseModel

{
    public function __construct()
    {
        
    }


    public function NewEmployee($employeeData)
    {
        try {
            // Verifica conexión a la base de datos

            // $connection = $this->ConnectToDataBase("SYSTEM", "123", "XE");
            // if (!$connection) {
            //     echo 'Error al conectar a la base de datos';
            //     return false;
            // }

            $newconnection = new Connection("SYSTEM", "123", "XE");
            $connection = $newconnection->Connect();
        
           
            // Extraer los datos del array
            $name = $employeeData['name'];
            $lastName = $employeeData['last_name'];
            $salary = $employeeData['salary'];
            $hireDate = $employeeData['hire_date'];
            $accountNumber = $employeeData['account_number'];
            $bankName = $employeeData['bank_name'];
            $accountType = $employeeData['account_type'];
            $jobId = $employeeData['job_id'];

            $sql = "
                    BEGIN 
                        RCJNFRJR_INSERT_EMPLOYEE(
                            '$name',
                            '$lastName',
                            $salary,
                            TO_DATE('$hireDate', 'YYYY-MM-DD'),
                            $accountNumber,
                            '$bankName',
                            '$accountType',
                            '$jobId'
                        );
                    END;
                ";

                    
            // Prepara la consulta
            $stid =  $this->prepareQuery($connection, $sql);
        
            // Ejecuta el procedimiento
            $this->executeQuery($stid, "Empleado creado con éxito.");
           
            // Libera recursos
            oci_free_statement($stid);

            oci_close($connection);
        
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        
    }


    
    public function updateEmployee($employeeData)
    {
        try {
            // Verifica conexión a la base de datos

            // $connection = $this->ConnectToDataBase("SYSTEM", "123", "XE");
            // if (!$connection) {
            //     echo 'Error al conectar a la base de datos';
            //     return false;
            // }

            $newconnection = new Connection("SYSTEM", "123", "XE");
            $connection = $newconnection->Connect();
        
           
            // Extraer los datos del array
            $employeeId = $employeeData['employee_id'];


            $name = $employeeData['newname'];
            $lastName = $employeeData['newlast_name'];
            $salary = $employeeData['newsalary'];
            
            $accountNumber = $employeeData['newaccount_number'];
            $bankName = $employeeData['newbank_name'];
            $accountType = $employeeData['newaccount_type'];
            $jobId = $employeeData['newjob_id'];

            $sql = "
                    BEGIN 
                        RCJNFRJR_UPDATE_EMPLOYEE(
                            $employeeId,
                            '$name',
                            '$lastName',
                            $salary,
                            
                            $accountNumber,
                            '$bankName',
                            '$accountType',
                            '$jobId'
                        );
                    END;
                ";

                    
            // Prepara la consulta
            $stid =  $this->prepareQuery($connection, $sql);
        
            // Ejecuta el procedimiento
            $this->executeQuery($stid, "Empleado actualizado con éxito.");
           
            // Libera recursos
            oci_free_statement($stid);

            oci_close($connection);
        
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        
    }

    
    public function deleteEmployee($employeeData)
    {
        try {
            // Verifica conexión a la base de datos

            // $connection = $this->ConnectToDataBase("SYSTEM", "123", "XE");
            // if (!$connection) {
            //     echo 'Error al conectar a la base de datos';
            //     return false;
            // }

            $newconnection = new Connection("SYSTEM", "123", "XE");
            $connection = $newconnection->Connect();
        
           
            // Extraer los datos del array
            $employeeId = $employeeData['delete_employee_id'];
            

            $sql = "
                    BEGIN 
                        RCJNFRJR_DELETE_EMPLOYEE(
                            $employeeId
                            
                        );
                    END;
                ";

                    
            // Prepara la consulta
            $stid =  $this->prepareQuery($connection, $sql);
        
            // Ejecuta el procedimiento
            $this->executeQuery($stid, "Empleado eliminado con éxito.");
           
            // Libera recursos
            oci_free_statement($stid);

            oci_close($connection);
        
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        
    }

    public function ValidLogin($loginData): bool
    {
        try {
            // Crear una nueva conexión a la base de datos
            $newconnection = new Connection("SYSTEM", "123", "XE");
            $connection = $newconnection->Connect();
    
            // Extraer los datos del array
            $username = $loginData['username'];
            $password = $loginData['password'];
    
            // Preparar la consulta para llamar a la función
            $sql = "BEGIN :is_valid := VALIDATE_LOGIN(:username, :password); END;";
    
            // Preparar la declaración
            $stid = oci_parse($connection, $sql);
    
            // Crear la variable de salida para almacenar el resultado (TRUE o FALSE)
            $isValid = null;
    
            // Asociar los parámetros
            oci_bind_by_name($stid, ":is_valid", $isValid, -1, SQLT_INT); // La salida será 0 o 1 (BOOLEAN simulado)
            oci_bind_by_name($stid, ":username", $username, -1, SQLT_CHR);
            oci_bind_by_name($stid, ":password", $password, -1, SQLT_CHR);
    
            // Ejecutar la declaración
            if (!oci_execute($stid)) {
                $error = oci_error($stid);
                throw new Exception("Error ejecutando la función: " . $error['message']);
            }
    
            // Liberar recursos
            oci_free_statement($stid);
            oci_close($connection);
    
            // Retornar el resultado de la validación
            return (bool) $isValid;
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false; // En caso de error, asumimos que el login no es válido
        }
    }
    


}

?>