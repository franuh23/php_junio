<?php
require_once "db/conexion.php";
class Usuario
{
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $fecha_registro;

    public function __construct($id, $nombre, $email, $password, $fecha_registro = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->fecha_registro = $fecha_registro ?? date('Y-m-d');
    }

    // Getter mágico
    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        return "Propiedad '$propiedad' no encontrada";
    }

    // Setter mágico
    public function __set($propiedad, $valor)
    {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        } else {
            throw new Exception("Propiedad '$propiedad' no encontrada", 1);
        }
    }

    public function insertarUsuario($pdo)
    {
        try {
            $sql = "INSERT INTO usuarios (nombre, email, password, fecha_registro) 
        VALUES(:nombre, :email, :password, :fecha_registro)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":fecha_registro", $this->fecha_registro);

            $stmt->execute();

            echo "Usuario insertado correctamente";
        } catch (PDOException $error) {
            echo "Error en la inserción" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
}
?>