<?php
// Devuelve una respuesta formateada en json y el código HTTP correspondiente
function formatearRespuesta($datos, $codigo) {
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
}

// leer el json que el cliente me informa como datos a insertar o actualizar
function obtenerDatosPeticion (){
    $cuerpo = file_get_contents("php://input");
    // convierte json a array
    return json_decode($cuerpo, true) ?? [];
}

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