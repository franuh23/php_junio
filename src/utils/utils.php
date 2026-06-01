<?php
function formatearRespuesta($datos, $codigo) {
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
}

function obtenerDatosPeticion (){
    echo "entro en la función";
    // leer el json que el cliente me informa como datos a insertar o actualizar
    $cuerpo = file_get_contents("php://input");
    
    echo $cuerpo;

    $cuerpoJson = json_decode($cuerpo, true) ?? [];
    var_dump($cuerpoJson);
    // pasamos el json a objeto
    return $cuerpoJson;
}