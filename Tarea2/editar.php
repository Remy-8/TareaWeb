<?php

include('libreria/main.php');

$obra = new Obra();

if(isset($_GET['id'])){
    $ruta = 'datos/' . $_GET['id'].'.json';
    if(is_file(filename: $ruta)){
        $json = file_get_contents(filename: $ruta);
        $obra = json_decode(json: $json);
    }
}
if($_POST){
    $obra->codigo = $_POST['codigo'];
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

    if(!is_dir(filename: 'datos')){
        mkdir(directory: 'datos');
    }

    if(!is_dir(filename: 'datos')){
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Error al crear el directorio de datos.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        exit();
    }

    $ruta ='datos/' . $obra->codigo . '.json';

    $json = json_encode(value: $obra);

    file_put_contents(filename: $ruta, data: $json);

    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra guardada correctamente.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}
    

plantilla::aplicar();
?>

<form method="post" action="editar.php">

   <!--codigo -->
    <div class="mb-3">
        <label for="codigo" class="form-label">Codigo</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $obra->codigo ?>" required>
    </div>

   <!-- /*foto*/ -->
    <div class="mb-3">
        <label for="foto_url" class="form-label">Foto</label>
        <input type="text" class="form-control" id="foto_url" name="foto_url" value="<?= $obra->foto_url ?>" required>
    </div>


  <!--   /*tipo*/ -->
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select class="form-select" id="tipo" name="tipo">
            <option value="pelicula">Pelicula</option>
            <?php
            $selected = $obra->tipo;
            foreach (Datos::Tipos_de_Obra() as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            ?>
        </select>
    </div>


    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $obra->nombre ?>" required>
    </div>
 <!--    /*descripcion*/ -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $obra->descripcion ?>" required>
    </div>

  <!--   /*pais*/ -->
    <div class="mb-3">
        <label for="pais" class="form-label">pais</label>
        <input type="text" class="form-control" id="pais" name="pais" value="<?= $obra->pais ?>" required>
    </div>

  <!--   /*autor*/ -->
    <div class="mb-3">
        <label for="autor" class="form-label">autor</label>
        <input type="text" class="form-control" id="autor" name="autor" value="<?= $obra->autor ?>" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>