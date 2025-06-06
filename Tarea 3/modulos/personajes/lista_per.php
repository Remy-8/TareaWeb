<?php

include("../../libreria/principal.php");

define("PAGINA_ACTUAL", "personajes");

plantilla::aplicar();

$personajes = Dbx::list("personajes");

?>
<h3>Listado de personajes</h3>

<div class="text-end mb-3">
    <a href="<?= base_url("modulos/personajes/editar.php"); ?>" class="btn btn-success">Nuevo Personaje</a>
</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Experiencia</th>
                <th>Profesión</th>
                
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($personajes as $personaje): ?> 
            <tr>
                <td><?php echo htmlspecialchars($personaje->nombre); ?></td>
                <td><?php echo htmlspecialchars($personaje->edad()); ?></td>
                <td><?php echo htmlspecialchars($personaje->nivel_experiencia); ?></td>
                <td><?php echo htmlspecialchars($personaje->profesion); ?></td>
                <td>
                    <a href="<?= base_url("modulos/personajes/editar.php?codigo={$personaje->idx}"); ?>" class="btn btn-primary">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
    