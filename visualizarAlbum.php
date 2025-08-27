<?php include('headprivado.php'); ?>

    <section id="usuarioPublico">
    
        <?php
            $usu = $_GET["Usuario"];
            $sentencia = 'SELECT * FROM usuarios WHERE IdUsuario = ' . $usu . '';
            if(!($resultado = @mysqli_query($link, $sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
            $Usuario = mysqli_fetch_assoc($resultado);

            $sentencia2 = 'SELECT * FROM albumes WHERE Usuario = ' . $usu . '';
            if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }

            echo '<label id="album" class="lab">';
            echo '<h3> Listado de Albumes </h3>';

            while( $Albumes = mysqli_fetch_assoc($resultado2)){
                echo '<label> <a href="datosAlbumPriv.php?Album=' . $Albumes['IdAlbum'] . '">Album ' . $Albumes['IdAlbum'] . ' </a></label>';
                echo '<label> Titulo: ' . $Albumes['Titulo'] . ' </label>';
                echo '<label> Descripcion: ' . $Albumes['Descripcion'] . ' </label><p></p>';
            }
            echo '</label>';
        ?>          
    </section>

    <?php include('footer.php'); ?>
</body>
</html> 