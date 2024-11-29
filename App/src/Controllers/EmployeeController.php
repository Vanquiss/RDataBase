
<?php

include_once __DIR__ . '/../BaseController.php';

class EmployeeController extends BaseController
{
   


    public function CreateEmployee($EmployeeData)
    {
        $NewEmployee = new EmployeeModel();
        $NewEmployee->NewEmployee($EmployeeData);
    }

    public function handleJsonMessage($jsonMessage)
    {
        $message = json_decode($jsonMessage, true);

        // Verificar la acción
        match ($message['action']) {
            'create_employee' => $this->createEmployee($message['data']),
            'update_employee' => $this->updateEmployee($message['data']),
            //default => $this->sendErrorResponse("Acción no reconocida")
        };
    }

    public function updateEmployee($data)
    {
        $Employee = new EmployeeModel();
        $Employee->UpdateEmployee($data);
    }

    public function deleteEmployee($data)
    {
        $Employee = new EmployeeModel();
        $Employee->deleteEmployee($data);
    }

    public function getEmployees($data)
    {
        $Employee = new EmployeeModel();
        $Employees = $Employee->getEmployee($data);
        return $Employees;
    }


    public function queryCallback($data)
    {
        //$Employee = new EmployeeModel();
        //$Employee->EmployeeList();
    }



    public function EmployeeList()
    {
        
    }
    


}

?>