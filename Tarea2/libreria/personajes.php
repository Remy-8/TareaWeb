<?php

include('libreria/main.php');

$obra = new Obra();

if (isset($_GET['id'])) {
    $ruta = 'datos/' . $_GET['id'] . '.json';

    if (is_file($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
    } else {
        plantilla::aplicar();
        echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
        exit();
    }
} else {
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
    exit();
}
