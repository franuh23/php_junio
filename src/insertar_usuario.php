<?php
require_once "db/conexion.php";
require_once "models/Usuario.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobación de campos definidos y no vacíos
    if (isset($_POST['nombre'], $_POST['email'], $_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['email'] && !empty($_POST['password']))) {
        // Trim para eliminar espacios al inicio y al final
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        // Quitar barras de escapado de carácteres
        $nombre = stripslashes($nombre);
        $email = stripslashes($email);
        $password = stripslashes($password);

        // Para escapar HTML con htmlspecialchars
        $nombre = htmlspecialchars($nombre);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        try {
            $usuario = new Usuario($nombre, $email, $password);

            $usuario->insertarUsuario($pdo);
        } catch (PDOException $error) {
            echo "Error en la inserción" . $error->getMessage();
        }
    } else {
        echo "Completa todos los campos";
    }
        
}

/*
try {
    $usuario = new Usuario(5, "Pepe", "pepe@gmail.com", "1234");

    $usuario->insertarUsuario($pdo);

} catch (PDOException $error) {
    echo "Error en la inserción" . $error->getMessage();
}*/
?>