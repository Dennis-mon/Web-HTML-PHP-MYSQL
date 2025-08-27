<?php include('headprivado.php'); ?>

    <div id="contenedor_datos">
        <section id="datos_usuario">
            <div id="zona_foto">
                <h2><em>Datos Personales</em></h2>
                <form action="privadomodificado.php" id="registro" method="post" class="formularios" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Regístrate</legend>
                        <p>
                            <label for="name">Nombre de usuario nuevo: </label>
                            <input type="text" name="name" id="name">
                        </p>
                        <p>
                            <label for="password">Contraseña nueva: </label>
                            <input type="password" name="password" id="password">
                        </p>
                        <p>
                            <label for="password2">Repetir Contraseña nueva: </label>
                            <input type="password" name="password2" id="password2">
                        </p>
                        <p>
                            <label for="email">Dirección email nueva: </label>
                            <input type="text" name="email" id="email">
                        </p>
                        <!--
                        <p>
                            <label for="sexo">Sexo: </label>
                            <select name="sexo" id="sexo">
                                <option default></option><option>Hombre</option><option>Mujer</option>
                            </select>
                        </p>
                        -->
                        <p>
                            <label for="birthday">Fecha de nacimiento: </label>
                            <input type="text" name="birthday" id="birthday" class="time">
                        </p>
                        <p>
                            <label for="country">País de residencia: </label>
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
                                        echo '<option>' . $fila['NomPais'] . '</option>';
                                    }
                                ?>
                            </select>
                        </p> 
                        <p>
                            <label for="town">Ciudad: </label>
                            <input type="text" name="town" id="town">
                        </p>
                        <p>
                            <label for="foto">Foto: </label>
                            <input type="file" accept="image/*" name="foto" id="foto">
                        </p>
                        <p><input type="reset" value="Limpiar formulario" class="boton_fin"><input type="submit" value="Modificar" class="boton_fin"></p>
                    </fieldset>
                </form>
            </div>
        </section>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>