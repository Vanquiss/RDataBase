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




//include_once __DIR__ . '/../../BaseModel.php';
class EmployeeModel extends BaseModel

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

    public function getEmployee():array
    {
        try {
            // Crear una nueva conexión a la base de datos
            $newconnection = new Connection("SYSTEM", "123", "XE");
            $connection = $newconnection->Connect();
    
            // Preparar la consulta para llamar al procedimiento
            $sql = "BEGIN GET_EMPLOYEE_DETAILS(:employee_cursor); END;";
    
            // Preparar la declaración
            $stid = oci_parse($connection, $sql);
    
            // Crear un cursor para almacenar los resultados
            $employeeCursor = oci_new_cursor($connection);
    
            // Asociar el cursor al parámetro de salida
            oci_bind_by_name($stid, ":employee_cursor", $employeeCursor, -1, OCI_B_CURSOR);
    
            // Ejecutar la declaración
            if (!oci_execute($stid)) {
                $error = oci_error($stid);
                return [];
                throw new Exception("Error ejecutando el procedimiento: " . $error['message']);
            }
    
            // Ejecutar el cursor para obtener los resultados
            if (!oci_execute($employeeCursor)) {
                $error = oci_error($employeeCursor);
                return [];
                throw new Exception("Error ejecutando el cursor: " . $error['message']);

            }
    
            // Procesar los resultados del cursor
            $employees = [];
            while (($row = oci_fetch_assoc($employeeCursor)) !== false) {
                $employees[] = $row; // Agregar cada fila a la lista de empleados
            }
    
            // Liberar recursos
            oci_free_statement($stid);
            oci_free_statement($employeeCursor);
            oci_close($connection);
    
            // Devolver los datos obtenidos
            return $employees;
    
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
    
            // Asegúrate de devolver un array vacío en caso de error
            return [];
        }
    }
    


}

?>