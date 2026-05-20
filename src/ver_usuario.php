<?php

require_once "db/conexion.php";
require_once "models/Usuario.php";

$usuario = Usuario::verUsuario($pdo, 2);

if ($usuario) {
    echo "ID del usuario: " . $usuario['id'] . "<br>";
    echo "Nombre: " . $usuario['nombre'] . "<br>";
    echo "Email: " . $usuario['email'] . "<br>";
    echo "Fecha de registro: " . $usuario['fecha_registro'] . "<br>";
    echo "Contraseña: " . $usuario['password'] . "<br>";
} else {
    echo "Usuario no encontrado";
}

?>