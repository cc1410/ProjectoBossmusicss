<?php
ob_start();
require_once 'bbdd/registro_conexion.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="icon" type="image/x-icon" href="img_pag/favicon.ico" />
        <script src="Jquery/jquery-3.2.0.min.js" type="text/javascript"></script>
        <script src="Jquery/jsmenu.js" type="text/javascript"></script>
        <script src="Jquery/jqRegistro.js" type="text/javascript"></script>
        <link href="css/cssCabeceraHome.css" rel="stylesheet" type="text/css"/> 
        <link href="css/cssRegistro.css" rel="stylesheet" type="text/css"/>


    </head>
    <body>
        <?php
        include_once 'cabeceras/cebecera_home.php';
        ?>

        <div id='centro'>
            <div>
                <button class="bottom registro" id="local">Local</button>
                <button class="bottom registro" id="musico">Musico</button>
                <button class="bottom registro" id="fans">Fans</button>
            </div>

            <?php
            if (isset($_POST["enviarMusico"])) {
                $usuario = $_POST["usuario"];

                if (existUser($usuario) == true) {
                    ?>  <script type="text/javascript">
                        alert("Ya existe un usuario con este nombre");
                    </script>
                    <?php
                } else {
                    $password = $_POST["pass"];
                    $conpass = $_POST["pass2"];
                    if ($password != $conpass) {
                        ?>  <script type="text/javascript">
                            alert("Los Password no coinciden");
                        </script>
                        <?php
                    } else {
                        $email = $_POST["email"];
                        $nombre = $_POST["nombre"];
                        $genero = $_POST["gen"];
                        altaMusico($usuario, $password, $email, $nombre, $genero);
                        header("Location:http://www.bossmusicss.com");
                    }
                }
            }
            ?>
            <?php
            if (isset($_POST["enviarFans"])) {
                $usuario = $_POST["usuario"];
                if (existUser($usuario) == true) {
                    ?>  <script type="text/javascript">
                        alert("Ya existe un usuario con este nombre");
                    </script>
                    <?php
                } else {
                    $mail = $_POST["email"];
                    $pass = $_POST["pass"];
                    $con2 = $_POST["pass2"];
                    if ($pass != $con2) {
                        ?>  <script type="text/javascript">
                            alert("Los Password no coinciden");
                        </script>
                        <?php
                    } else {
                        $sexo = $_POST["sex"];
                        altaFans($usuario, $pass, $mail, $sexo);
                        header("Location:http://www.bossmusicss.com");
                    }
                }
            }
            ?>
            <?php
            if (isset($_POST['enviarLocal'])) {
                $usuario = $_POST['user'];
                if (existUser($usuario)) {
                    ?>  <script type="text/javascript">
                        alert("Ya existe un usuario con este nombre");
                    </script>
                    <?php
                } else {
                    $contrasena = $_POST['pass'];
                    $con2 = $_POST['pass2'];
                    if ($contrasena != $con2) {
                        ?>  <script type="text/javascript">
                            alert("Los Password no coinciden");
                        </script>
                        <?php
                    } else {
                        $nombre = $_POST['local'];
                        $mail = $_POST['mail'];
                        $direccion = $_POST['localidad'];
                        $aforo = $_POST['aforo'];
                        altaLocal($usuario, $contrasena, $mail, $nombre, $direccion, $aforo);
                        header("Location:http://www.bossmusicss.com");
                    }
                }
            }
            ?>
            <div id="regFans">
                <h3>Datos del Usuario</h3>
                <form action="" autocomplete="" method="POST">
                    <p>Usuario: <input type="text" name="usuario" required></p>
                    <p>Email:<input type="email" name="email" required></p>
                    <p>Password:<input type="password" name="pass" required></p>
                    <p>Confimar Password:<input type="password" name="pass2" required></p>
                    <p>Sexo: hombre<input type="radio" name="sex" value="h">
                        mujer<input type="radio" name="sex" value="m"></p>
                    <p><input id="alta" type="submit" name="enviarFans" value="dar alta"></p>
                </form>



            </div>

            <div id="regLocal">
                <h3>Datos del Usuario</h3>
                <form action='' autocomplete='' method='POST'>
                    <p>usuario: <input type='text' name='user' required></p>
                    <p>Correo: <input type='email' name='mail' required></p>
                    <p>Password:<input type='password' name='pass' required></p>
                    <p>Confimar Password:<input type='password' name='pass2' required></p>

                    <h3>Datos del Local</h3>

                    <p>Nombre Local:<input type='text' name='local'></p>
                    <p> Direccion:<input type='text' name='localidad'></p>
                    <p> Aforo:<input type='number' name='aforo'></p>
                    <p><input id="alta" type='submit' value='DAR DE ALTA' name='enviarLocal'></p>

                </form>



            </div>

            <div id="regMusico">
                <h3>Datos del Usuario</h3>
                <form  action = "" autocomplete = "" method = "POST">
                    <p>Usuario: <input type = "text" name = "usuario"></p>
                    <p>Password:<input type = "password" name = "pass"></p>
                    <p> Confirmar Password:<input type = "password" name = "pass2"></p>
                    <p>Mail:<input type = "email" name = "email"></p>
                    <p>Nombre Artistico:<input type = "text" name = "nombre"></p>
                    <p>Genero:<select name='gen'>
                            <?php
                            $genero = genero();
                            while ($fila = mysqli_fetch_array($genero)) {
                                extract($fila);
                                echo "<option value='$idgenero'> $nomestilo</option>";
                            }
                            ?>
                        </select></p>
                    <p><input id="alta" type="submit" name="enviarMusico" value="Dar de alta"></p>

                </form>


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