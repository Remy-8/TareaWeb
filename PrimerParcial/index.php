<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de visitas</title>
    <link rel="stylesheet" href="styles.css">

</head>

<body>

<h1>Listado de visita al consultorio</h1>

<a href="registro.php">Registra nueva visita</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nombre Completo</th>
        <th>Cedula</th>
        <th>Edad</th>
        <th>Motivo</th>
        <th>Fecha y Hora</th>
    </tr>

    <?php 
    if (file_exists('visitas.txt')){
        $lineas = file('visitas.txt' , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            list($nombre, $apellido, $cedula, $edad, $motivo, $fecha) = explode('|', $linea);
            echo"<tr>";
            echo"<td>" . htmlspecialchars("$nombre $apellido") . "</td>";
            echo"<td>" . htmlspecialchars("$cedula") . "</td>";
            echo"<td>" . htmlspecialchars("$edad") . "</td>";
            echo"<td>" . htmlspecialchars("$motivo") . "</td>";
            echo"<td>" . htmlspecialchars("$fecha") . "</td>";
            echo"</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay visitas registradas.</td></tr>";
    }

    ?>

</table>

<div class ="footer-container">
<hr />
<footer>&copy; 2025 Emil Lopez 2024-0210</footer>
</div>

    
</body>
</html>