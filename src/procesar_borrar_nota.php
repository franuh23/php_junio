<?php
require_once "db/conexion.php";
require_once "models/Nota.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Usamos las funciones de validar campos
        $nota_id = validarNumero($_POST['id']);

        if ($nota_id) {
            // Recuperamos la nota
            $nota = Nota::verNota($pdo, $nota_id);

            if ($nota) {
                $nota->borrarNota($pdo);
            } else {
                echo "Nota no encontrada.";
            }
        } else {
            echo "ID no encontrado.";
        }

    } catch (Exception $error) {
        echo "Error: " . $error->getMessage();
    }
} else {
    echo "Error de acceso.";
}
?>