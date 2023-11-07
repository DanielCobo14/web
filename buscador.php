<?php
require 'bdconexion.php';

if (isset($_POST['buscar'])) {
    $filtro = $_POST['filtro'];
    $valor = $_POST['valor'];

    // Consulta SQL según el filtro seleccionado
    $sql = "SELECT * FROM casos WHERE $filtro LIKE '%$valor%'";
    $resultado = mysqli_query($conexion, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="lupa.png">
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="temporizador.js"></script>

</head>

<body>
    <h2>Buscador</h2>
    <form action="" method="post">
        <label for="filtro">Seleccione un filtro:</label>
        <select name="filtro" id="filtro">
            <option value="caso">Número de Caso</option>
            <option value="fecha_inicio">Fecha de Inicio</option>
            <option value="estado">Estado</option>
        </select>

        <input type="text" name="valor" placeholder="Ingrese el valor a buscar">
        <button class="Buscar" type="submit" name="buscar">Consultar</button><br>
        <a href="index.php">
            <button class="Regresar" type="button">Regresar al Inicio</button>
        </a>

        <a href="generar_pdf.php">
            <button class="PDF" target="_blank">Descargar reporte en PDF</button>
        </a>

    </form><br>

    <?php if (isset($resultado)) : ?>
        <table>
            <thead>
                <tr>
                    <th># Caso</th>
                    <th>Serial</th>
                    <th>Número de Orden</th>
                    <th>Falla</th>
                    <th>Ubicación</th>
                    <th>Ciudad</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha final</th>
                    <th>Novedad</th>
                    <th>Estado</th>
                    <th>Consecutivo</th>
                    <th>Tiempo de atención</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) : ?>
                    <tr>
                        <td><?php echo $fila['caso']; ?></td>
                        <td><?php echo $fila['serie']; ?></td>
                        <td><?php echo $fila['orden']; ?></td>
                        <td><?php echo $fila['falla']; ?></td>
                        <td><?php echo $fila['ubicacion']; ?></td>
                        <td><?php echo $fila['ciudad']; ?></td>
                        <td><?php echo $fila['fecha_inicio']; ?></td>
                        <td><?php echo $fila['fecha_final']; ?></td>
                        <td><?php echo $fila['novedad']; ?></td>
                        <td><?php echo $fila['estado']; ?></td>
                        <td><?php echo $fila['consecutivo']; ?></td>
                        <td>
                            <?php
                            $tiempoInicial = strtotime($fila['fecha_creacion']);
                            $ubicacion = $fila['ubicacion'];

                            // Calcular el tiempo restante según la ubicación
                            switch ($ubicacion) {
                                case 'Ciudad principal':
                                    $tiempoLimite = $tiempoInicial + 2 * 3600; // 2 horas
                                    break;
                                case 'Ciudad intermedia':
                                    $tiempoLimite = $tiempoInicial + 4 * 3600; // 4 horas
                                    break;
                                case 'Ciudad lejana':
                                    $tiempoLimite = $tiempoInicial + 16 * 3600; // 16 horas
                                    break;
                                default:
                                    $tiempoLimite = $tiempoInicial;
                                    break;
                            }

                            // Calcular el tiempo restante en segundos
                            $tiempoRestante = $tiempoLimite - time();

                            $horasRestantes = floor($tiempoRestante / 3600);
                            $minutosRestantes = floor(($tiempoRestante % 3600) / 60);

                            // Agregar la clase correspondiente para el color
                            $colorClass = 'color-green';
                            if ($tiempoRestante <= 3600) {
                                $colorClass = 'color-yellow';
                            }
                            if ($tiempoRestante <= 0) {
                                $colorClass = 'color-red';
                            }
                            ?>
                            <span class="temporizador <?php echo $colorClass; ?>">
                                <?php echo ($tiempoRestante <= 0) ? 'CASO VENCIDO' : "$horasRestantes h $minutosRestantes min"; ?>
                            </span>

                        </td>
                        <td>
                            <a class="Acciones" href="editar.php?consecutivo=<?php echo $fila['consecutivo']; ?>">Editar |</a>
                            <a class="Acciones" href="eliminar.php?consecutivo=<?php echo $fila['consecutivo']; ?>"> Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <script>
        history.replaceState(null, null, location.pathname); //Función para que no se reenvíe automáticamente el formulario
    </script>
</body>

</html>