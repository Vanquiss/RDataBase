



<?php



include ("Config.php");

//include(__DIR__ . "/Models.php"); // Ruta relativa



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
        




        return $conn;
    }


}

// $newconnection = new Connection("SYSTEM", "123", "XE");

// $newconnection->Connect();

// if($newconnection->Connect()){
//  echo "Conectado";   
// }


// $sql =  "BEGIN RCJNFRJR_INSERT_EMPLOYEE(
//     'juanPHP2',        -- first_name
//     'juanin',         -- last_name
//     570000,         -- salary (sin punto como separador decimal, si es un número entero)
//     SYSDATE,
//     'BANCOESTADO',
//     'CORRIENTE',
//     123
//  );
//  END;";

// // Prepara la consulta

// $conn = $newconnection->Connect();
// $stid = oci_parse($conn, $sql);

// // Ejecutar la consulta
// if (!oci_execute($stid)) {
// $e = oci_error($stid);
// throw new Exception("Error al ejecutar el procedimiento: " . htmlentities($e['message']));
// }

// oci_close($conn);

// Ruta relativa


?>