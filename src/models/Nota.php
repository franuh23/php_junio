<?php
require_once "db/conexion.php";
class Nota
{
    private $id;
    private $titulo;
    private $contenido;
    private $fecha_creacion;
    //private $fecha_actualizacion;
    private $usuario_id;

    public function __construct($id = null, $titulo = null, $contenido = null, $fecha_creacion = null, $usuario_id = null)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->fecha_creacion = $fecha_creacion;
        //$this->fecha_actualizacion = $fecha_actualizacion;
        $this->usuario_id = $usuario_id;
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

    public function insertarNota($pdo)
    {
        try {
            $sql = "INSERT INTO notas (titulo, contenido, usuario_id) 
        VALUES(:titulo, :contenido, :usuario_id)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":titulo", $this->titulo);
            $stmt->bindParam(":contenido", $this->contenido);
            $stmt->bindParam(":usuario_id", $this->usuario_id);

            $stmt->execute();

            echo "Nota insertada correctamente";
        } catch (PDOException $error) {
            echo "Error en la inserción" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public static function listarNotas($pdo)
    {
        try {
            $sql = "SELECT id, titulo, usuario_id FROM notas LIMIT 50";

            $stmt = $pdo->prepare($sql);
            
            $stmt->execute();

            $notas = $stmt->fetch(PDO::FETCH_ASSOC);

            var_dump($notas);

            foreach ($notas as $nota) {
                echo "ID nota: " . $nota['id'];
                echo "Título nota: " . $nota['titulo'];
                echo "Usuario nota: " . $nota['usuario_id'];
            }

        } catch (PDOException $error) {
            echo "Error en el select de listar notas" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
}

/*try {
            $sql = "INSERT INTO notas (titulo, contenido, fecha_creacion, fecha_actualizacion, usuario_id) 
        VALUES(:titulo, :contenido, :fecha_creacion, :fecha_actualizacion, :usuario_id)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":titulo", $this->titulo);
            $stmt->bindParam(":contenido", $this->contenido);
            $stmt->bindParam(":fecha_creacion", $this->fecha_creacion);
            $stmt->bindParam(":fecha_actualizacion", $this->fecha_actualizacion);
            $stmt->bindParam(":usuario_id", $this->usuario_id);

            $stmt->execute();

        } */
?>