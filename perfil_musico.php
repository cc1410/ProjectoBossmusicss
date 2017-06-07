<?php
session_start();
require_once 'bbdd/musico_conexion.php';
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $idusuario = $_SESSION["id"];
    $tipo = $_SESSION["perfil"];
    $img = selectImagen($idusuario);
    if ($tipo == 'm') {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <link rel="icon" type="image/x-icon" href="img_pag/favicon.ico" />
                <script src="Jquery/jquery-3.2.0.min.js" type="text/javascript"></script>
                <script src="Jquery/jsmenu.js" type="text/javascript"></script>
                <script src="Jquery/jsPass.js" type="text/javascript"></script>
                <link href="css/cssCabeceraHome.css" rel="stylesheet" type="text/css"/>
                <link href="css/cssMusico.css" rel="stylesheet" type="text/css"/>
                <title>Perfil</title>
            </head>
            <body>
                <?php
                include_once 'cabeceras/cabecera_usuario.php';
                ?>
                <div id="centro">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                        $datos = mostrarInforMusico($idusuario);
                        $fila = mysqli_fetch_array($datos);
                        extract($fila);
                        $idc = $idciudad;
                        if (isset($_POST['foto'])) {
                            $target_path = "img_usu/";
                            $target_img = $target_path . $idusuario . "foto.jpg";
                            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_img)) {
                                echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
                                $imagen = $idusuario . "foto.jpg";
                                imagen($idusuario, $imagen);
                                header("refresh:2;url=http://www.bossmusicss.com/perfil_musico.php");
                            } else {
                                echo "Ha ocurrido un error, intentelo otra vez!!";
                            }
                        }
                        ?>



                        <p>Usuario: <input type="text" name="usuario" value="<?php echo $usuario ?>"></p>
                        <p>Nombre Musico: <input type="text" name="nom" value="<?php echo $nombre_artistico ?>"></p>
                        <input name="uploadedfile" type="file" />
                        <input type="submit"  name="foto" value="Subir archivo" class="bottom" />
                        <p>Telefono: <input type="text" name="telefono" value="<?php echo $telefono ?>"></p>
                        <p>Direccion: <input type="text" name="direccion" value="<?php echo $direccion ?>"></p>
                        <p>
                            Ciudad: <select name="ciudad">
                                <?php
                                $c = ciudadMusico();
                                while ($fila1 = mysqli_fetch_array($c)) {
                                    extract($fila1);
                                    if ($idciudad == $idc) {
                                        echo "<option value='$idciudad' selected>$ciudad</option>";
                                    } else {
                                        echo "<option value='$idciudad' selected>$ciudad</option>";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <p><input type="submit" name="modificar" value="Modificar" class="bottom"></p>
                    </form>
                    <!--cambiar password-->
                    <p> <button id="cambiar" class="bottom">Cambiar Password</button></p>
                    <div id="cambiar_password">
                        <form action="" method="POST">
                            <p>Password actual: <input type="password" name="pass_actual"></p>
                            <p>Nuevo password: <input type="password" name="pass_nuevo"></p>
                            <p>Confirmar password: <input type="password" name="conf_pass"></p>
                            <p><input type="submit" name="cambiar" value="Cambiar Password"></p>
                        </form>
                    </div>
                    <?php
                    if (isset($_POST["modificar"])) {
                        $usu = $_POST["usuario"];
                        $nom_musico = $_POST["nom"];
                        $ciu = $_POST["ciudad"];
                        $tele = $_POST["telefono"];
                        $direc = $_POST["direccion"];
                        modificarMusico($idusuario, $usu, $nom_musico, $ciu, $tele, $direc);
                        header("refresh:1;url=http://www.bossmusicss.com/perfil_musico.php");
                    }
                    if (isset($_POST["cambiar"])) {
                        $pass_actual = $_POST["pass_actual"];
                        if (confPass($pass_actual, $usuario)) {
                            $pass_nuevo = $_POST["pass_nuevo"];
                            $conf_pass = $_POST["conf_pass"];
                            if ($pass_nuevo == $conf_pass) {
                                cambiarPass($pass_nuevo, $usuario);
                            } else {
                                echo "La contraseña no coincite";
                            }
                        } else {
                            echo "La contraseña no coincite";
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