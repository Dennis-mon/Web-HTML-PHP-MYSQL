<?php include('headpublic.php'); ?>

    <form action="resulatado.php" id="form_busqueda" method="post" class="formularios">
        <fieldset>
            <legend>Criterios de búsqueda</legend>
            <p>
                <label for="titulo">
                    Título:
                </label>
                <input type="text" name="titulo" id="titulo">
            </p>
            <p>
                <label for="fecha1">
                    Fecha entre:
                </label>
                <input type="date" name="fecha1" id="fecha1" class="time">
            </p>
            <p>
                <label for="fecha2">y: </label>
                <input type="date" name="fecha2" id="fecha2" class="time">
            </p>
            <p>
                <label for="lugartomada">País: </label>
                <select name="lugartomada" id="lugartomada">
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
            <input type="reset" value="Limpiar formulario" class="boton_fin">
            <input type="submit" value="Realizar búsqueda" class="boton_fin">
        </fieldset>
    </form>

    <?php include('footer.php'); ?>
</body>
</html> 