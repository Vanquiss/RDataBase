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
    public function __construct()
    {
        echo 'Models';
    }


    public function NewService(ServiceStruct $ServiceData)
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
            $sql =  "BEGIN RCJNFRJR_INSERT_SERVICE(
                        '$ServiceData->serv_name',        
                        '$ServiceData->description',       
                        '$ServiceData->startdate',         
                        '$ServiceData->endate',
                        '$ServiceData->serv_condition'
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