<?php include('headprivado.php'); ?>
    
        <div id="datos_album2">
            <h3>Solicitud de impresión de álbum</h3>
            <p>Mediante esta opción puedes solicitar la impresión y envío de uno de tus álbumes a todo color, toda resolución, rellenando los campos necesarios aquí presentes.</p>
        
        <?php
            echo '<p>Álbumes del usuario: </p>';
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
            $album = mysqli_fetch_assoc($resultado2);
            //echo '<p> <a href="datosAlbumPriv.php?Album=' . $album['IdAlbum'] . '">Album ' . $album['IdAlbum'] . ' </a></p>';
            
        ?>
        </div>
        <table id="Tarifas">
            <caption>Tarifas</caption>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Tarifa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>-5 páginas</td>
                    <td>0.10€ por pág.</td>
                    
                </tr>
                <tr>
                    <td>Entre 5 y 11 páginas</td>
                    <td>0.08€ por pág.</td>
                </tr>
                <tr>
                    <td>+11 páginas</td>
                    <td>0.07€ por pág.</td>
                </tr>
                <tr>
                    <td>Blanco y negro</td>
                    <td>0€</td>
                    
                </tr>
                <tr>
                    <td>Color</td>
                    <td>0.05€ por foto</td>
                </tr>
                <tr>
                    <td>Resolución > 300 dpi</td>
                    <td>0.02€ por foto</td>
                </tr>
            </tbody>
        </table>

        <script>
            var tabla = new crearTabla();
        </script>
       
        <form action="resumenalbum.php" id="album" method="post" class="formularios">
            <fieldset>
                <legend>Formulario de solicitud</legend>
                <p id="subtitulo">Rellena este formulario aportando todos los detalles de tu álbum deseado.</p>
                <p>
                    <label for="name">Nombre (*)</label>
                    <input type="text" name="name" id="name" maxlength="200" placeholder="Su nombre" required>
                </p>
                <p>
                    <label for="titulo">Título del álbum (*)</label>
                    <input type="text" name="titulo" id="titulo" maxlength="200" placeholder="Título" required>
                </p>
                <p>
                    <label for="texta">Texto Adicional</label>
                    <textarea name="texta" id="texta" cols="40" rows="5" placeholder="Dedicatoria, descripcción, etc." class="textarea"></textarea>
                </p>
                <p>
                    <label for="email">Email (*)</label>
                    <input type="email" name="email" id="email" maxlength="200" placeholder="Tu e-mail" required>
                </p>
                <p>
                    <div>
                        <label for="Dirección" class="divlabel">Dirección (*)</label>
                        <input type="text" placeholder="Calle" name="calle" required>
                        <p><input type="number" placeholder="Número" name="numero" required class="pint"></p>
                        <p><input type="number" placeholder="CP" name="cp" max="99999" required class="pint"></p>
                        <p> <select class="direccion" name="dir">
                                <option value="Localidad">Localidad</option>
                            </select>
                        </p>
                        <p> <select class="direccion" name="prov">
                                <option value="Provincia">Provincia</option>
                            </select>
                        </p>
                    </div>
                </p>
                <p>
                    <label for="telefono">Teléfono</label>
                    <input type="number" name="telefono" id="telefono" placeholder="+34 #########">
                </p>
                <p>
                    <label for="colorp">Color de la portada</label>
                    <select name="colorp" id="colorp">
                        <option value="Rojo">Rojo</option>
                        <option value="Verde">Verde</option>
                        <option value="Azul">Azul</option>
                    </select>
                </p>
                <p>
                    <label for="number">Número de copias</label>
                    <input type="number" min="1" value="1" name="paginas">
                </p>
                <p>
                    <label>Resolución DPI</label>
                    <select name="dpi">
                        <option value="150">150</option>
                        <option value="300">300</option>
                        <option value="450">450</option>
                        <option value="600">600</option>
                        <option value="750">750</option>
                        <option value="900">900</option>
                    </select>
                </p>
                <p>
                    <label>Fecha aproximada de recepción</label>
                    <input type="text" placeholder="dd/mm/aaaa" name="frec">
                </p>
                <p>
                    <label>Álbum (*)</label>
                    <select name="album">
                    <?php
                        $sentencia = 'SELECT * FROM albumes';
                        if(!($resultado = @mysqli_query($link, $sentencia))) {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                            echo '</p>';
                            exit;
                        }
                        while($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['IdAlbum'] . '">' . $fila['Titulo'] . '</option>';
                        }
                    ?>
                    </select>
                </p>
                <p>
                    <label>¿Impresión a color?</label>
                    <input type="checkbox" name="color">
                </p>
                <p>
                    <input type="submit" value="Enviar" class="boton_fin">
                </p>
            </fieldset>
        </form>

        <?php include('footer.php'); ?>
</body>
</html>