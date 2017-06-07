<?php

require_once 'bbdd_conexion.php';

function listconcertI($usuario) {
    $con = conectar('db4944383_bossmusicss');
    $select = "select * from concierto 
inner join usuario on concierto.id_local= usuario.idusuario where estado= 'o' and id_concierto not in(
select id_concierto from apuntar where id_musico='$usuario')";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    return $resultado;
}

function entrarconcierto($usuario, $id_concierto) {
    $con = conectar("db4944383_bossmusicss");
    $insert = "insert into apuntar values('$usuario','$id_concierto','p')";
    if (mysqli_query($con, $insert)) {
        
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function mostrarInforMusico($idusuario) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from usuario where idusuario='$idusuario'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function conciertoEsperando($usuario) {
    $con = conectar('db4944383_bossmusicss');
    $select = "select * from concierto 
inner join usuario on concierto.id_local= usuario.idusuario where estado= 'o' and id_concierto in(
select id_concierto from apuntar where id_musico='$usuario')";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    return $resultado;
}

function quitarSolicitud($usuario, $id_concierto) {
    $con = conectar("db4944383_bossmusicss");
    $delete = "delete from apuntar where id_musico='$usuario' and id_concierto='$id_concierto'";
    if (mysqli_query($con, $delete)) {
        
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function conciertoQueToca($usuario) {
    $con = conectar('db4944383_bossmusicss');
    $select = "select * from concierto 
inner join usuario on concierto.id_local= usuario.idusuario where estado= 't' and id_concierto in(
select id_concierto from apuntar where id_musico='$usuario')";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function modificarMusico($idusuario, $usuario, $nom_local, $ciudad, $telefono, $direccion) {
    $con = conectar("db4944383_bossmusicss");
    $update = "update usuario set usuario='$usuario', telefono='$telefono', nombre_artistico='$nom_local',
             idciudad='$ciudad',
            direccion='$direccion' where idusuario='$idusuario'";
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

function ciudadMusico() {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from poblacion";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
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

