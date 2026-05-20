<?php
    // Función para validar campo de texto
    function validarCampo ($campo) {
        if (isset($campo) &&  !empty($campo)) {
            $campo = htmlspecialchars(stripcslashes(trim($campo)));
            return $campo;
        } else {
            return false;
        }
    }

    // Validar email
    function validarEmail ($email) {
        if (isset($email) &&  !empty($email)) {
            $email = htmlspecialchars(stripcslashes(trim($email)));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            return $email;
        } else {
            return false;
        }
    }

    // Validar teléfono (que sea número)
    function validarTelefono ($telefono) {
        if (isset($telefono) &&  !empty($telefono)) {
            $telefono = htmlspecialchars(stripcslashes(trim($telefono)));
            $telefono = filter_var($telefono, FILTER_VALIDATE_INT);
            return $telefono;
        } else {
            return false;
        }
    }

    // Validar que sea número
    function validarNumero ($numero) {
        if (isset($numero) &&  !empty($numero)) {
            $numero = htmlspecialchars(stripcslashes(trim($numero)));
            $numero = filter_var($numero, FILTER_VALIDATE_INT);
            return $numero;
        } else {
            return false;
        }
    }
?>