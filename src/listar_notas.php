<?php
require_once "db/conexion.php";
require_once "models/Nota.php";

try {
    
    Nota::listarNotas($pdo);
    
} catch (PDOException $error) {
    echo "Error en la inserción" . $error->getMessage();
}
?>