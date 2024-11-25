


<?php

include_once '../Controllers/EmployeeController.php';

class EmployeeView
{
    private $controller;

    public function __construct(EmployeeController $controller)
    {
        $this->controller = $controller;
    }

    public function InsertEmployee()
    {
        echo "<h1>Insertar Empleado</h1>";
        echo "<form action='index.php' method='post'>
                <label for='name'>Nombre:</label>
                <input type='text' name='name' id='name' required>
                <br>
                <label for='last_name'>Apellido:</label>
                <input type='text' name='last_name' id='last_name' required>
                <br>
                <label for='salary'>Salario:</label>
                <input type='number' name='salary' id='salary' required>
                <br>
                <label for='hire_date'>Fecha de Contratación:</label>
                <input type='date' name='hire_date' id='hire_date' required>
                <br>
                <label for='job_id'>ID de Trabajo:</label>
                <input type='text' name='job_id' id='job_id' required>
                <br>
                <label for='bank_name'>Nombre del Banco:</label>
                <input type='text' name='bank_name' id='bank_name' required>
                <br>
                <label for='account_type'>Tipo de Cuenta:</label>
                <input type='text' name='account_type' id='account_type' required>
                <br>
                <label for='account_number'>Número de Cuenta:</label>
                <input type='text' name='account_number' id='account_number' required>
                <br>
                <input type='submit' value='Insertar'>
              </form>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $EmployeeData = new EmployeeStruct($_POST['name'], $_POST['last_name'], $_POST['salary'], $_POST['hire_date'], $_POST['job_id'], $_POST['bank_name'], $_POST['account_type'], $_POST['account_number']);
            $this->controller->CreateEmployee($EmployeeData);
        }
    }

    // public function ShowEmployees()
    // {
    //     $empleados = $this->controller->EmployeeList();

    //     echo "<h1>Lista de Empleados</h1>";
    //     echo "<table border='1'>
    //             <tr>
    //                 <th>ID</th>
    //                 <th>Nombre</th>
    //                 <th>Apellido</th>
    //                 <th>Salario</th>
    //             </tr>";

    //     foreach ($empleados as $empleado) {
    //         echo "<tr>
    //                 <td>{$empleado['EMPLOYEE_ID']}</td>
    //                 <td>{$empleado['FIRST_NAME']}</td>
    //                 <td>{$empleado['LAST_NAME']}</td>
    //                 <td>{$empleado['SALARY']}</td>
    //               </tr>";
    //     }

    //     echo "</table>";
    // }
}
?>