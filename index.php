<?php
require 'bdconexion.php';
?>

<?php
if (isset($_POST['Agregar_Caso'])) {

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
    $fechaCreacion = date("Y-m-d H:i:s"); // Obtiene la fecha y hora actual

    $insertarDatos = "INSERT INTO casos (caso, serie, orden, falla, ubicacion, ciudad, fecha_inicio, fecha_final, novedad, estado, fecha_creacion) VALUES ('$caso','$serie','$orden','$falla','$ubicacion', '$ciudad', '$fechaInicio', '$fechaFinal','$novedad', '$estado', '$fechaCreacion')";


    $ejecutarInsertar = mysqli_query($conexion, $insertarDatos);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="logodatecsa.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Casos de Soporte</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="logo-container">
        <img src="logodatecsa.png" alt="Logo Datecsa" class="logo">
        </div>
        <strong>
            <h1>Monitoreo Casos de Soporte</h1>
        </strong>
    </header>

    <?php
    error_reporting(E_ERROR | E_PARSE); //Función para ocultar los errores "WARNING" de php
    if ($ejecutarInsertar) {
        // Inserción correcta
        echo '<div class="success">¡Caso registrado correctamente!</div>';
    }
    ?>

    <!-- Formulario para agregar un caso de soporte -->
    <section id="agregar-caso">
        <h2>Agregar Caso de Soporte</h2>

        <form action="index.php" method="post">
            <label for="caso"># Caso:</label>
            <input type="text" id="caso" name="caso" required>

            <label for="serie">Serial:</label>
            <input type="text" id="serie" name="serie" required>

            <label for="orden">Número de Orden (Opcional):</label>
            <input type="number" id="orden" name="orden">

            <label for="falla">Describa la falla:</label>
            <input type="text" id="falla" name="falla" required>

            <label for="ubicacion">Ubicación:</label>
            <select name="ubicacion" id="ubicacion" name="ubicacion" required>
                <option value="Ciudad principal">Ciudad principal</option>
                <option value="Ciudad intermedia">Ciudad intermedia</option>
                <option value="Ciudad lejana">Ciudad lejana</option>
            </select>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required>

            <label for="fecha-inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha-inicio" name="fecha_inicio" required>

            <label for="fecha-final">Fecha Final (Opcional):</label>
            <input type="date" id="fecha-final" name="fecha_final">

            <label for="novedad">Novedad (Opcional):</label>
            <input type="text" id="novedad" name="novedad">

            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="Pendiente">Pendiente</option>
                <option value="Resuelto">Resuelto</option>
                <option value="En curso">En curso</option>
            </select>

            <button type="submit" name="Agregar_Caso">Agregar Caso</button>
            <button type="reset" name="reset">Restablecer</button>
            <a href="buscador.php">
                <button type="button">Filtrar</button>
            </a>
        </form>
    </section>

    <footer>
        <strong>
            <p>&copy; 2023 Control de Casos de Soporte DATECSA</p>
        </strong>
    </footer>
</body>

</html>

<script>
    history.replaceState(null, null, location.pathname); //Función para que no se reenvíe automáticamente el formulario
</script>