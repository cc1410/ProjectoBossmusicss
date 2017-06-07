<?php
session_start();
require_once 'bbdd/local_conexion.php';
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $idlocal = $_SESSION["id"];
    $tipo = $_SESSION["perfil"];
    $img = selectImagen($idlocal);
    $fechaActual = date("Y-m-d");
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
                <title>Crear Concierto</title>
            </head>
            <body>
                <?php
                include_once 'cabeceras/cabecera_usuario.php';
                ?>

                <div id="centro">
                    <?php
                    if ($_GET["concierto"] == 'crear') {
                        ?>
                        <div id="crear">
                            <h3>Crear Concierto</h3>

                            <form action="" method="POST">
                                <p> Nombre de concierto:<input type="" value="" name ="even"></p>
                                <p>Fecha:<input type ="date" value="<?php echo $fechaActual ?>" name ="date" min="<?php echo $fechaActual ?>" ></p>
                                <p>Hora:<input type ="time" value="" name="time"></p>
                                <p>Pago:<input type="number" value="" name="pago"></p>
                                <p>Genero:<select name="genero">
                                        <?php
                                        $genero = genero();
                                        while ($fila = mysqli_fetch_array($genero)) {
                                            extract($fila);
                                            echo "<option value='$idgenero'>$nomestilo</option>";
                                        }
                                        ?>
                                    </select></p>
                                <p>  <input type="submit" name="enviar" value="enviar" class="bottom"></p>
                            </form>
                            <?php
                            if (isset($_POST['enviar'])) {

                                $nombre = $_POST['even'];
                                $fecha = $_POST['date'];
                                $hora = $_POST['time'];
                                $genero = $_POST['genero'];
                                $pago = $_POST['pago'];

                                crearconcierto($nombre, $fecha, $hora, $genero, $idlocal, $pago);
                                header("Location:http://www.bossmusicss.com/subirImgConcierto.php");
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_GET["concierto"] == 'modificar') {
                        $idconcierto = $_GET["idconcierto"];
                        $datos = selectConcierto($idconcierto);
                        $fila = mysqli_fetch_array($datos);
                        extract($fila);
                        ?>
                        <div id="modificar">
                            <h3>Datos de concierto</h3>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <p>Nombre: <input type="text" name="nombre" value="<?php echo $nombre ?>"</p>
                                <p>Fecha: <input type="date" name="fecha" value="<?php echo $dia ?>"></p>
                                <p>Hora: <input type="time" name="hora" value="<?php echo $hora ?>"></p>
                                <p>Pago: <input type="number" name="pago" value="<?php echo $pago ?>"></p>
                                <?php
                                if (isset($_POST['foto'])) {
                                    $target_path = "img_usu/";
                                    $target_img = $target_path . $idconcierto . "foto.jpg";
                                    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_img)) {
                                        echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
                                        $imagen = $idconcierto . "foto.jpg";
                                        imagenConcierto($idconcierto, $imagen);
                                    } else {
                                        echo "Ha ocurrido un error, intentelo otra vez!!";
                                    }
                                }
                                ?>
                                <p>  <input name="uploadedfile" type="file" />
                                    <input type="submit"  name="foto" value="Subir archivo" class="bottom" /></p>
                                <p>  <input type="submit" name="modificar" value="Modificar" class="bottom"></p>
                            </form>
                        </div>

                        <?php
                        if (isset($_POST["modificar"])) {
                            $nom = $_POST["nombre"];
                            $f = $_POST["fecha"];
                            $h = $_POST["hora"];
                            $p = $_POST["pago"];

                            modificarConcierto($idconcierto, $nom, $f, $h, $p);
                            header("refresh:1;url=http://www.bossmusicss.com/local.php");
                        }
                    }
                    ?>
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
?>