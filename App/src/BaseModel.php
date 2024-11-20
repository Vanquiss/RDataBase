


<?

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
        return $connection->Connect();
    }
}

?>