<?php


function conectar($database) {
    $conexion = mysqli_connect("mysql131.srv-hostalia.com", "u4944383_boss", "Stucom.2017", $database)
            or die("No se ha podido conectar a la BBDD");
    mysqli_set_charset($conexion, "utf8");
    return $conexion;
}

function desconectar($conexion) {
    mysqli_close($conexion);
}
