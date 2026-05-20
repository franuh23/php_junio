<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usamos las funciones de validar campos
    $id = validarNumero($_POST['id']);
    $nuevoNombre = validarCampo($_POST['nombre']);
    $nuevoEmail = validarEmail($_POST['email']);

    if ($id && $nuevoNombre && $nuevoEmail) {
        try {
            $usuario = new Usuario($nuevoNombre, $nuevoEmail, 0);
            $usuario->actualizarUsuario($pdo, $id);
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    } else {
        echo "Alguno de los campos no pasó la validación";
    }
}
?>
