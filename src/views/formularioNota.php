<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario nota</title>
</head>
<body>
    <h3>Insertar nota</h3>
    <form action="../procesar_insertar_nota.php" method="POST">
        
        <label for="titulo">Título:</label>
        <input type="text" name="titulo"><br><br>

        <label for="contenido">Contenido:</label>
        <input type="text" name="contenido"><br><br>

        <label for="usuario_id">Id del usuario:</label>
        <input type="text" name="usuario_id"><br><br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>