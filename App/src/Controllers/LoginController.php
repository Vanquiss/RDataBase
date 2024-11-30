
<?php

include_once __DIR__ . '/../BaseController.php';

class LoginController extends BaseController
{
   

    public function ValidateLogin($loginData)
    {
        $loginModel = new LoginModel();
        $login = $loginModel->ValidLogin($loginData);
        return $login;
    }


    


}

?>