<?php
include '../BaseModel.php';







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



class EmployeeModel extends BaseModel

{
    public function __construct()
    {
        echo 'Models';
    }


    public function NewEmployee(EmployeeStruct $EmployeeData)
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
        
            // Define la llamada al procedimiento con sus parámetros
            $sql =  "BEGIN RCJNFRJR_INSERT_EMPLOYEE(
                        '$EmployeeData->name',        
                        '$EmployeeData->last_name',       
                         $EmployeeData->salary,         
                        TO_DATE('$EmployeeData->hire_date', 'YYYY-MM-DD'),

                        '$EmployeeData->bank_name',
                        '$EmployeeData->account_type',
                        $EmployeeData->account_number
                        
                        );
                    END;";
                    
                    //'$EmployeeData->job_id'
        
            // Prepara la consulta
            $stid = oci_parse($connection, $sql);

            if(!$stid){
                $e = oci_error($connection);
                oci_close($connection);
                die("Error al preparar la consulta: " . htmlentities($e['message']));
            }
    
        
            // Ejecuta el procedimiento
            if (oci_execute($stid)) {
                echo "Procedimiento ejecutado con éxito.";
                return true;
            } else {
                $e = oci_error($stid); // Obtiene el error
                echo "Error al ejecutar el procedimiento: " . $e['message'];
                return false;
            }
        
            // Libera recursos
            oci_free_statement($stid);

            oci_close($connection);
        
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        
    }


}

?>