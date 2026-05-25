
<?php
	/**
	 * En este archivo es donde se realiza la conexión con la base de datos
	 */
	$host = "db";
	$nombreBSD = "php_junio";
	$user = "root";
	$pass = "dwes";

	try {
		// Conexión a la BD
		$pdo = new PDO("mysql:host=$host;dbname=$nombreBSD;charset=utf8", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		echo "Conexión correcta" . "<br><br>";
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>