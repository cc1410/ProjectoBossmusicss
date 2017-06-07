<?php
ob_start();
require_once 'bbdd/index_conexion.php';
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="icon" type="image/x-icon" href="img_pag/favicon.ico" />
        <script src="Jquery/jquery-3.2.0.min.js" type="text/javascript"></script>
        <script src="Jquery/jsmenu.js" type="text/javascript"></script>
        <link href="css/cssResultado.css" rel="stylesheet" type="text/css"/>
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
            <div>
                <h3>Resultados de la busqueda</h3>

                <?php
                $buscar = $_POST['buscar'];
                $datos = buscadornom($buscar);
                echo "<h3>Informacion de usuario</h3>";
                echo "<table>";
                echo " <th>NOMBRE USUARIO</th>
                            <th>DIRECCION</th>
                            ";
                while ($fila = mysqli_fetch_array($datos)) {
                    extract($fila);
                    echo "<tr>";
                    echo "<td>$nombre_artistico</td>";
                    echo "<td>$direccion</td>";
                    echo "</tr>";
                }

                echo "</table>";

                $datosl = buscadorcon($buscar);
                echo "<h3>Informacion de Concierto</h3>";
                echo "<table>";
                echo " <th>NOMBRE CONCIERTO</th>
                            <th>NOMBRE DE LOCAL</th>
                            <th>FECHA</th>
                            ";
                while ($fila2 = mysqli_fetch_array($datosl)) {
                    extract($fila2);
                    echo "<tr>";
                    echo "<td>$nombre</td>";
                    echo "<td>$nombre_artistico</td>";
                    echo "<td>$dia</td>";
                    echo "</tr>";
                }

                echo "</table>";

                $datos2 = buscaConM($buscar);
                echo "<h3>Concierto de musico</h3>";
                echo "<table>";
                echo " <th>NOMBRE LOCAL</th>
                    <th>NOMBRE CONCIERTO</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            
                            ";
                while ($fila3 = mysqli_fetch_array($datos2)) {
                    extract($fila3);
                    echo "<tr>";
                    echo "<td>$nombre_artistico</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$dia</td>";
                    echo "<td>$hora</td>";
                    echo "</tr>";
                }

                echo "</table>";
                ?>

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