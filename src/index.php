<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar cosas</title>
</head>
<body>
    <h1>Usuarios</h1>
    <?php
        require_once "db/conexion.php";
        require_once "models/Usuario.php";

        try {
            
            Usuario::listarUsuarios($pdo);
            
        } catch (PDOException $error) {
            echo "Error al listar usuarios" . $error->getMessage();
        }
    ?>

    <h1>Notas</h1>
    <?php
        require_once "db/conexion.php";
        require_once "models/Nota.php";

        try {
            
            Nota::listarNotas($pdo);
            
        } catch (PDOException $error) {
            echo "Error al listar notas" . $error->getMessage();
        }
    ?>
</body>
</html>