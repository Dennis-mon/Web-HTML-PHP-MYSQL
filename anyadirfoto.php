<?php include('headprivado.php'); ?>
    
        <div id="datos_album2">
            <h3>Solicitud de añadir foto a álbum</h3>
            <p>Mediante esta opción podrás añadir una foto al álbum rellenando los siguientes campos</p>
        </div>
        <form action="anyadirfotohecha.php" id="album" method="post" class="formularios"  enctype="multipart/form-data">
            <fieldset>
                <legend>Formulario de añadir foto</legend>
                <p id="subtitulo">Rellena este formulario aportando todos los datos.</p>
                <?php
                    if(isset($_GET["error"]) && $_GET["error"]=="T"){
                        echo '<p id="subtitulo">Es necesario introducir un título para la foto</p>';
                    }
                    if(isset($_GET["error"]) && $_GET["error"]=="A"){
                        echo '<p id="subtitulo">La longitud minima del texto alternativo es de 10 caracteres</p>';
                    }
                    if(isset($_GET["error"]) && $_GET["error"]=="AM"){
                        echo '<p id="subtitulo">El texto alternativo no puede comenzar por un texto redundante</p>';
                    }
                ?>
                <p>
                    <label for="foto">Foto: </label>
                    <input type="file" name="foto" id="foto">
                </p>
                <p>
                    <label for="titulo">Título de la foto</label>
                    <input type="text" name="titulo" id="titulo" maxlength="200" placeholder="Título">
                </p>
                <p>
                    <label>Fecha de la foto: </label>
                    <input type="text" placeholder="dd/mm/aaaa" name="frec">
                </p>
                <p>
                    <label for="texta">Descripción de la foto:</label>
                    <textarea name="texta" id="texta" cols="40" rows="5" placeholder="Dedicatoria, descripcción, etc." class="textarea"></textarea>
                </p>
                <p>
                    <label>Texto alternativo de la foto: </label>
                    <input type="text" placeholder="Texto Alternativo" name="textoalt">
                </p>
                <p>
                <label for="country">País: </label>
                    <select name="country" id="country">
                        <?php
                            // Ejecuta una sentencia SQL
                            $sentencia = 'SELECT * FROM paises ORDER BY NomPais ASC';
                            if(!($resultado = @mysqli_query($link, $sentencia))) {
                                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                                echo '</p>';
                                exit;
                            }

                            // Recorre el resultado y lo mostramos los paises
                            while($fila = mysqli_fetch_assoc($resultado)) {
                                echo '<option value ="' . $fila['IdPais'] . '">' . $fila['NomPais'] . '</option>';
                            }
                        ?>
                    </select>
                </p> 
                <p>
                    <label>Álbum al que añadir</label>
                    <select name="album">
                    <?php

                        if(isset($_GET["album"]) && $_GET["album"]=="S"){
                            $sentencia = 'SELECT * FROM albumes a, usuarios u WHERE a.Usuario = u.IdUsuario AND u.NomUsuario = "' . $_SESSION['usuario'] . '" ORDER BY a.IdAlbum DESC';
                            if(!($resultado = @mysqli_query($link, $sentencia))) {
                                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                                echo '</p>';
                                exit; 
                            }
                            $fila = mysqli_fetch_assoc($resultado);
                            echo '<option value="' . $fila['IdAlbum'] . '">' . $fila['Titulo'] . '</option>';
                           
                        } else {
                            $sentencia = 'SELECT a.* FROM albumes a, usuarios u WHERE a.Usuario = u.IdUsuario AND u.NomUsuario = "' . $_SESSION['usuario'] . '" ';
                            if(!($resultado = @mysqli_query($link, $sentencia))) {
                                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                                echo '</p>';
                                exit; 
                            }
                            while($fila = mysqli_fetch_assoc($resultado)) {
                                echo '<option value="' . $fila['IdAlbum'] . '">' . $fila['Titulo'] . '</option>';
                            }
                        }
                    ?>
                    </select>
                </p>
                <p><input type="reset" value="Limpiar formulario" class="boton_fin"><input type="submit" value="Añadir Foto" class="boton_fin"></p>
            </fieldset>
        </form>
    <?php include('footer.php'); ?>
</body>
</html>