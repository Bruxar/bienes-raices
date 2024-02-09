
# CRUD Bienes Raices

Este proyecto trata de una pagina de bienes raices con un sistema para administrar propiedades. El backend esta en PHP Vanilla conectado a una base de datos MySQL a traves de la extensión MySQLi que ofrece PHP, el frontend esta diseñado con la tecnologia SASS, usando Gulp para la compilacion del scss.

# Tablas

## Propiedades

CREATE TABLE propiedades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(45),
    precio DECIMAL(10,0),
    imagen VARCHAR(200),
    descripcion LONGTEXT,
    habitaciones INT,
    wc INT,
    estacionamiento INT,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    vendedores_id INT,
    FOREIGN KEY (vendedores_id) REFERENCES vendedores(id)
);

## Vendedores

CREATE TABLE vendedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45),
    apellido VARCHAR(45),
    telefono VARCHAR(9)
);

## Usuarios

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    password CHAR(60)
);
