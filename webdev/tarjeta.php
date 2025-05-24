<?php 

$nombre = "Emil";

$apellido = "Lopez";

$edad = "19";

$carrera = "Desarrollo de software";

$universidad = "ITLA";
$mensaje = ($edad >= 18) ? "Eres mayor de edad" : "Eres menor de edad";

require('partes/head.php'); ?>

<table border= "10">
    <tr>
    <th>Nombre</th> <td><?php echo $nombre;?></td>
    </tr>
    <tr>
        <th>Apellido</th> <td><?php echo $apellido;?></td>
    </tr>
    <tr>
        <th>Edad</th> <td><?php echo $edad;?></td>
    </tr>
    <tr>
        <th>Carrera</th> <td><?php echo $carrera;?></td>
    </tr>
    <tr>
        <th>Universidad</th> <td><?php echo $universidad;?></td>
    </tr>

</table>

<h3><?= $mensaje; ?></h3>





<?php require('partes/foot.php'); ?>