
<?php

include '../BaseController.php';

class EmployeeController extends BaseController
{
   


    public function CreateEmployee(EmployeeStruct $EmployeeData)
    {
        $NewEmployee = new EmployeeModel();
        $NewEmployee->NewEmployee($EmployeeData);
    }
    



    public function EmployeeList()
    {
        
    }
    


}

?>