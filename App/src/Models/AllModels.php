



<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



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

        if(!$this->ConnectToDataBase("SYST", "123", "XE")){
            echo 'Error al conectar a la base de datos';
            return;
        };
        
        //llamada al procedimiento
        $stid = oci_parse(DBConfig::DB, "BEGIN HOLA END;");


        return $stid;
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

        //Libera los recursos
        oci_free_statement($stid);
        oci_free_statement($cursor);
        oci_close($conn);
        return $results;
    }


}



$sql =  "BEGIN RCJNFRJR_INSERT_EMPLOYEE(
    'juanPHP2',        -- first_name
    'juanin',         -- last_name
    570000,         -- salary (sin punto como separador decimal, si es un número entero)
    SYSDATE,
    'BANCOESTADO',
    'CORRIENTE',
    123
 );
 END;";


// Prepara la consulta

// $conn = $newconnection->Connect();
// $stid = oci_parse($conn, $sql);

$NewModel = new Employee();
if($NewModel->NewEmployee()){
    echo 'Empleado creado';
}



// // Ejecutar la consulta
// if (!oci_execute($stid)) {
// $e = oci_error($stid);
// throw new Exception("Error al ejecutar el procedimiento: " . htmlentities($e['message']));
// }





?>