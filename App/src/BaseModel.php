


<?php

include_once "Config/Connection.php";

class BaseModel
{
    public function __construct()
    {
       ;
    }


    public function ConnectToDataBase($user, $pass, $DBname)
    {
        $connection = new Connection($user, $pass, $DBname);
        $connection->Connect();
        return $connection->Connect();
    }
}




?>