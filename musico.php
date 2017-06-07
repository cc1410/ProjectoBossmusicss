<?php
ob_start();
session_start();
require_once 'bbdd/musico_conexion.php';
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $idmusic = $_SESSION["id"];
    $tipo = $_SESSION["perfil"];
    $img = selectImagen($idmusic);
    if ($tipo == 'm') {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">    
                <link rel="icon" type="image/x-icon" href="img_pag/favicon.ico" />
                <script src="Jquery/jquery-3.2.0.min.js" type="text/javascript"></script>
                <script src="Jquery/jsmenu.js" type="text/javascript"></script>
                <link href="css/cssCabeceraHome.css" rel="stylesheet" type="text/css"/>
                <link href="css/cssMusico.css" rel="stylesheet" type="text/css"/>
                <title>Home_Musico</title>
            </head>
            <body>
                <?php
                include_once 'cabeceras/cabecera_usuario.php';
                ?>

                <div id="centro">
                    <div>
                        <h3>Concierto pendiente de asignar</h3>
                        <table id="tabla1">
                            <th>N0MBRE DEL LOCAL</th>
                            <th>NOMBRE DEL CONCIERTO</th>
                            <th>DIRECCION</th>
                            <th>DIA</th>
                            <th>HORA</th>
                            <th>PAGO </th>
                            <th>Incribirse </th>

                            <?php
                            $conciertos = listconcertI($idmusic);
                            while ($fila = mysqli_fetch_array($conciertos)) {
                                extract($fila);
                                echo"<tr>" .
                                "<td>$nombre_artistico</td>" .
                                "<td>$nombre</td>" .
                                "<td>$direccion</td>" .
                                "<td>$dia</td>"
                                . "<td>$hora</td>"
                                . "<td>$pago</td>"
                                . "<td><a href='?idmusico=$idmusic&idconcierto=$id_concierto'>Enviar solicitud</a></td>" .
                                "</tr>";
                            }



                            if (isset($_GET['idmusico'], $_GET['idconcierto'])) {
                                $musico = $_GET['idmusico'];
                                $concierto = $_GET['idconcierto'];
                                entrarconcierto($musico, $concierto);
                                header("Location:http://www.bossmusicss.com/musico.php");
                            }
                            ?>

                        </table>
                    </div>

                    <div>
                        <h3>Esperando respuesta</h3>
                        <table>
                            <th>N0MBRE DEL LOCAL</th>
                            <th>NOMBRE DEL CONCIERTO</th>
                            <th>DIRECCION</th>
                            <th>DIA</th>
                            <th>HORA</th>
                            <th>PAGO </th>
                            <th>QUITAR </th>


                            <?php
                            $conciertosE = conciertoEsperando($idmusic);
                            while ($fila2 = mysqli_fetch_array($conciertosE)) {
                                extract($fila2);
                                echo"<tr>" .
                                "<td>$nombre_artistico</td>" .
                                "<td>$nombre</td>" .
                                "<td>$direccion</td>" .
                                "<td>$dia</td>"
                                . "<td>$hora</td>"
                                . "<td>$pago</td>"
                                . "<td><a href='?idmusicoQ=$idmusic&idconciertoQ=$id_concierto'>Quitar Solicitud</a></td>" .
                                "</tr>";
                            }

                            if (isset($_GET['idmusicoQ'], $_GET['idconciertoQ'])) {
                                $musicoQ = $_GET['idmusicoQ'];
                                $conciertoQ = $_GET['idconciertoQ'];
                                quitarSolicitud($musicoQ, $conciertoQ);
                                header("Location:http://www.bossmusicss.com/musico.php");
                            }
                            ?>
                        </table>
                    </div>
                    <div>
                        <h3>Concierto que toca</h3>
                        <table>
                            <tr>
                                <th>N0MBRE DEL LOCAL</th>
                                <th>NOMBRE DEL CONCIERTO</th>
                                <th>DIRECCION</th>
                                <th>DIA</th>
                                <th>HORA</th>
                                <th>PAGO </th>
                            </tr>
                            <?php
                            $conciertosT = conciertoQueToca($idmusic);
                            while ($fila3 = mysqli_fetch_array($conciertosT)) {
                                extract($fila3);
                                echo"<tr>" .
                                "<td>$nombre_artistico</td>" .
                                "<td>$nombre</td>" .
                                "<td>$direccion</td>" .
                                "<td>$dia</td>"
                                . "<td>$hora</td>"
                                . "<td>$pago</td>"
                                . "</tr>";
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