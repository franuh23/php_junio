<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";

try {
    $usuario = new Usuario(5, "Pepe", "pepe@gmail.com", "1234");

    $usuario->insertarUsuario($pdo);

} catch (PDOException $error) {
    echo "Error en la inserción" . $error->getMessage();
}
?>