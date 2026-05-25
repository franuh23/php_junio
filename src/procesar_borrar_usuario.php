<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    try {
        // Usamos las funciones de validar campos
        $usuario_id = validarNumero($_POST['id']);

        if ($usuario_id) {
            $usuario = Usuario::recuperarUsuario($pdo, $usuario_id);

            if ($usuario) {
                $usuario->borrarUsuario($pdo);
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
