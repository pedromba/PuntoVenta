<?php

define("HOST", "localhost");
define("USUARIO", "root");
define("PASSWD", "");
define("BBDD", "puntoventa");

try {
    $conexion = new mysqli(HOST, USUARIO, PASSWD, BBDD);
    $conexion->set_charset("utf8");
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
