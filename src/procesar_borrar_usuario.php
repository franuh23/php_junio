<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usamos las funciones de validar campos
    $usuario_id = validarNumero($_POST['id']);

    if ($usuario_id) {
        try {
            $usuario = new Usuario('','', 0);
            $usuario->borrarUsuario($pdo, $usuario_id);
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    } else {
        echo "El ID del usuario no es válido";
    }
}
?>
