



<?php



include ("Config.php");
include ('Models.php');


class Connection
{
    //private $conn;
    private $db_user = "SYSTEM";         // Usuario
   
    private $db_pass = "123";           // Contraseña
    private $db_name = "XE";           // Servicio de Oracle
  
    public function __construct($user, $pass, $name)
    {
        $this->db_user = $user;
        $this->db_pass = $pass;
        $this->db_name = $name;   
    }

    public function Connect()
    {
        $conn = oci_connect($this->db_user, $this->db_pass, '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=XE)))', 'AL32UTF8');

        //$conn_string = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=$this->db_name)))";
        //$conn = oci_connect($this->db_user, $this->db_pass,$conn); //$this->db_name);

        //$this->conn = oci_connect($this->db_user, $this->db_pass, $this->db_name);
        
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        //llamada al procedimiento
        //$stid = oci_parse($conn, "BEGIN HOLA END;");

        // Consulta para invocar la función
        // $query = "SELECT HOLAHOLA AS SALUDO FROM DUAL";
        // $stid = oci_parse($conn, $query);

        // if (!$stid) {
        //     $e = oci_error($conn);
        //     die("Error al preparar la consulta: " . htmlentities($e['message']));
        // }

        // // Ejecutar la consulta
        // oci_execute($stid);

        // // Obtener el resultado
        // $row = oci_fetch_assoc($stid);

        // if ($row) {
        //     echo $row['SALUDO']; // Debería imprimir "HOLA"
        // } else {
        //     echo "No se obtuvo ningún resultado.";
        // }

        // // Liberar recursos
        // oci_free_statement($stid);
        // oci_close($conn);




            // return $conn;
    }


}

// $newconnection = new Connection("SYSTEM", "123", "XE");

// $newconnection->Connect()

// if($newconnection->Connect()){
//  echo "Conectado";   
// }






?>