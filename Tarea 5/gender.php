<?php
$name = $_GET['name'] ?? '';
$gender = '';
$error = '';

if ($name) {
    $url = "https://api.genderize.io/?name=" . urlencode($name);
    $response = @file_get_contents($url);

    if ($response === false) {
        $error = "No se pudo conectar con la API.";
    } else {
        $data = json_decode($response, true);

        if ($data && isset($data['gender']) && $data['gender'] !== null) {
            $gender = $data['gender'];
        } else {
            $error = "La API no devolvió un género para ese nombre.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Predicción de Género</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-4">
    <h2>Predicción de Género</h2>
    <form method="GET" class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Introduce un nombre..." value="<?= htmlspecialchars($name) ?>" required />
        <button type="submit" class="btn btn-primary mt-2">Predecir</button>
    </form>

    <?php if ($gender): ?>
        <?php
            $color = $gender === 'male' ? 'text-primary' : ($gender === 'female' ? 'text-danger' : 'text-muted');
            $icon = $gender === 'male' ? '💙' : ($gender === 'female' ? '💖' : '');
        ?>
        <h3 class="<?= $color ?>">Resultado: <?= ucfirst($gender) ?> <?= $icon ?></h3>
    <?php elseif ($error): ?>
        <div class="alert alert-warning"><?= $error ?></div>
    <?php endif; ?>
</div>
</body>
</html>
