<?php
ob_start();
require_once 'bbdd/index_conexion.php';
session_start();
if (isset($_GET["salir"])) {
    session_destroy();
    header("Location:index.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="icon" type="image/x-icon" href="img_pag/favicon.ico" />
        <script src="Jquery/jquery-3.2.0.min.js" type="text/javascript"></script>
        <script src="Jquery/jsmenu.js" type="text/javascript"></script>
        <link href="css/cssIndex.css" rel="stylesheet" type="text/css"/>
        <link href="css/cssCabeceraHome.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        if (isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];
            $idusuario = $_SESSION["id"];
            $tipo = $_SESSION["perfil"];
            $img = selectImagen($idusuario);
            include 'cabeceras/cabecera_usuario.php';
        } else {
            include 'cabeceras/cebecera_home.php';
        }
        ?>

        <div id="centro">
            <div id="izquierda">
                <?php
                if (isset($_GET["contador"])) {
                    $contador = $_GET["contador"];
                } else {
                    $contador = 0;
                }
                $total = totalConciertoAceptado();
                ?>



                <?php
                $concierto = agentaConcierto($contador, 5);
                while ($fila = mysqli_fetch_array($concierto)) {
                    extract($fila);
                    echo "<div id='concierto'>";
                    echo "<div id='imgConcierto'><img src='img_usu/$foto_concierto'></div>";
                    echo "<div id='detalles'>";
                    echo "<p>Nombre de Concierto:<span id='l1'> $nombre</span></p>";
                    echo "<p>Nombre de Local:<span id='l1'> $nombre_artistico</span></p>";
                    echo "<p>Direccion:<span id='l1'> $direccion</span></p>";
                    echo "<p>Fecha/Hora:<span id='l1'> $dia</span></p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>

                <?php
                if ($contador > 0) {
                    echo "<a href='index.php?contador=" . ($contador - 5) . "'> Anterior </a>";
                }
                if (($contador + 5) <= $total) {
                    echo "Mostrando de " . ($contador + 1) . " a " . ($contador + 5) . " de $total";
                } else {
                    echo "Mostrando de " . ($contador + 1) . " a $total de $total";
                }

                if (($contador + 5) < $total) {
                    echo "<a href='index.php?contador=" . ($contador + 5) . "'> Siguiente</a>";
                }
                ?>
            </div>
            <div id="derecha">
                <div id="derecha2">
                    <div id="rank">
                        <?php
                        if (isset($_GET["contador2"])) {
                            $contador2 = $_GET["contador2"];
                        } else {
                            $contador2 = 0;
                        }
                        ?>

                        <h3>Ranking de musicos</h3>

                        <?php
                        $musico = rankingMusico($contador2, 1);
                        while ($fila = mysqli_fetch_array($musico)) {
                            extract($fila);
                            echo "<div id='musico'>";
                            echo "<div id='imgMusico'><img src='img_usu/$fotomusico'></div>";
                            echo "<div id='detallesMusico'>";
                            echo "<p>Nombre de Musico:<span id='l1'> $nombre_artistico</span></p>";
                            echo "<p>Estilo:<span id='l1'> $nomestilo</span></p>";
                            echo "<p>Votos:<span id='l1'> $votos</span></p>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>

                        <?php
                        if ($contador2 > 0) {
                            echo "<a href='index.php?contador2=" . ($contador2 - 1) . "'> Anterior </a>";
                        }
                        if (($contador2 + 1) < 5) {
                            echo "<a href='index.php?contador2=" . ($contador2 + 1) . "'> Siguiente</a>";
                        }
                        ?>
                    </div>
                    <div id="banners">
                        <div class="banner">
                            <a href="https://www.atiza.com/musicos/escuelasmusica.htm">
                                <img src="img_pag/clasemusica.PNG" alt=""/>

                                <p>
                                    Quieres aprendes musica??

                                </p>
                            </a>
                        </div>
                        <div class="banner">
                            <a href="http://www.outletbarcelona.info/blog/outlet-musical-tu-tienda-de-instrumentos-outlet-en-barcelona/">

                                <img src="img_pag/instrumentos.PNG" alt=""/>
                                <p>
                                    Outlet Musical!!
                                </p>
                            </a>
                        </div>
                        <div class="banner">
                            <a href="https://www.musicalesbarcelona.com/">
                                <img src="img_pag/musicales.PNG" alt=""/>

                                <p>
                                    Musicales en Barcelona
                                </p>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <?php
        include "footer/footer.php";
        ?>
    </body>
</html>
<?php
ob_end_flush();
?>