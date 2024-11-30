<?php
include '../BaseModel.php';

Class MaterialStruct{
    public $material_name;
    public $material_quantity;
    public $material_min_quantity;

    //constructor para inicializar los valores

    public function __construct( $material_name, $material_quantity, $material_min_quantity) {
        $this->material_name = $material_name;
        $this->material_quantity = $material_quantity;
        $this->material_min_quantity = $material_min_quantity;
    }
}

class MaterialModel extends BaseModel
{
   
    public function NewMaterial(MaterialStruct $MaterialData)
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
            $sql =  "BEGIN RCJNFRJR_INSERT_MATERIAL(
                        '$MaterialData->material_name',        
                        '$MaterialData->material_quantity',       
                         $MaterialData->material_min_quantity
                        );
                    END;";
                    
                   
        
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