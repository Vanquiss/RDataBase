<?php
include '../BaseModel.php';



class ServiceStruct {
    public $serv_name;
    public $description;
    public $startdate;
    public $endate;
    public $serv_condition;
    
    // Constructor para inicializar los valores
    public function __construct($serv_name,$description,$startdate,$endate,$serv_condition) {
        $this->serv_name = $serv_name;
        $this->description = $description;
        $this->startdate = $startdate;
        $this->endate = $endate;
        $this->serv_condition = $serv_condition;
    }
}



class ServiceModel extends BaseModel

{
    

    public function NewService($ServiceData)
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
        
           
            $serv_name = $ServiceData['service_name'];
            $serv_des = $ServiceData['description'];
            $startDate = $ServiceData['start_date'];
            $endDate = $ServiceData['end_date'];
            $serv_condition = $ServiceData['condition'];

            // Define la llamada al procedimiento con sus parámetros
            $sql =  "BEGIN RCJNFRJR_INSERT_SERVICE(
            
                        '$serv_name',
                        '$serv_des',
                        TO_DATE('$startDate', 'YYYY-MM-DD'),
                        TO_DATE('$endDate', 'YYYY-MM-DD'),
                        '$serv_condition'

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


    
    public function getServices():array
    {
        try {
            // Crear una nueva conexión a la base de datos
            $newconnection = new Connection("SYSTEM", "123", "XE");
            $connection = $newconnection->Connect();
    
            // Preparar la consulta para llamar al procedimiento
            $sql = "BEGIN GET_SERVICE_DETAILS(:service_cursor); END;";
    
            // Preparar la declaración
            $stid = oci_parse($connection, $sql);
    
            // Crear un cursor para almacenar los resultados
            $employeeCursor = oci_new_cursor($connection);
    
            // Asociar el cursor al parámetro de salida
            oci_bind_by_name($stid, ":service_cursor", $employeeCursor, -1, OCI_B_CURSOR);
    
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