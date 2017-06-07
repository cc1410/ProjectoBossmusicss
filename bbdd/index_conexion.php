<?php

require_once 'bbdd_conexion.php';

function totalConciertoAceptado() {
    $con = conectar("db4944383_bossmusicss");
    $select = "select count(*) as cont
                from concierto 
                inner join usuario on concierto.id_local=usuario.idusuario
                inner join apuntar on concierto.id_concierto=apuntar.id_concierto
                where aceptado='a'
                order by concierto.dia";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $cont;
}

function agentaConcierto($posicion, $cantidad) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select concierto.dia, concierto.nombre, usuario.nombre_artistico,concierto.foto_concierto, usuario.direccion
                from concierto 
                inner join usuario on concierto.id_local=usuario.idusuario
                inner join apuntar on concierto.id_concierto=apuntar.id_concierto
                where aceptado='a' and dia>now()
                order by concierto.dia limit $posicion,$cantidad";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function rankingMusico($posicion, $cantidad) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select fotomusico, nombre_artistico, nomestilo, count(*) as votos
                from usuario
                inner join genero on usuario.genero=genero.idgenero
                inner join valorar_musico on usuario.idusuario=valorar_musico.id_musico
                where perfil='m'
                group by nombre_artistico order by votos desc limit $posicion,$cantidad";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

//Login
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

function selectImagen($usuario) {
    $con = conectar("db4944383_bossmusicss");
    $query = "select imagen from usuario where idusuario = '$usuario';";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
//$_FILES['uploadedfile']['name']
    return $imagen;
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

function buscaConM($buscar) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from concierto inner join usuario on concierto.id_local= usuario.idusuario where estado= 't' and id_concierto in(
select id_concierto from apuntar where id_musico in(select idusuario from usuario where nombre_artistico like '%$buscar%'))";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}
