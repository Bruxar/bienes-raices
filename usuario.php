<?php

//Importar conexion
require 'includes/config/database.php';
$db = conectarDB();

//Crea un email y password
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

var_dump($passwordHash);

//Query para crear cuenta
$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}')";

// echo $query;


//Agregarlo a la base de datos
mysqli_query($db, $query);
?>