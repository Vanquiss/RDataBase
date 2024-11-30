<?php
// Inicia el buffer de salida para prevenir errores de encabezados
ob_start();

require_once "../src/Controllers/LoginController.php"; 
require_once "../src/Models/LoginModel.php"; 

// Manejo del formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginData = [
        'username' => $_POST['username'] ?? '',
        'password' => $_POST['password'] ?? ''
    ];

    // Crea una instancia del controlador de login
    $login = new LoginController();
    $isValid = $login->validateLogin($loginData);

    if ($isValid) {
        // Redirige al panel si el login es válido
        header("Location: dist/pages/panel.php");
        //debug
        
       

        echo "
            <div class='container my-4'>
                <div class='alert alert-success' role='alert'>
                    <strong>¡Éxito!</strong> Inicio de sesión exitoso.
                </div>
            </div>
            ";

        return true;
        exit();
    } else {
       
            echo "
                <div class='container my-4'>
                    <div class='alert alert-danger' role='alert'>
                        <strong>Error:</strong> Usuario o Contraseña incorrectos.
                    </div>
                </div>
            ";
        
        //exit();
    }
}

// Finaliza el buffer de salida
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AdminLTE 4 | Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.css">
</head>
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="login-logo"> 
            <a href="../index2.html"><b>Administracion</b>APP</a> 
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">INICIO DE SESION</p>
                <form action="index.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
</body>
</html>
