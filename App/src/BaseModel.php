


<?php

include_once "Config/Connection.php";

class BaseModel
{
    public function __construct()
    {
       
    }


    public function ConnectToDataBase($user, $pass, $DBname)
    {
        $connection = new Connection($user, $pass, $DBname);
        $conn = $connection->Connect();
        return $conn;
    }

    public function prepareQuery($connection, $sql)
    {
        
        // Prepara la consulta
        $stid = oci_parse($connection, $sql);

        if(!$stid){
            $e = oci_error($connection);
            oci_close($connection);
            die("Error al preparar la consulta: " . htmlentities($e['message']));
        }

        return $stid;
    
    }



    public function executeQuery($stid, $operationSuccessMessage = "Operación realizada con éxito.")
    {
        //  // Ejecuta el procedimiento
        if (oci_execute($stid)) {
            //debug
            echo "     
            DEBUG: Procedimiento ejecutado con éxito.";

            echo "
                <div class='container my-4'>
                    <div class='alert alert-success' role='alert'>
                        <strong>¡Éxito!</strong> ". $operationSuccessMessage ."
                    </div>
                </div>
                ";

            return true;
        } else {
            $e = oci_error($stid); // Obtiene el error
            

            echo "DEBUUG: Error al ejecutar el procedimiento: " . $e['message'];

            $customErrorMessage = "";
            if (preg_match('/ORA-\d+: (.+)/', $e['message'], $matches)) {
                $customErrorMessage = $matches[1]; // Captura solo el mensaje principal
            } else {
                $customErrorMessage = "Ocurrió un error inesperado."; // Mensaje generico
            }

            echo "
                <div class='container my-4'>
                    <div class='alert alert-danger' role='alert'>
                        <strong>Error:</strong> No se pudo realizar la operacion. Detalles: ". htmlspecialchars($customErrorMessage) ."
                    </div>
                </div>
                ";

            return false;
        }
    
    }




}




?>