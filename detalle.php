<?php include('headpublic.php'); ?>

<?php
    $res = $_GET["fondo"];

    // Buscamos la foto por el ID
    $sentencia = 'SELECT * FROM fotos WHERE IdFoto = ' . $res . ' ';
    if(!($resultado = @mysqli_query($link, $sentencia))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
        echo '</p>';
        exit;
    }
    $foto = mysqli_fetch_assoc($resultado);
    $new_date=date("d/m/Y", strtotime($foto['Fecha']));
    echo    '<section id="detalle_foto" action="registro.php">
                <label>
                    <h2>Título: ' . $foto['Titulo'] . ' </h2>
                    <img id="detalle_foto" src="./' . $foto['Fichero'] . '"  alt="' . $foto['Alternativo'] . '">
                </label>
                <label>
                    <p>Descripción: ' . $foto['Descripcion'] . '</p>
                    <p>Fecha: ' . $new_date . '</p>';

    //Buscamos el Pais al que pertenece la foto
    $sentencia2 = 'SELECT * FROM paises WHERE IdPais = ' . $foto['Pais'] . ' ';
    if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
        echo '</p>';
        exit;
    }
    $pais = mysqli_fetch_assoc($resultado2);
    echo '<p>País: ' . $pais['NomPais'] . '</p>';

    //Buscamos el Album al que pertenece la foto
    $sentencia3 = 'SELECT * FROM albumes WHERE IdAlbum = ' . $foto['Album'] . ' ';
    if(!($resultado3 = @mysqli_query($link, $sentencia3))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia3</b>: " . mysqli_error($link);
        echo '</p>';
        exit;
    }
    $album = mysqli_fetch_assoc($resultado3);

    echo           '<p><a href="datosAlbumPublico.php?Album=' . $foto['Album'] . '">Álbum al que pertenece: ' . $album['Titulo'] . '</a></p>';

    //Buscamos el Usuario al que pertenece el Album
    $sentencia4 = 'SELECT * FROM usuarios WHERE IdUsuario = ' . $album['Usuario'] . ' ';
    if(!($resultado4 = @mysqli_query($link, $sentencia4))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia4</b>: " . mysqli_error($link);
        echo '</p>';
        exit;
    }
    $Usuario = mysqli_fetch_assoc($resultado4);

    echo           '<p><a href="perfilUsuPublico.php?Usuario=' . $album['Usuario'] . '">Usuario al que pertenece: ' . $Usuario['NomUsuario'] .' </a></p>
                </label> 
            </section>';
?>
    <?php include('footer.php'); ?>
</body>
</html>