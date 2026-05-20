<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar nota</title>
</head>
<body>
    <h3>Borrar nota</h3>
    <form action="../procesar_borrar_nota.php" method="POST">
        
        <label for="id">Introduce el ID de la nota a borrar:</label>
        <input type="text" name="id"><br><br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>