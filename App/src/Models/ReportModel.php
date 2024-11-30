<?php
include '../BaseModel.php';




class ReportModel extends BaseModel

{
    

    // public function NewService($ServiceData)
    // {
    //     try {
    //         // Verifica conexión a la base de datos

    //         // $connection = $this->ConnectToDataBase("SYSTEM", "123", "XE");
    //         // if (!$connection) {
    //         //     echo 'Error al conectar a la base de datos';
    //         //     return false;
    //         // }

    //         $newconnection = new Connection("SYSTEM", "123", "XE");
    //         $connection = $newconnection->Connect();
        
           
    //         $serv_name = $ServiceData['service_name'];
    //         $serv_des = $ServiceData['description'];
    //         $startDate = $ServiceData['start_date'];
    //         $endDate = $ServiceData['end_date'];
    //         $serv_condition = $ServiceData['condition'];

    //         // Define la llamada al procedimiento con sus parámetros
    //         $sql =  "BEGIN RCJNFRJR_INSERT_SERVICE(
            
    //                     '$serv_name',
    //                     '$serv_des',
    //                     TO_DATE('$startDate', 'YYYY-MM-DD'),
    //                     TO_DATE('$endDate', 'YYYY-MM-DD'),
    //                     '$serv_condition'

    //                     );
    //                 END;";
                    
    //                 //'$EmployeeData->job_id'
        
    //         // Prepara la consulta
    //         $stid = oci_parse($connection, $sql);

    //         if(!$stid){
    //             $e = oci_error($connection);
    //             oci_close($connection);
    //             die("Error al preparar la consulta: " . htmlentities($e['message']));
    //         }
    
        
    //         // Ejecuta el procedimiento
    //         if (oci_execute($stid)) {
    //             echo "Procedimiento ejecutado con éxito.";
    //             return true;
    //         } else {
    //             $e = oci_error($stid); // Obtiene el error
    //             echo "Error al ejecutar el procedimiento: " . $e['message'];
    //             return false;
    //         }
        
    //         // Libera recursos
    //         oci_free_statement($stid);

    //         oci_close($connection);
        
    //     } catch (Exception $e) {
    //         echo "Ocurrió un error: " . $e->getMessage();
    //         return false;
    //     }

        
    // }


    public function getEquipmentReport(): array
{
    try {
        // Crear una nueva conexión a la base de datos
        $newconnection = new Connection("SYSTEM", "123", "XE");
        $connection = $newconnection->Connect();

        // Verificar la conexión
        if (!$connection) {
            $error = oci_error();
            throw new Exception("Error en la conexión: " . $error['message']);
        }

        // Preparar la consulta para llamar a la función
        $sql = "SELECT GET_MOST_USED_EQUIPMENT_FN() AS v_cursor FROM DUAL";
        $stid = oci_parse($connection, $sql);

       
        if (!$stid) {
            $error = oci_error($connection);
            throw new Exception("Error al preparar la consulta: " . $error['message']);
        }

     
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            throw new Exception("Error ejecutando la consulta: " . $error['message']);
        }

        $row = oci_fetch_assoc($stid);
        if (!$row || !isset($row['V_CURSOR'])) {
            throw new Exception("No se obtuvo un cursor valido.");
        }
        $reportCursor = $row['V_CURSOR'];

   
        if (!oci_execute($reportCursor)) {
            $error = oci_error($reportCursor);
            throw new Exception("Error ejecutando el cursor: " . $error['message']);
        }

      
        $reports = [];
        while (($row = oci_fetch_assoc($reportCursor)) !== false) {
            $reports[] = $row;
        }

        if ($stid) {
            oci_free_statement($stid);
        }
       
        oci_close($connection);


        return $reports;

    } catch (Exception $e) {
        echo "Ocurrió un error: " . $e->getMessage();

        return [];
    }
}




public function getServiceReport(): array
{
    try {
        // Crear una nueva conexión a la base de datos
        $newconnection = new Connection("SYSTEM", "123", "XE");
        $connection = $newconnection->Connect();

        // Verificar la conexión
        if (!$connection) {
            $error = oci_error();
            throw new Exception("Error en la conexión: " . $error['message']);
        }

        // Preparar la consulta para llamar a la función
        $sql = "SELECT GET_SERVICES_BY_MONTH_FN() AS v_cursor FROM DUAL";
        $stid = oci_parse($connection, $sql);

       
        if (!$stid) {
            $error = oci_error($connection);
            throw new Exception("Error al preparar la consulta: " . $error['message']);
        }

     
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            throw new Exception("Error ejecutando la consulta: " . $error['message']);
        }

        $row = oci_fetch_assoc($stid);
        if (!$row || !isset($row['V_CURSOR'])) {
            throw new Exception("No se obtuvo un cursor valido.");
        }
        $reportCursor = $row['V_CURSOR'];

   
        if (!oci_execute($reportCursor)) {
            $error = oci_error($reportCursor);
            throw new Exception("Error ejecutando el cursor: " . $error['message']);
        }

      
        $reports = [];
        while (($row = oci_fetch_assoc($reportCursor)) !== false) {
            $reports[] = $row;
        }

        if ($stid) {
            oci_free_statement($stid);
        }
       
        oci_close($connection);


        return $reports;

    } catch (Exception $e) {
        echo "Ocurrió un error: " . $e->getMessage();

        return [];
    }
}



public function getMaterialReport(): array
{
    try {
        // Crear una nueva conexión a la base de datos
        $newconnection = new Connection("SYSTEM", "123", "XE");
        $connection = $newconnection->Connect();

        // Verificar la conexión
        if (!$connection) {
            $error = oci_error();
            throw new Exception("Error en la conexión: " . $error['message']);
        }

        // Preparar la consulta para llamar a la función
        $sql = "SELECT GET_TOP_AND_LEAST_USED_MATERIALS_FN() AS v_cursor FROM DUAL";
        $stid = oci_parse($connection, $sql);

       
        if (!$stid) {
            $error = oci_error($connection);
            throw new Exception("Error al preparar la consulta: " . $error['message']);
        }

     
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            throw new Exception("Error ejecutando la consulta: " . $error['message']);
        }

        $row = oci_fetch_assoc($stid);
        if (!$row || !isset($row['V_CURSOR'])) {
            throw new Exception("No se obtuvo un cursor valido.");
        }
        $reportCursor = $row['V_CURSOR'];

   
        if (!oci_execute($reportCursor)) {
            $error = oci_error($reportCursor);
            throw new Exception("Error ejecutando el cursor: " . $error['message']);
        }

      
        $reports = [];
        while (($row = oci_fetch_assoc($reportCursor)) !== false) {
            $reports[] = $row;
        }

        if ($stid) {
            oci_free_statement($stid);
        }
       
        oci_close($connection);


        return $reports;

    } catch (Exception $e) {
        echo "Ocurrió un error: " . $e->getMessage();

        return [];
    }
}

    


}

?>