<?php

require_once 'bbdd_conexion.php';

function ciudadLocal() {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from poblacion";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function mostrarInforLocal($idusuario) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select * from usuario where idusuario='$idusuario'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function modificarLocal($idusuario, $usuario, $nom_local, $aforo, $ciudad, $telefono, $direccion) {
    $con = conectar("db4944383_bossmusicss");
    $update = "update usuario set usuario='$usuario', telefono='$telefono', nombre_artistico='$nom_local',
            aforo='$aforo', idciudad='$ciudad',
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

//funcion para mostrar los conciertos pendientes
function conPendientesAsignar($local) {
    $con = conectar('db4944383_bossmusicss');
    $select = "select concierto.foto_concierto,concierto.id_concierto,concierto.id_local, concierto.nombre, dia, hora, nomestilo, pago from concierto
inner join genero on concierto.genero=genero.idgenero
left join apuntar on concierto.id_concierto= apuntar.id_concierto
where estado='o' and id_local='$local'
group by nombre order by dia asc
";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function numInscritConcierto($idconcierto) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select count(*) as inscrit from apuntar where id_concierto='$idconcierto'";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $inscrit;
}

function musicoInscrit($idconcierto) {
    $con = conectar("db4944383_bossmusicss");
    $select = "select id_musico, id_concierto,nombre_artistico as musico, nomestilo from apuntar
inner join usuario on apuntar.id_musico=usuario.idusuario
inner join genero on usuario.genero=genero.idgenero
where id_concierto='$idconcierto'";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

//funcion para mostrar los musicos pendientes de asignar 
//function listamusicosAsignar($idlocal, $idconp) {
//    $con = conectar("db4944383_bossmusicss");
//    $select = "SELECT usuario.idusuario,concierto.id_local, concierto.nombre as Nombre_Concierto, concierto.estado, 
//concierto.dia,concierto.hora,concierto.id_concierto, usuario.nombre_artistico as musicos,
//usuario.genero,genero.nomestilo FROM concierto
//INNER JOIN apuntar ON apuntar.id_concierto = concierto.id_concierto
//INNER JOIN usuario ON apuntar.id_musico = usuario.idusuario
//INNER JOIN genero ON  usuario.genero = genero.idgenero
//WHERE aceptado='p' and id_local='$idlocal' and concierto.idconcierto='$idconp'
//ORDER by dia asc";
//    $resultado = mysqli_query($con, $select);
//    $fila = mysqli_fetch_array($resultado);
//    extract($fila);
//    return $resultado;
//}
//Funciones para asignar un musico a un concierto
function asignarmusicoConcierto($idcon, $idmusic) {
    $con = conectar('db4944383_bossmusicss');
    $query = "update apuntar set aceptado='a' where id_concierto='$idcon' and id_musico='$idmusic'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

function actualizarestadoCon($idcon) {
    $con = conectar('db4944383_bossmusicss');
    $query = "update concierto set estado='t' where id_concierto='$idcon'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

//Listado de Musicos con conciertos asignados
function listamusicosAsignados($idlocal) {
    $con = conectar('db4944383_bossmusicss');
    $select = "select concierto.id_concierto,concierto.id_local, concierto.nombre, dia, hora, apuntar.id_musico, nomestilo, pago from concierto
inner join genero on concierto.genero=genero.idgenero
inner join apuntar on concierto.id_concierto= apuntar.id_concierto
where aceptado='a' and id_local='$idlocal' and estado='t'
order by dia asc";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

//funciones para dar de baja a un concierto
function quitarMusicoConcierto($idcon, $idmusic) {
    $con = conectar('db4944383_bossmusicss');
    $query = "update apuntar set aceptado='p' where id_concierto='$idcon' and id_musico='$idmusic'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

function actualizarestadoCon2($idcon) {
    $con = conectar('db4944383_bossmusicss');
    $query = "update concierto set estado='o' where id_concierto='$idcon'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

function genero() {
    $conexion = conectar("db4944383_bossmusicss");
    $select = "select idgenero, nomestilo from genero";
    $resultado = mysqli_query($conexion, $select);
    desconectar($conexion);
    return $resultado;
}

function crearconcierto($nombre, $fecha, $hora, $genero, $usuario, $pago) {
    $conexion = conectar("db4944383_bossmusicss");
    $insert = "insert into concierto values(null, '$nombre', '$fecha', 'o', '$hora', '$genero','$usuario', '$pago','conPorDefecto.png')";
    if (mysqli_query($conexion, $insert)) {
        echo "Concierto creado";
    } else {
        echo mysqli_error($conexion);
    }
    desconectar($conexion);
}

function imagenConcierto($idconcierto, $imagen) {
    $con = conectar("db4944383_bossmusicss");
    $update = "update concierto set foto_concierto = '$imagen' where id_concierto = '$idconcierto';";
    if (mysqli_query($con, $update)) {
        echo "";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
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

function idConcierto($idlocal) {
    $con = conectar("db4944383_bossmusicss");
    $query = "select max(id_concierto) as id from concierto where id_local='$idlocal';";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    return $id;
}

function selectConcierto($idcon) {
    $con = conectar("db4944383_bossmusicss");
    $query = "select nombre, dia, hora, pago from concierto where id_concierto='$idcon'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

function modificarConcierto($idcon,$nom,$fecha,$hora,$pago){
    $con=  conectar("db4944383_bossmusicss");
    $update="update concierto set nombre='$nom', dia='$fecha', hora='$hora' , pago='$pago' where id_concierto='$idcon'";
     if (mysqli_query($con, $update)) {
        echo "<h3>Datos cambiado</h3>";
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