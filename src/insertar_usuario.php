<?php
    require_once "db/conexion.php";
    require_once "models/Usuario.php";

    try {
        $nota = new Usuario();
        
        $nota->nombre = "Fran";
        $nota->email = "fran@gmail2.com";
        $nota->password = "1234";

        $nota->insertarUsuario($pdo);

    } catch (PDOException $error) {
        echo "Error en la inserción" . $error->getMessage();
    }
?>