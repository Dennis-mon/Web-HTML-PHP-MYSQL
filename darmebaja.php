<?php
include('headprivado.php'); 
?> 

    <?php
        $id = $_GET["Usuario"]; 
        $_SESSION["id"] = $id;
    ?>

    <form action="darmedebaja.php" id="formborrar" method="post" class="formularios">
        <h2>Resumen del Usuario</h2>
        <fieldset>
            <legend>Datos</legend>
                <?php
                    $sentencia = 'SELECT * FROM fotos f, albumes a WHERE f.Album = a.IdAlbum AND a.Usuario = ' . $id . '';
                    if(!($resultado = @mysqli_query($link, $sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
                        echo '</p>';
                        exit;
                    }
                    $totalFotos = mysqli_num_rows($resultado);

                    echo '<p>';
                    echo '<label>Número total de fotos: ' . $totalFotos . '</label>';
                    echo '</p>';

                    $sentencia1 = 'SELECT * FROM albumes WHERE Usuario = ' . $id . '';
                    if(!($resultado1 = @mysqli_query($link, $sentencia1))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
                        echo '</p>';
                        exit;
                    }
                    while($fila = mysqli_fetch_assoc($resultado1)){
                        $sentencia2 = 'SELECT * FROM fotos WHERE Album = ' . $fila['IdAlbum'] . '';
                            if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
                                echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
                                echo '</p>';
                                exit;
                            }
                        $fotos = mysqli_num_rows($resultado2);

                        echo '<p>';
                        echo '<label> El Álbum: ' . $fila['Titulo'] . ' contiene ' . $fotos . ' fotos </label>';
                        echo '</p>';
                    }
                ?>

                <p>
                    <label for="pass">Contraseña del Usuario (Asegurese de que la contraseña es correcta, sino no se procederá al borrado): </label>
                    <input type="password" name="pass">
                </p>
                <p><input type="submit" value="Eliminar Usuario" class="boton_fin"></p>
        </fieldset>  
                </form>

    <?php 
        include('footer.php');
        // Libera la memoria ocupada por el resultado
        mysqli_free_result($resultado);
        // Cierra la conexión
        mysqli_close($link);
    ?>

</body>
</html> 