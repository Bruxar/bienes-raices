<?php

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', 'habbo2001', 'bienesraices_crud');

    if(!$db){
        echo "Error en la conexion";
        exit;
    }

    return $db;
}