<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Usamos las funciones de validar campos
        $id = validarNumero($_POST['id']);
        $nuevoNombre = validarCampo($_POST['nombre']);
        $nuevoEmail = validarEmail($_POST['email']);

        if ($id && $nuevoNombre && $nuevoEmail) {
            $usuario = Usuario::recuperarUsuario($pdo, $id);

            if ($usuario) {
                $usuario->actualizarUsuario($pdo); 
            } else {
                echo "El usuario no existe";
            }
            
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
