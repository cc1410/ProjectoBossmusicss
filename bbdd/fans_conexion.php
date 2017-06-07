<?php

require_once 'bbdd_conexion.php';

//votar concierto
function votoConcierto() {
    $con = conectar("db4944383_bossmusicss");
    $select = "select u1.nombre_artistico as nomlocal, poblacion.ciudad, u2.nombre_artistico as nommusico, concierto.dia, concierto.hora
from concierto
inner join apuntar on  concierto.id_concierto=apuntar.id_concierto
inner join usuario u1 on u1.idusuario=concierto.id_local
inner join usuario u2 on u2.idusuario=apuntar.id_musico
inner join poblacion on u1.idciudad=poblacion.idciudad
where aceptado='a'
group by u1.nombre_artistico, u2.nombre_artistico
";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function numVotoConcierto($idconcierto) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select count(*) as votos from valorar_concierto where id_concierto='$idconcierto'";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $votos;
}

function mostrarIdconcierto($nomlocal, $fecha, $hora) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select id_concierto from concierto where id_local=(select idusuario from usuario where nombre_artistico = '$nomlocal') and dia='$fecha' and hora='$hora'";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $id_concierto;
}

function comprobarVotoConcierto($idusuario, $idconcierto) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from valorar_concierto where id_fans='$idusuario' and id_concierto='$idconcierto'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    $num_row = mysqli_num_rows($resultado);
    if ($num_row > 0) {
        return true;
    } else {
        return false;
    }
}

function sumarVotosConcierto($idusuario, $idconcierto) {
    $con = conectar("db4944383_bossmusicss");
    $insert = "insert into valorar_concierto values('$idusuario','$idconcierto')";
    $resultado = mysqli_query($con, $insert);
    desconectar($con);
    return $resultado;
}

function restarVotosConcierto($idusuario, $idconcierto) {
    $con = conectar("db4944383_bossmusicss");
    $delete = "delete from valorar_concierto where id_fans='$idusuario' and id_concierto='$idconcierto'";
    $resultado = mysqli_query($con, $delete);
    desconectar($con);
    return $resultado;
}

//votar musico

function totalMusico() {
    $con = conectar("db4944383_bossmusicss");
    $select = "select count(*) as cont
                from usuario
            where perfil='m'";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $cont;
}

function votoMusico($posicion, $cantidad) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select idusuario as idmusic ,imagen, nombre_artistico
from usuario
where perfil='m'
group by nombre_artistico limit $posicion,$cantidad";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function numVotoMusico($idmusico) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select count(*) as votos from valorar_musico where id_musico='$idmusico'";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $votos;
}

function comprobarVotoMusico($idusuario, $idmusic) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from valorar_musico where id_fans='$idusuario' and id_musico='$idmusic'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    $num_row = mysqli_num_rows($resultado);
    if ($num_row > 0) {
        return true;
    } else {
        return false;
    }
}

function sumarVotosMusic($idusuario, $idmusic) {
    $con = conectar("db4944383_bossmusicss");
    $insert = "insert into valorar_musico values('$idusuario','$idmusic')";
    $resultado = mysqli_query($con, $insert);
    desconectar($con);
    return $resultado;
}

function restarVotosMusic($idusuario, $music) {
    $con = conectar("db4944383_bossmusicss");
    $delete = "delete from valorar_musico where id_fans='$idusuario' and id_musico='$music'";
    $resultado = mysqli_query($con, $delete);
    desconectar($con);
    return $resultado;
}

function mostrarInforFans($idusuario) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from usuario where idusuario='$idusuario'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function modificarFans($idusuario, $usuario, $telefono, $direccion, $ciudad) {
    $con = conectar("db4944383_bossmusicss");
    $update = "update usuario set usuario='$usuario', telefono='$telefono', direccion='$direccion',idciudad='$ciudad' where idusuario='$idusuario'";
    if (mysqli_query($con, $update)) {
        echo "Datos cambiada";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function confPass($passactual, $usu) {
    $conectar = conectar("db4944383_bossmusicss");
    $select = "select * from usuario where idusuario='$usu' and password='$passactual';";
    $resultado = mysqli_query($conectar, $select);
    desconectar($conectar);
    $num_rows = mysqli_num_rows($resultado);
    if ($num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function ciudadFans() {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from poblacion";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function imagen($usuario, $imagen) {
    $con = conectar("db4944383_bossmusicss");
    $update = "update usuario set imagen = '$imagen' where idusuario = '$usuario';";
    if (mysqli_query($con, $update)) {
        echo "";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
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

function cambiarPass($pass, $idusuario) {
    $con = conectar("db4944383_bossmusicss");
    $update = "update usuario set password='$pass' where idusuario='$idusuario' ";
    if (mysqli_query($con, $update)) {
        echo "<h3 class='pass'>Password cambiado</h3>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
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