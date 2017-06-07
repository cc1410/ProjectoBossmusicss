<header>
    <div id="cabecera">
        <h1 id="logo"><span id="l1">BOSS</span><span id="l2">MUSICSS</span></h1>
        <span class="menu"id="index"><a href="index.php"><button class="botonMenu">Inicio</button></a></span>
        <span class="menu" id="registro"><a href="registro.php"><button class="botonMenu">Registro</button></a></span>
        <span class="menu" id="buscador"><form id="bucador" name="search" method="post" action="resultadoBuscar.php">
                <input type="search" placeholder="buscar" name="buscar"> 
                <input type="submit" name="buscador" value="buscar" class="bottom">
            </form></span>
        <span class="menu" id="idioma"> Idioma:<select name="idioma"><option>Castellano</option> 
                    <option>Ingles</option> <option>Catalan</option>
                </select></span>        
    </div><div id="divLogin"><img id="imgLogin" src="img_pag/login.png" alt=""/> </div><div id="menu">
        <img id="salida" src="img_pag/salir.png" alt=""/>
        <div id="login">
            <form action="" method="POST">
                <p>Usuario: <input type="text" name="usuario"></p>
                <p>Password: <input type="password" name="pass"></p>
                <p><input id="entrar" type="submit" name="entrar" value="entrar" class="bottom"></p>
                    <?php
                    if (isset($_POST["entrar"])) {
                        $usuario = $_POST["usuario"];
                        $pass = $_POST["pass"];
                        if (validateUser($usuario, $pass) == true) {
                            session_start();
                            $_SESSION["usuario"] = $usuario;
                            $perfil = getPerfilByUser($_SESSION["usuario"]);
                            $idusuario = getIdByUser($usuario);
                            $_SESSION["id"] = $idusuario;
                            $_SESSION["perfil"] = $perfil;

                            if ($perfil == "l") {
                                header("Location:http://www.bossmusicss.com/local.php");
                            } else if ($perfil == "m") {
                                header("Location:http://www.bossmusicss.com/musico.php");
                            } else if ($perfil == "f") {
                                header("Location:http://www.bossmusicss.com/fans.php");
                            }
                        } else {
                            echo "<p>Usuario o contraseña incorrectos.</p>";
                        }
                    }
                    ?>
            </form>
        </div>

        <a href="registro.php"><h6>Eres nuevo?</h6></a>
    </div>


</header>