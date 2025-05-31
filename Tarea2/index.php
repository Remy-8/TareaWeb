<?php

include('libreria/main.php');
plantilla::aplicar();
?>

<div class="text-end mb-3">
    <a href="editar.php" class="btn btn-primary">Agregar</a>
</div>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th> <th scope="col">Tipo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Autor</th>
            <th scope="col">Pais</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>

    <tbody>
        
        <?php

        if (is_dir(filename: 'datos')) {

            $archivos = scandir(directory: 'datos');

            foreach ($archivos as $archivo) {
                $ruta = 'datos/' . $archivo;
                if (is_file(filename: $ruta)) {
                    $json = file_get_contents(filename: $ruta);
                    $obra = json_decode(json: $json);
                    ?>
                    <tr>
                        <td><img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="100"></td> <td><?= Datos::Tipos_de_Obra()[$obra->tipo] ?></td>
                        <td><?= $obra->nombre ?></td>
                        <td><?= $obra->autor ?></td>
                        <td><?= $obra->pais ?></td>
                        <td>
                            <a href="editar.php?codigo=<?= $obra->codigo ?>" class="btn btn-warning">Editar</a>
                            <a href="detalle.php?codigo=<?= $obra->codigo ?>" class="btn btn-danger">Detalles</a>
                            <a href="personajes.php?codigo=<?= $obra->codigo ?>" class="btn btn-info">Personajes</a>

                        </td>
                    </tr>
                        <?php
                }
            }
        }
        ?>
    </tbody>
</table>