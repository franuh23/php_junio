<?php
require_once "db/conexion.php";
require_once "models/Nota.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usamos las funciones de validar campos
    $nota_id = validarNumero($_POST['id']);

    if ($nota_id) {
        try {
            $nota = new Nota('','', 0);
            $nota->borrarNota($pdo, $nota_id);
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    } else {
        echo "El ID de la nota no es válido";
    }
}
?>
