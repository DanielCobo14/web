<?php

// Se utiliza para llamar al archivo que contine la conexion a la base de datos
require 'bdconexion.php';

// Validamos que el formulario y que el boton login haya sido presionado
if (isset($_POST['login'])) {

    // Obtener los valores enviados por el formulario
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Ejecutamos la consulta a la base de datos utilizando la función mysqli_query
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' and contraseña = '$contraseña'";
    $resultado = mysqli_query($conexion, $sql);
    $numero_registros = mysqli_num_rows($resultado);
    if ($numero_registros != 0) {
        // Inicio de sesión exitoso
        header("Location: index.php");
    } else {
        // Credenciales inválidas
        echo '<div class="alert">Credenciales inválidas. Por favor, verifica tu usuario y/o contraseña.</div><br>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="icon_user.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2 class="loginTitulo">INICIA SESIÓN</h2>

        <form action="login.php" method="post">

            <div class="form-group2">
                <label for="usuario"><i class="fas fa-user"></i> Usuario: </label>
                <input type="text" placeholder="Ingresa tu usuario:" name="usuario" class="form-control">
            </div>

            <div class="form-group2">
                <label for="contraseña"><i class="fas fa-lock"></i> Contraseña: </label>
                <input type="password" placeholder="Ingresa tu contraseña:" name="contraseña" class="form-control">
            </div>

            <div class="form-btn2">
                <button type="submit" value="login" name="login" class="btn btn-primary">¡Iniciar sesión!</button>
            </div>
        </form>
    </div><br>

</body>

</html>

<script>
    history.replaceState(null, null, location.pathname); //Función para que no se reenvíe automáticamente el formulario
</script>