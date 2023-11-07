<?php
require 'bdconexion.php';

$mensaje = ''; // Inicializamos el mensaje vacío

if (isset($_GET['consecutivo'])) {
    $consecutivo = $_GET['consecutivo'];

    if (isset($_POST['eliminar'])) {
        // Confirmación de eliminación
        $confirmacion = $_POST['confirmacion'];

        if ($confirmacion === 'SI') {
            // Eliminar el registro correspondiente usando $consecutivo
            $eliminarRegistro = "DELETE FROM casos WHERE consecutivo='$consecutivo'";
            $ejecutarEliminacion = mysqli_query($conexion, $eliminarRegistro);

            if ($ejecutarEliminacion) {
                $mensaje = 'El caso se eliminó correctamente'; // Actualizamos el mensaje
                // Puedes redirigir o mostrar más contenido aquí si lo deseas
            } else {
                $mensaje = 'Error al eliminar el registro. Por favor, intenta de nuevo.';
            }
        } else {
            header("Location: buscador.php"); // Redirigir de regreso a la página de búsqueda sin eliminar
        }
    }

    // Consulta para obtener los datos del registro a eliminar
    $consultarDatos = "SELECT * FROM casos WHERE consecutivo='$consecutivo'";
    $resultado = mysqli_query($conexion, $consultarDatos);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
    } else {
        $mensaje = 'Registro no encontrado.';
    }
} else {
    $mensaje = 'Consecutivo de registro no proporcionado.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="logodatecsa.png">
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
</head>

<body>
    <h2>Eliminar Registro</h2>
    <?php if (!empty($mensaje)) : ?>
        <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <p>¿Estás seguro de que deseas eliminar este registro?</p>
        <label>
            <input type="radio" name="confirmacion" value="SI" required> SI
        </label>
        <label>
            <input type="radio" name="confirmacion" value="NO" required> NO
        </label>
        <br>
        <button type="submit" name="eliminar">Eliminar</button>
        <a href="buscador.php">
            <button type="button">Cancelar</button>
        </a>
    </form>
</body>

</html>
