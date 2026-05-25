<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Usamos las funciones de validar campos
        $nombre = validarCampo($_POST['nombre']);
        $email = validarEmail($_POST['email']);
        $password = validarCampo($_POST['password']);

        if ($nombre && $email && $password) {
            $usuario = new Usuario($nombre, $email, $password);
            $usuario->insertarUsuario($pdo);
        } else {
            echo "Error al recuperar los valores del formulario";
        }
    } catch (Exception $error) {
        echo "Error: " . $error->getMessage();
    }
} else {
    echo "Error al enviar el formulario";
}
?>
