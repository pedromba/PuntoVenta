<?php

define("HOST", "127.0.0.1");
define("USUARIO", "root");
define("PASSWORD", "");
define("DB", "puntoventa");

try {
    $conexion = new mysqli(HOST, USUARIO, PASSWORD, DB);
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }
} catch (Exception $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
