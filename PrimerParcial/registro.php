<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar visita</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registrar nueva visita</h1>

    <form action="procesar_registro.php" method="post">
        Nombre: <input type="text" name="nombre" required><br>
        Apellido: <input type="text" name="apellido" required><br>
        Cedula: <input type="text" name="cedula" required><br>
        Edad: <input type="number" name="edad" required><br>
        Motivo: 
        <input list="motivos" name="motivo" required>
        <datalist id="motivos">
            <option value="Limpieza">
            <option value="Dolor">
            <option value="Caries">
            <option value="Chequeo">
        </datalist>
        <br></br>
        <button type="submit">Registrar</button>
        <button type="button" onclick="window.location.href='index.php'" class="cancelar">Cancelar</button>

    </form>
    
</body>
</html>