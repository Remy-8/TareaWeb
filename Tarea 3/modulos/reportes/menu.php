<?php

include("../../libreria/principal.php");

define("PAGINA_ACTUAL", "estadisticas");

$personajes = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");

$edad_total = 0;
$excom = 0;

$salarios_graph = [];

$mayor_salario = null;
$menor_salario = null;




$personasXprofesion = [];
foreach ($profesiones as $profesion) {

     $salarios_graph[$profesion->nombre] = $profesion->salario_mensual;




if ($mayor_salario === null || $profesion->salario_mensual > $mayor_salario->salario_mensual) {
    $mayor_salario = $profesion;
}
if ($menor_salario === null || $profesion->salario_mensual < $menor_salario->salario_mensual) {
    $menor_salario = $profesion;
}



    if (!isset($personasXprofesion[$profesion->idx])) {
        $personasXprofesion[$profesion->idx] = [
            'nombre' => $profesion->nombre,
            'cantidad' => 0
        ];
    }

}

foreach ($personajes as $personaje) {
    $edad_total += $personaje->edad();
    $excom += $personaje->nivel_experiencia;
    if (isset($personasXprofesion[$personaje->profesion])) {
        $personasXprofesion[$personaje->profesion]['cantidad']++;
    }
}
$eprom = $edad_total / count($personajes);
$excom = $excom / count($personajes);

$data = [
    'personajes' => count($personajes),
    'profesiones' => count($profesiones),
    'edad_promedio' => $eprom,
    'nivel_experiencia_comun' => $excom,

];


plantilla::aplicar();

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="mb-4 text-center">📊 Estadísticas del Mundo Barbie</h1>

    <!-- Cards Resumen -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card shadow-sm border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">👥 Personajes Registrados</h5>
                    <p class="display-6 fw-bold text-primary"> <?= $data['personajes'] ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-success">
                <div class="card-body text-center">
                    <h5 class="card-title">🏆 Profesiones Registradas</h5>
                    <p class="display-6 fw-bold text-success"> <?= $data['profesiones'] ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-warning">
                <div class="card-body text-center">
                    <h5 class="card-title">🎂 Edad Promedio</h5>
                    <p class="display-6 fw-bold text-warning"> <?= number_format($data['edad_promedio'], 0) ?> años</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribución por categoría -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">📂 Distribución por Categoría</h5>
                    <ul class="list-group">

                        <?php
                        foreach ($personasXprofesion as $idx => $fila){
                            echo "<li class='list-group-item'>{$fila['nombre']}: {$fila['cantidad']} personajes</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Nivel de experiencia más común -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">⭐ Nivel de Experiencia más Común</h5>
                    <p class="fs-4"> <?= number_format($data['nivel_experiencia_comun'], 2) ?> años</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profesiones con salario más alto y más bajo -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h5 class="card-title">💰 Profesión Mejor Pagada</h5>
                    <p class="fs-5 mb-0"> <? $mayor_salario;?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h5 class="card-title">💼 Profesión Peor Pagada</h5>
                    <p class="fs-5 mb-0"><?= $menor_salario;?></p>
            </div>
        </div>
    </div>

    <!-- Salario promedio y personaje top -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">💸 Salario Promedio en Barbie World</h5>
                    <p class="fs-3 text-success">RD$ 65,000</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">👑 Personaje con Mayor Salario</h5>
                    <p class="fs-4 mb-1">Barbie CEO</p>
                    <small>Salario: RD$ 200,000 | Profesión: Ejecutiva</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de salario por categoría -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h5 class="card-title text-center">📊 Salario Promedio por Categoría</h5>
            <canvas id="graficoSalarios" height="150"></canvas>
        </div>
    </div>
</div>
<?php

$labels = array_keys($salarios_graph);
$datos = array_values($salarios_graph);
?>

<script>
    const ctx = document.getElementById('graficoSalarios').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Salario Promedio (RD$)',
                data: <?= json_encode($datos) ?>,
                backgroundColor: ['#0d6efd', '#6610f2', '#198754', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>