<?php
$country = $_GET['country'] ?? '';
$universities = [];
$error = '';

if ($country) {
    $url = "http://universities.hipolabs.com/search?country=" . urlencode($country);
    $response = @file_get_contents($url);

    if ($response === false) {
        $error = "No se pudo obtener información de universidades.";
    } else {
        $universities = json_decode($response, true);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Universidades por País</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-4">
    <h2>Buscar Universidades</h2>
    <form method="GET" class="mb-3">
        <input type="text" name="country" class="form-control" placeholder="Ejemplo: Dominican Republic" required>
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    <?php if ($universities): ?>
        <ul class="list-group">
            <?php foreach ($universities as $uni): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($uni['name']) ?></strong><br>
                    Dominio: <?= htmlspecialchars($uni['domains'][0]) ?><br>
                    <a href="<?= htmlspecialchars($uni['web_pages'][0]) ?>" target="_blank" rel="noopener noreferrer">Visitar sitio</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
</div>
</body>
</html>
