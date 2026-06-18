<?php
// 1. El diccionario estructurado de forma escalable (tipo base de datos)
$diccionario = [
    ["es" => "mesa", "en" => "table", "fr" => "table", "it" => "tavolo"],
    ["es" => "perro", "en" => "dog", "fr" => "chien", "it" => "cane"],
    ["es" => "ordenador", "en" => "computer", "fr" => "ordinateur", "it" => "computer"]
];

// 2. Función dinámica y escalable para traducir
function traducir($palabra, $idioma_origen, $idioma_destino, $diccionario_array)
{
    // Convertimos la palabra a minúsculas para que la búsqueda no falle por mayúsculas
    $palabra_limpia = strtolower($palabra);

    // Recorremos cada "concepto" (bloque de traducciones)
    foreach ($diccionario_array as $concepto) {

        // Comprobamos si la palabra existe en el idioma de origen indicado
        if (isset($concepto[$idioma_origen]) && $concepto[$idioma_origen] === $palabra_limpia) {

            // Si existe, comprobamos si tenemos la traducción al idioma de destino
            if (isset($concepto[$idioma_destino])) {
                return $concepto[$idioma_destino];
            } else {
                return "Traducción no disponible para este idioma.";
            }
        }
    }

    return "Palabra no encontrada en el diccionario.";
}

// 3. Probando la escalabilidad
echo traducir("perro", "es", "fr", $diccionario);
// Imprime: chien

echo "\n";

echo traducir("table", "en", "es", $diccionario);
// Imprime: mesa

?>