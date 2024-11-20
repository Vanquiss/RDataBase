



<?php



include ("Config.php");


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
        $conn = oci_connect($this->db_user, $this->db_pass, '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=5500)))(CONNECT_DATA=(SERVICE_NAME=XE)))', 'AL32UTF8');

        //$conn_string = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=$this->db_name)))";
        $conn = oci_connect($this->db_user, $this->db_pass,$conn); //$this->db_name);

        //$this->conn = oci_connect($this->db_user, $this->db_pass, $this->db_name);
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }


        return $conn;
    }


}

$model = new Connection("SYSTEM", "changeme", "XE");



if($model->Connect()){
    echo 'hola';
}


?>