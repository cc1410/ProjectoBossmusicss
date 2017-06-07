<?php

require_once 'bbdd_conexion.php';

function existUser($nombre) {
    $con = conectar("db4944383_bossmusicss");
    $query = "select usuario from usuario where usuario ='$nombre'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    $num_rows = mysqli_num_rows($resultado);
    if ($num_rows == 0) {
        return false;
    } else {
        return true;
    }
}

//alta local

function altaLocal($usuario, $contrasena, $mail, $nombre, $direccion, $aforo) {
    $con = conectar("db4944383_bossmusicss");
    $insert = "insert into usuario (idusuario, usuario, password,email,nombre_artistico,direccion,aforo, perfil,imagen) values (null, '$usuario', '$passCif','$mail', '$nombre','$direccion','$aforo', 'l','usuario.png') ";
    if (mysqli_query($con, $insert)) {
        echo "<h4 class='mensajeRegistro'>Usuario dado de alta</h4>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

//alta fans
function altaFans($usu, $contrasena, $email, $sexo) {
    $conexion = conectar("db4944383_bossmusicss");
    $insert = "insert into usuario(usuario, password, email, sexo, perfil,imagen)values('$usu', '$contrasena','$email', '$sexo','f','usuario.png')";
    if (mysqli_query($conexion, $insert)) {
        echo "<h4 class='mensajeRegistro'>Usuario dado de alta</h4>";
    } else {
        echo mysqli_error($conexion);
    }
    desconectar($conexion);
}

//alta musico


function altaMusico($usuario, $contrasena, $email, $nombre, $genero) {
    $con = conectar("db4944383_bossmusicss");
    $insert = "Insert into usuario (usuario, password, email,nombre_artistico,genero, perfil,imagen)values('$usuario', '$contrasena', '$email', '$nombre', '$genero', 'm','usuario.png') ";
    if (mysqli_query($con, $insert)) {
         echo "<h4 class='mensajeRegistro'>Usuario dado de alta</h4>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function genero() {
    $conexion = conectar("db4944383_bossmusicss");
    $select = "select idgenero, nomestilo from genero";
    $resultado = mysqli_query($conexion, $select);
    desconectar($conexion);
    return $resultado;
}

function buscadornom($buscar) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from usuario where nombre_artistico like '%$buscar%'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function buscadorcon($buscar) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from concierto con
inner join usuario us on us.idusuario = con.id_local
where con.nombre like '%$buscar%' or us.nombre_artistico like '%$buscar%'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function validateUser($usuario, $pass) {
    $con = conectar("db4944383_bossmusicss");
    $query = "select * from usuario where usuario='$usuario' and password='$pass'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    $num_row = mysqli_num_rows($resultado);
    if ($num_row > 0) {
        return true;
    } else {
        return false;
    }
}

function getPerfilByUser($usuario) {
    $conexion = conectar("db4944383_bossmusicss");
    $select = "select perfil from usuario where usuario='$usuario'";
    $resultado = mysqli_query($conexion, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($conexion);
    return $perfil;
}

function getIdByUser($usuario) {
    $conexion = conectar("db4944383_bossmusicss");
    $select = "select idusuario from usuario where usuario='$usuario'";
    $resultado = mysqli_query($conexion, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($conexion);
    return $idusuario;
}
