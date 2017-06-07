<header>
    <div id="cabecera">
        <h1 id="logo"><span id="l1">BOSS</span><span id="l2">MUSICSS</span></h1>
        <span class="menu" id="index"><a href="index.php"><button class="botonMenu">Inicio</button></a></span>
        <span class="menu" id="registro"><a href="<?php
            if ($tipo == 'l') {
                echo "local.php";
            } else if ($tipo == 'm') {
                echo "musico.php";
            } else if ($tipo == 'f') {
                echo "fans.php";
            }
            ?>"><button class="botonMenu">usuario</button></a></span>


        <span class="menu" id="buscador">
            <form id="bucador" name="search" method="post" action="resultadoBuscar.php">
                <input type="search" placeholder="buscar" name="buscar"> 
                <input type="submit" name="buscador" value="buscar" class="bottom">
            </form>
        </span>



        <span class="menu" id="idioma"> Idioma:<select name="idioma"><option>Castellano</option> 
                <option>Ingles</option> <option>Catalan</option>
            </select></span>         
    </div><div id="divLogin"><a href="<?php
        if ($tipo == 'l') {
            echo "local.php";
        } else if ($tipo == 'm') {
            echo "musico.php";
        } else if ($tipo == 'f') {
            echo "fans.php";
        }
        ?>"><img id="imgLogin" src="img_usu/<?php echo $img ?>" alt=""/></a> </div>
    <div id="menu">
        <img id="salida" src="img_pag/salir.png" alt=""  />
        <img id="imguser" src="img_usu/<?php echo $img ?>" alt=""/>
        <p><?php echo $usuario ?></p>
        <p>   <a href="salir.php"><button class="bottom">Salir</button></a></p>
        <?php
        if ($tipo == 'l') {
            echo ' <p> <span id="perfil"><a href="crearConcierto.php?concierto=crear">Crear Concierto</a></span></p>';
        }
        ?>
        <p> <span id="perfil"><a href="<?php
                                 if ($tipo == 'l') {
                                     echo "perfil_local.php";
                                 } else if ($tipo == 'm') {
                                     echo "perfil_musico.php";
                                 } else if ($tipo == 'f') {
                                     echo "perfil_fans.php";
                                 }
                                 ?>">Modificar perfil</a></span></p>
    </div>
</header>
