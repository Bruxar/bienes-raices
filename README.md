
# CRUD Bienes Raices

Este proyecto trata de una pagina de bienes raices con un sistema para administrar propiedades. El backend esta en PHP Vanilla conectado a una base de datos MySQL a traves de la extensión **MySQLi** que ofrece PHP, el frontend esta diseñado con la tecnologia SASS, usando Gulp para la compilacion del scss.

## Instalacion

Instala mi projecto con npm:

```bash
cd Bienes-Raices
npm install
```

Corre localmente el backend con la pagina:

```bash
php -S localhost:3000
```

Ejecuta Gulp para cambios en el build:

```bash
gulp
```
    

## Conectando DB

Para conectarse a la BD debes crear una carpeta **config** dentro de **includes**, en la carpeta **config** debes crear el archivo *database.php*, donde se configura la conexión:

```php
<?php
function conectarDB() : mysqli{
    $db = mysqli_connect("IP (localhost para dev)", "mi_usuario", "mi_contraseña", "mi_bd");

    if(!$db){
        echo "Error en la conexion";
        exit;
    }
    return $db;
}
```


## Tablas

### Propiedades

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

### Vendedores

CREATE TABLE vendedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45),
    apellido VARCHAR(45),
    telefono VARCHAR(9)
);

### Usuarios

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    password CHAR(60)
);
