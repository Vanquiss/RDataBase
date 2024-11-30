<?php
//include '../BaseModel.php';
Class JobsStruct{
    public $job_id;
    public $job_title;
    public $min_salary;
    public $max_salary;
    public function __construct($job_id,$job_title, $min_salary, $max_salary){
        $this->job_id = $job_id;
        $this->job_title = $job_title;
        $this->min_salary = $min_salary;
        $this->max_salary = $max_salary;
    }
}


Class JobsModels extends BaseModel
{
    

    public function NewJob($jobData)
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

            $job_id = $jobData['job_id'];
            $job_title = $jobData['job_title'];
            $min_salary = $jobData['min_salary'];
            $max_salary = $jobData['max_salary'];
        
            // Define la llamada al procedimiento con sus parámetros
            $sql =  "BEGIN RCJNFRJR_INSERT_JOB(
                        '$job_id',
                        '$job_title',
                        $min_salary,
                        $max_salary
                        );
                    END;";
                    
                    
        
            // Prepara la consulta
            $stid =  $this->prepareQuery($connection, $sql);
        
            // Ejecuta el procedimiento
            $this->executeQuery($stid, "Puesto de trabajo creado con éxito.");
           
            // Libera recursos
            oci_free_statement($stid);

            oci_close($connection);
        
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        
    }

    public function updateJob($jobData)
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

            $job_id = $jobData['job_id'];
            $job_title = $jobData['updated_job_title'];
            $new_job_id = $jobData['new_job_id'];
            $min_salary = $jobData['updated_min_salary'];
            $max_salary = $jobData['updated_max_salary'];
        
            // Define la llamada al procedimiento con sus parámetros
            $sql =  "BEGIN RCJNFRJR_UPDATE_JOBS(
                        '$job_id',
                        '$new_job_id',
                        '$job_title',
                        $min_salary,
                        $max_salary
                        );
                    END;";
                    
                    
        
            // Prepara la consulta
            $stid =  $this->prepareQuery($connection, $sql);
        
            // Ejecuta el procedimiento
            $this->executeQuery($stid, "Puesto de trabajo actualizado con éxito.");
           
            // Libera recursos
            oci_free_statement($stid);

            oci_close($connection);
        
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        
    }


    public function deleteJob($jobData)
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

            $job_id = $jobData['delete_job_id'];
       
        
            // Define la llamada al procedimiento con sus parámetros
            $sql =  "BEGIN RCJNFRJR_DELETE_JOB(
                        '$job_id'
                        
                        );
                    END;";
                    
                    
        
            // Prepara la consulta
            $stid =  $this->prepareQuery($connection, $sql);
        
            // Ejecuta el procedimiento
            $this->executeQuery($stid, "Puesto de trabajo eliminado con éxito.");
           
            // Libera recursos
            oci_free_statement($stid);

            oci_close($connection);
        
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        
    }


    public function getJobs():array
    {
        try {
            // Crear una nueva conexión a la base de datos
            $newconnection = new Connection("SYSTEM", "123", "XE");
            $connection = $newconnection->Connect();
    
            // Preparar la consulta para llamar al procedimiento
            $sql = "BEGIN GET_JOBS_DETAILS(:JOBS_CURSOR); END;";
    
            // Preparar la declaración
            $stid = oci_parse($connection, $sql);
    
            // Crear un cursor para almacenar los resultados
            $employeeCursor = oci_new_cursor($connection);
    
            // Asociar el cursor al parámetro de salida
            oci_bind_by_name($stid, ":JOBS_CURSOR", $employeeCursor, -1, OCI_B_CURSOR);
    
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
            $jobs = [];
            while (($row = oci_fetch_assoc($employeeCursor)) !== false) {
                $jobs[] = $row; // Agregar cada fila a la lista de empleados
                
            }
    
            // Liberar recursos
            oci_free_statement($stid);
            oci_free_statement($employeeCursor);
            oci_close($connection);
    
            // Devolver los datos obtenidos
            return $jobs;
    
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
    
            // Asegúrate de devolver un array vacío en caso de error
            return [];
        }
    }

}


?>