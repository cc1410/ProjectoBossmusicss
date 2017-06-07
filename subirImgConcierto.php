<?php
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
                <title>Subir Foto</title>
            </head>
            <body>
                <?php
                include_once 'cabeceras/cabecera_usuario.php';
                ?>

                <div id="centro">
                    <div id="crear">
                        <h3>Si quiere subir una foto a tu concierto</h3>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input name="uploadedfile" type="file" />
                            <input type="submit"  name="foto" value="Subir archivo" class="bottom" />
                        </form>
                        <?php
                        if (isset($_POST['foto'])) {
                            $idcon = idConcierto($idlocal);
                            $target_path = "img_usu/";
                            $target_img = $target_path . $idcon . "concierto.jpg";
                            echo $target_img;
                            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_img)) {
                                echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
                                $imagen = $idcon . "concierto.jpg";
                                imagen($idcon, $imagen);
                                header("refresh:0;local.php");
                            } else {
                                echo "Ha ocurrido un error, intentelo otra vez!!";
                            }
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
?>