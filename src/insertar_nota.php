<?php
    require_once "db/conexion.php";
    require_once "models/Nota.php"

    try {
        $nota = new Nota();
        

    } catch (PDOException $error) {
        echo "Error en la inserción" . $error->getMessage();
    } finally {
        $pdo = null;
        $stmt = null;
    };
?>