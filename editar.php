<?php
require 'bdconexion.php';

if (isset($_GET['consecutivo'])) {
    $consecutivo = $_GET['consecutivo'];

    if (isset($_POST['guardar'])) {
        $caso = $_POST['caso'];
        $serie = $_POST['serie'];
        $orden = $_POST['orden'];
        $falla = $_POST['falla'];
        $ubicacion = $_POST['ubicacion']; 
        $ciudad = $_POST['ciudad'];
        $fechaInicio = $_POST['fecha_inicio'];
        $fechaFinal = $_POST['fecha_final'];
        $novedad = $_POST['novedad'];
        $estado = $_POST['estado'];

        $actualizarDatos = "UPDATE casos SET caso='$caso', serie='$serie', orden='$orden', falla='$falla', ubicacion='$ubicacion', ciudad='$ciudad', fecha_inicio='$fechaInicio', fecha_final='$fechaFinal', novedad='$novedad', estado='$estado' WHERE consecutivo=$consecutivo";

        $ejecutarActualizar = mysqli_query($conexion, $actualizarDatos);

        if ($ejecutarActualizar) {
            header("Location: buscador.php"); // Redirecciona a la página de inicio después de editar
        } else {
            echo '<div class="alert">Error al actualizar el registro. Por favor, intenta de nuevo.</div>';
        }
    }

    $consultarDatos = "SELECT * FROM casos WHERE consecutivo=$consecutivo";
    $resultado = mysqli_query($conexion, $consultarDatos);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
    } else {
        echo '<div class="alert">Registro no encontrado.</div>';
    }
} else {
    echo '<div class="alert">Consecutivo de registro no proporcionado.</div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="logodatecsa.png">
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
</head>

<body>
    <h2>Editar Registro</h2>
    <form action="" method="post">
        <input type="hidden" name="consecutivo" value="<?php echo $consecutivo; ?>">
        <label for="caso">Número de Caso:</label>
        <input type="text" id="caso" name="caso" value="<?php echo $fila['caso']; ?>" required>

        <label for="serie">Serial:</label>
        <input type="text" id="serie" name="serie" value="<?php echo $fila['serie']; ?>" required>

        <label for="orden">Número de Orden:</label>
        <input type="number" id="orden" name="orden" value="<?php echo $fila['orden']; ?>">

        <label for="falla">Describa la falla:</label>
        <input type="text" id="falla" name="falla" value="<?php echo $fila['falla']; ?>" required>

        <label for="ubicacion">Ubicación:</label>
        <select name="ubicacion" id="ubicacion" name="ubicacion" required>
            <option value="Ciudad principal" <?php if ($fila['ubicacion'] == 'Ciudad principal') echo 'selected'; ?>>Ciudad principal</option>
            <option value="Ciudad intermedia" <?php if ($fila['ubicacion'] == 'Ciudad intermedia') echo 'selected'; ?>>Ciudad intermedia</option>
            <option value="Ciudad lejana" <?php if ($fila['ubicacion'] == 'Ciudad lejana') echo 'selected'; ?>>Ciudad lejana</option>
        </select>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?php echo $fila['ciudad']; ?>" required>

        <label for="fecha-inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha-inicio" name="fecha_inicio" value="<?php echo $fila['fecha_inicio']; ?>" required>

        <label for="fecha-final">Fecha Final:</label>
        <input type="date" id="fecha-final" name="fecha_final" value="<?php echo $fila['fecha_final']; ?>">

        <label for="novedad">Novedad:</label>
        <input type="text" id="novedad" name="novedad" value="<?php echo $fila['novedad']; ?>">

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="Pendiente" <?php if ($fila['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="Resuelto" <?php if ($fila['estado'] == 'Resuelto') echo 'selected'; ?>>Resuelto</option>
            <option value="En curso" <?php if ($fila['estado'] == 'En curso') echo 'selected'; ?>>En curso</option>
        </select>

        <button type="submit" name="guardar">Guardar Cambios</button>
        <a href="buscador.php">
            <button type="button">Cancelar</button>
        </a>
    </form>
</body>

</html>
