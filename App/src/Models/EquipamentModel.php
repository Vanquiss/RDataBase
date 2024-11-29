<?php

include '../BaseModel.php';

Class EquipamentStruct{
    public $eqpt_name;
    public $eqpt_quantity;
    public $eqpt_min_quantity;
    public $eqpt_condition;
    public function __construct($eqpt_name, $eqpt_quantity,$eqpt_min_quantity,$eqpt_condition)
    {
        $this->eqpt_name = $eqpt_name;
        $this->eqpt_quantity = $eqpt_quantity;
        $this->eqpt_min_quantity = $eqpt_min_quantity;
        $this->eqpt_condition = $eqpt_condition;
    }
}
Class EquipamentModel extends BaseModel{
    public function __construct()
    {
        
    }
    public function NewEquipament(EquipamentStruct $EquipamentData)
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
            $sql =  "BEGIN RCJNFRJR_INSERT_EQUIPAMENT(
                        '$EquipamentData->eqpt_name',        
                        '$EquipamentData->eqpt_quantity',       
                        '$EquipamentData->eqpt_min_quantity'
                        );
                    END;";
                    
                    //'$EmployeeData->job_id'
        
            // Prepara la consulta
            $stid =  $this->prepareQuery($connection, $sql);
    
            // Ejecuta el procedimiento
            $this->executeQuery($stid);
        
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