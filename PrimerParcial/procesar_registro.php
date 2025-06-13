<?php 
date_default_timezone_set('America/Santo_Domingo');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido']; 
$cedula = $_POST['cedula'];
$edad = $_POST['edad'];
$motivo = $_POST['motivo'];
$fecha = date("Y-m-d H:i:s");

$linea = "$nombre|$apellido|$cedula|$edad|$motivo|$fecha\n";

file_put_contents('visitas.txt', $linea, FILE_APPEND);

header('Location: index.php');
exit;


?>
