


<?php

include_once __DIR__ . '/../Controllers/JobsController.php';
include_once __DIR__ . '/../Models/JobModel.php';


class JobView
{
    private $controller;

    public function __construct(JobsController $controller)
    {
        $this->controller = $controller;
    }

    public function sendMessageToController($action, $data) {
        // Crear el mensaje JSON
        $message = json_encode([
            'action' => $action,
            'data' => $data
        ]);

        // Pasar el mensaje al controlador
        $this->controller->handleJsonMessage($message);
    }

  
}



?>








<?php


// echo "<h1>Insertar Empleado</h1>";
//         echo "<form action='personal.php' method='post'>
//                 <label for='name'>Nombre:</label>
//                 <input type='text' name='name' id='name' required>
//                 <br>
//                 <label for='last_name'>Apellido:</label>
//                 <input type='text' name='last_name' id='last_name' required>
//                 <br>
//                 <label for='salary'>Salario:</label>
//                 <input type='number' name='salary' id='salary' required>
//                 <br>
//                 <label for='hire_date'>Fecha de Contratación:</label>
//                 <input type='date' name='hire_date' id='hire_date' required>
//                 <br>
//                 <label for='job_id'>ID de Trabajo:</label>
//                 <input type='text' name='job_id' id='job_id' required>
//                 <br>
//                 <label for='bank_name'>Nombre del Banco:</label>
//                 <input type='text' name='bank_name' id='bank_name' required>
//                 <br>
//                 <label for='account_type'>Tipo de Cuenta:</label>
//                 <input type='text' name='account_type' id='account_type' required>
//                 <br>
//                 <label for='account_number'>Número de Cuenta:</label>
//                 <input type='number' name='account_number' id='account_number' required>
//                 <br>
//                 <input type='submit' value='Insertar'>
//               </form>";

//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $EmployeeData = new EmployeeStruct($_POST['name'], $_POST['last_name'], $_POST['salary'], $_POST['hire_date'], $_POST['bank_name'], $_POST['account_type'], $_POST['account_number'], $_POST['job_id']);
//             $this->controller->CreateEmployee($EmployeeData);
//         }


?>