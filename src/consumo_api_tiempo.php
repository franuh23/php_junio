<?php

// Datos que se añaden a la query
$latitud = 41.93;
$longitud = 12.46;
$appyKey = "c75e8e1e0a40dd67bd074ab4952d3174";

// Petición a API OpenWeather
$consulta = http_build_query(["lat" => $latitud, "lon" => $longitud, "appid" => $appyKey]);
$pronostico = file_get_contents("https://api.openweathermap.org/data/2.5/weather?$consulta");
$pronosticoDecode = json_decode($pronostico);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Pronóstico meteorológico</title>
</head>

<body>
	<h1>Pronóstico del tiempo para hoy en Sax (España)</h1>
	<h2>Datos en bruto en formato JSON:</h2>
	<p><?= $pronostico ?></p>
	<hr>
	<h2>Datos en un objeto JSON:</h2>
	<p><?= var_dump($pronosticoDecode) ?></p>
	<hr>
	<h2>Información formateada:</h2>
	<p>
		Temperatura: <?= $pronosticoDecode->main->temp ?> grados Kelvin<br>
		Humedad: <?= $pronosticoDecode->main->humidity ?> %<br>
		Presión: <?= $pronosticoDecode->main->pressure ?>mb<br>
		País: <?= $pronosticoDecode->sys->country ?><br>
		Velocidad: <?= $pronosticoDecode->wind->speed ?> nudos<br>
	</p>
</body>

</html>