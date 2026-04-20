-- Eliminar base de datos si existe y crear una nueva
DROP DATABASE IF EXISTS php_junio;
CREATE DATABASE php_junio;
USE php_junio;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla notas
CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Datos de ejemplo
INSERT INTO usuarios (nombre, email, password) VALUES 
('Admin', 'admin@test.com', '12345'),
('Juan', 'juan@test.com', '12345');

INSERT INTO notas (titulo, contenido, usuario_id) VALUES 
('Nota de Admin', 'Contenido de la nota del admin', 1),
('Nota de Juan', 'Hola mundo', 2);