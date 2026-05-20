<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar nota</title>
</head>
<body>
    <h3>Actualizar nota</h3>
    <form action="../procesar_actualizar_nota.php" method="POST">
        
        <label for="nota_id">Id de la nota para actualizar:</label>
        <input type="text" name="nota_id"><br><br>
    
        <label for="titulo">Nuevo título:</label>
        <input type="text" name="titulo"><br><br>

        <label for="contenido">Nuevo contenido:</label>
        <input type="text" name="contenido"><br><br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>