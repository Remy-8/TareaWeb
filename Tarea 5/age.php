<?php
$name = $_GET['name'] ?? '';
$age = '';
$category = '';
$image = '';
$error = '';

if ($name) {
    $url = "https://api.agify.io/?name=" . urlencode($name);
    $response = @file_get_contents($url);

    if ($response === false) {
        $error = "No se pudo conectar con la API.";
    } else {
        $data = json_decode($response, true);
        $age = $data['age'] ?? '';

        if ($age !== '') {
            if ($age < 18) {
                $category = 'Joven 👶';
                $image = 'https://cdn-icons-png.flaticon.com/512/2913/2913465.png';
            } elseif ($age < 60) {
                $category = 'Adulto 🧑';
                $image = 'https://cdn-icons-png.flaticon.com/512/1998/1998592.png';
            } else {
                $category = 'Anciano 👴';
                $image = 'https://cdn-icons-png.flaticon.com/512/1998/1998749.png';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Predicción de Edad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-4">
    <h2>Predicción de Edad</h2>
    <form method="GET" class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Introduce un nombre..." required>
        <button type="submit" class="btn btn-primary mt-2">Estimar</button>
    </form>

    <?php if ($age !== ''): ?>
        <h3>Edad estimada: <?= $age ?> años</h3>
        <p><?= $category ?></p>
        <img src="<?= $image ?>" width="100" alt="Categoría de edad">
    <?php elseif ($error): ?>
        <div class="alert alert-warning"><?= $error ?></div>
    <?php endif; ?>
</div>
</body>
</html>
