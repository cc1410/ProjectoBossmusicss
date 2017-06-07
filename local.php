<?php
ob_start();
session_start();
require_once 'bbdd/local_conexion.php';
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $idlocal = $_SESSION["id"];
    $tipo = $_SESSION["perfil"];
    $img = selectImagen($idlocal);
    if ($tipo == 'l') {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <link rel="icon" type="image/x-icon" href="img_pag/favicon.ico" />
                <script src="Jquery/jquery-3.2.0.min.js" type="text/javascript"></script>
                <script src="Jquery/jsmenu.js" type="text/javascript"></script>
                <link href="css/cssCabeceraHome.css" rel="stylesheet" type="text/css"/>
                <link href="css/cssLocal.css" rel="stylesheet" type="text/css"/>
                <title>Home_Local</title>
            </head>
            <body>
                <?php
                include_once 'cabeceras/cabecera_usuario.php';
                ?>

                <div id="centro">
                    <!--            tabla de concierto sin musico asignado-->
                    <div>
                        <table id="tablaSinMusico">
                            <tr>
                                <th>Imagen</th>
                                <th>NOMBRE-CONCIERTO</th>
                                <th>DIA</th>
                                <th> HORA</th>
                                <th>PAGO</th>
                                <th>INSCRITO</th>
                                <th></th>
                            </tr>

                            <?php
                            $conp = conPendientesAsignar($idlocal);
                            while ($fila = mysqli_fetch_array($conp)) {
                                extract($fila);
                                echo"<tr>" .
                                "<td><img src='img_usu/$foto_concierto' class='imgCon'></td>" .
                                "<td>$nombre</td>" .
                                "<td>$dia</td>"
                                . "<td>$hora</td>";
                                $inscrit = numInscritConcierto($id_concierto);
                                echo "<td>$pago</td>"
                                . "<td><a href='?idl=" . $idlocal . "&idconcierto=" . $id_concierto . "'>$inscrit</a></td>" .
                                "<td><a href='crearConcierto.php?idconcierto=" . $id_concierto . "&concierto=modificar'>Modificar</a></td>" .
                                "</tr>";
                            }
                            ?>
                        </table>
                    </div>

                    <!--            tabla de los musicos que ha inscrito al concierto-->
                    <div >
                        <?php
                        if (isset($_GET['idl'], $_GET['idconcierto'])) {
                            $idcon = $_GET['idconcierto'];
                            ?>
                            <table id="musicoInscrito">
                                <th>NOMBRE-MUSICO</th>
                                <th>GENERO</th> 
                                <th>NOMBRE-CONCIERTO
                                </th><th> ASIGNAR</th>

                                <?php
                                $conp = musicoInscrit($idcon);
                                while ($fila = mysqli_fetch_array($conp)) {
                                    extract($fila);
                                    $idmusic = $id_musico;
                                    echo"<tr>" .
                                    "<td>$musico</td>" .
                                    "<td>$nomestilo</td>" .
                                    "<td>$nomestilo</td>"
                                    . "<td><a href='?idconp=" . $id_concierto . "&idmusicop=" . $idmusic . "'>Aceptar</a></td>" .
                                    "</tr>";
                                }
                                ?> </table>
                            <?php
                        }
                        if (isset($_GET['idmusicop'], $_GET['idconp'])) {
                            $idmusic = $_GET["idmusicop"];
                            $idcon = $_GET['idconp'];
                            asignarmusicoConcierto($idcon, $idmusic);
                            actualizarestadoCon($idcon);
                            header("Location:http://www.bossmusicss.com/local.php");
                        }

                        if (isset($_GET['idmusico'], $_GET['idconcierto'])) {
                            $idmusicb = $_GET["idmusico"];
                            $idconb = $_GET['idconcierto'];
                            quitarMusicoConcierto($idconb, $idmusicb);
                            actualizarestadoCon2($idcon);
                            header("Location:http://www.bossmusicss.com/local.php");
                        }
                        ?>
                    </div>
                    <!--            tabla de concierto con musico asignado-->
                    <div>
                        <table id="tablaConMusico">
                            <th>ID_conceirto</th>
                            <th>ID_LOCAL</th>
                            <th>NOMBRE-CONCIERTO</th>
                            <th> DIA</th>
                            <th>HORA</th>
                            <th>PAGO</th>
                            <th>INSCRITO</th>

                            <?php
                            $cona = listamusicosAsignados($idlocal);
                            while ($fila = mysqli_fetch_array($cona)) {
                                extract($fila);
                                $idmusic = $id_musico;
                                echo"<tr>" .
                                "<td>$id_concierto</td>" .
                                "<td>$id_local</td>" .
                                "<td>$dia</td>"
                                . "<td>$hora</td>"
                                . "<td>$pago</td>"
                                . "<td><a href='?idmusico=" . $idmusic . "&idconcierto=" . $id_concierto . "'>baja</a></td>" .
                                "</tr>";
                            }

                            if (isset($_GET['idmusico'], $_GET['idconcierto'])) {
                                $idmusic = $_GET["idmusico"];
                                $id_concierto = $_GET['idconcierto'];
                                quitarMusicoConcierto($id_concierto, $idmusic);
                                actualizarestadoCon2($id_concierto);
                                header("Location:http://www.bossmusicss.com/local.php");
                            }
                            ?>
                        </table>
                    </div>

                </div>
                <?php
                include "footer/footer.php";
                ?>
            </body>
        </html>
        <?php
    } else {
        echo "<p>No tiene permiso de esta pagina</p>";
    }
} else {
    echo "<p>Debes hacer login para poder ver esta pagina</p>";
}
ob_end_flush();
?>