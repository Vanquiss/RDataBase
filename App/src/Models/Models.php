



<?


include '../BaseModel.php';

class Employee extends BaseModel

{
    public function __construct()
    {
        echo 'Models';
    }
}

class Service extends BaseModel

{
    public function __construct()
    {

        echo 'Models';
    }
}

class Job extends BaseModel

{

    //Atributos
    





    public function __construct()
    {
       
    }

    public function getJobs()
    {

        if(!$this->ConnectToDataBase(DBConfig::USER, DBConfig::PASSWORD, DBConfig::DB)){
            echo 'Error al conectar a la base de datos';
            return;
        };
        
        //llamada al procedimiento
        $stid = oci_parse(DBConfig::DB, "BEGIN get_jobs(:cursor); END;");

        // cursor 
        $cursor = oci_new_cursor(DBConfig::DB);
        oci_bind_by_name($stid, ":cursor", $cursor, -1, OCI_B_CURSOR);

        // Ejecuta el procedimiento
        oci_execute($stid);
        oci_execute($cursor); // Ejecuta el cursor para obtener los datos

        // Procesa los resultados
        $results = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $results[] = $row;
        }

        // Libera los recursos
        oci_free_statement($stid);
        oci_free_statement($cursor);

        return $results;
    }


}




?>