<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usamos las funciones de validar campos
    $nombre = validarCampo($_POST['nombre']);
    $email = validarEmail($_POST['email']);
    $password = validarCampo($_POST['password']);

    if ($nombre && $email && $password) {
        try {
            $usuario = new Usuario($nombre, $email, $password);
            $usuario->insertarUsuario($pdo);
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    } else {
        echo "Alguno de los campos no pasó la validación";
    }
}
?>
