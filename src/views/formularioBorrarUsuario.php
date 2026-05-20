<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar usuario</title>
</head>
<body>
    <h3>Borrar usuario</h3>
    <form action="../procesar_borrar_usuario.php" method="POST">
        
        <label for="id">Introduce el ID del usuario a borrar:</label>
        <input type="text" name="id"><br><br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>