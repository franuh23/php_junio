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
            
            $usuarios = Usuario::listarUsuarios($pdo);

            foreach ($usuarios as $usuario) {
                echo "Nombre: " . $usuario['nombre'] . "<br>";
                echo "Email: " . $usuario['email'] . "<br>";
                echo "Fecha de registro: " . $usuario['fecha_registro'] . "<br><br>";
            }
            
        } catch (PDOException $error) {
            echo "Error al listar usuarios" . $error->getMessage();
        }
    ?>

    <h1>Notas</h1>
    <?php
        require_once "db/conexion.php";
        require_once "models/Nota.php";

        try {

            $notas = Nota::listarNotas($pdo);
            
            // corregir esto
            foreach ($notas as $nota) {
                echo "Nombre: " . $nota['nombre'] . "<br>";
                echo "Email: " . $nota['email'] . "<br>";
                echo "Fecha de registro: " . $nota['fecha_registro'] . "<br><br>";
            }
            
            
        } catch (PDOException $error) {
            echo "Error al listar notas" . $error->getMessage();
        }
    ?>
</body>
</html>