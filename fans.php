<?php
ob_start();
session_start();
require_once 'bbdd/fans_conexion.php';
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $idusuario = $_SESSION["id"];
    $tipo = $_SESSION["perfil"];
    $img = selectImagen($idusuario);
    if ($tipo == 'f') {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <link rel="icon" type="image/x-icon" href="img_pag/favicon.ico" />
                <script src="Jquery/jquery-3.2.0.min.js" type="text/javascript"></script>
                <script src="Jquery/jsmenu.js" type="text/javascript"></script>
                <link href="css/cssCabeceraHome.css" rel="stylesheet" type="text/css"/>
                <link href="css/cssFans.css" rel="stylesheet" type="text/css"/>
                <title>Home_Fans</title>
            </head>
            <body>
                <?php
                include_once 'cabeceras/cabecera_usuario.php';
                ?>
                <div id="centro">
                    <div id="tabla1">
                        <table>
                            <th>NOMBRE LOCAL</th>
                            <th>CIUDAD</th>
                            <th>NOMBRE MUSICO</th>
                            <th>DIA</th>
                            <th>HORA</th>
                            <th>VOTOS</th>
                            <th></th>
                            <?php
                            $concierto = votoConcierto();

                            while ($fila = mysqli_fetch_array($concierto)) {
                                extract($fila);

                                echo"<tr>" .
                                "<td>$nomlocal</td>" .
                                "<td>$ciudad</td>" .
                                "<td>$nommusico</td>" .
                                "<td>$dia</td>" .
                                "<td>$hora</td>";
                                $idconcierto = mostrarIdconcierto($nomlocal, $dia, $hora);
                                $votos = numVotoConcierto($idconcierto);
                                echo "<td>$votos</td>";
                                echo "<form action='' method='POST'>";
                                if (comprobarVotoConcierto($idusuario, $idconcierto) == true) {
                                    echo "<td><input type='submit' value='-1' id='-1' name='restar' class='votos'></td>";
                                    echo "<input type='hidden' name='con' value='$idconcierto'>";
                                } else {
                                    echo "<td> <input type='submit' value='+1' id='1' name='sumar' class='votos'></td>";
                                    echo "<input type='hidden' name='con' value='$idconcierto'>";
                                } echo "</form>";

                                "</tr>";
                            }
                            if (isset($_POST["restar"])) {
                                $concier = $_POST["con"];
                                restarVotosConcierto($idusuario, $concier);
                                header("Location:http://www.bossmusicss.com/fans.php");
                            }

                            if (isset($_POST["sumar"])) {
                                $concier = $_POST["con"];
                                sumarVotosConcierto($idusuario, $concier);
                                header("Location:http://www.bossmusicss.com/fans.php");
                            }
                            ?>
                        </table>

                    </div>
                    <div id="tabla2">
                        <?php
                        if (isset($_GET["contador"])) {
                            $contador = $_GET["contador"];
                        } else {
                            $contador = 0;
                        }
                        $total = totalMusico();
                        ?>

                        <table>
                            <th>IMAGEN</th>
                            <th>NOMBRE MUSICO</th>
                            <th>VOTOS</th>
                            <th></th>
                            <?php
                            $musico = votoMusico($contador, 5);

                            while ($fila = mysqli_fetch_array($musico)) {
                                extract($fila);
                                echo"<tr>" .
                                "<td>$imagen</td>" .
                                "<td>$nombre_artistico</td>";
                                $votos = numVotoMusico($idmusic);
                                echo "<td>$votos</td>";
                                echo "<form action='' method='POST'>";
                                if (comprobarVotoMusico($idusuario, $idmusic) == true) {
                                    echo "<td><input type='submit' value='-1' id='-1' name='restar2' class='votos'></td>";
                                    echo "<input type='hidden' name='music' value='$idmusic'>";
                                } else {
                                    echo "<td> <input type='submit' value='+1' id='1' name='sumar2' class='votos'></td>";
                                    echo "<input type='hidden' name='music' value='$idmusic'>";
                                } echo "</form>";

                                "</tr>";
                            }
                            if (isset($_POST["restar2"])) {
                                $music = $_POST["music"];
                                restarVotosMusic($idusuario, $music);
                                header("Location:http://www.bossmusicss.com/fans.php");
                            }

                            if (isset($_POST["sumar2"])) {
                                $music = $_POST["music"];
                                sumarVotosMusic($idusuario, $music);
                                header("Location:http://www.bossmusicss.com/fans.php");
                            }
                            ?>
                        </table>
                        <?php
                        if ($contador > 0) {
                            echo "<a href='fans.php?contador=" . ($contador - 5) . "'> <img class='flecha' src='img_pag/flecha_izquierda.png' /> </a>";
                        }
                        if (($contador + 5) <= $total) {
                            echo "Mostrando de " . ($contador + 1) . " a " . ($contador + 5) . " de $total";
                        } else {
                            echo "Mostrando de " . ($contador + 1) . " a $total de $total";
                        }

                        if (($contador + 5) < $total) {
                            echo "<a href='fans.php?contador=" . ($contador + 5) . "'>  <img class='flecha' src='img_pag/flecha_derecha.png' /></a>";
                        }
                        ?>



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

