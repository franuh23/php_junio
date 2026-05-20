<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar usuario</title>
</head>
<body>
    <h3>Actualizar usuario</h3>
    <form action="../procesar_actualizar_usuario.php" method="POST">
        
        <label for="id">ID del usuario para actualizar:</label>
        <input type="text" name="id"><br><br>

        <label for="nombre">Nuevo nombre:</label>
        <input type="text" name="nombre"><br><br>

        <label for="nombre">Nuevo email:</label>
        <input type="text" name="email"><br><br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>