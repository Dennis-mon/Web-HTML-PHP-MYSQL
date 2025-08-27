<?php
include('headprivado.php'); 
?> 

    <?php
        if(isset($_GET["estilo"])){
            $sentencia = 'SELECT Nombre FROM estilos WHERE IdEstilo = ' . $_GET["estilo"] . '';
            if(!($resultado = @mysqli_query($link, $sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
            $fila = mysqli_fetch_assoc($resultado);

            $sentencia1 = 'UPDATE usuarios SET Estilo = ' . $_GET["estilo"] . ' WHERE NomUsuario = "' . $_SESSION['usuario'] . '"';
            if(!($resultado1 = @mysqli_query($link, $sentencia1))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
        }
    ?>

    <section id="fotos" class="fotos_principal">
        <h2>Estilo cambiado correctamente</h2>
        <?php
            echo '<h2>Su nuevo estilo es: ' . $fila['Nombre'] . '</h2> ';
        ?>
    </section>

    <?php 
        include('footer.php');

        // Libera la memoria ocupada por el resultado
        mysqli_free_result($resultado);
        // Cierra la conexión
        mysqli_close($link);
    ?>

</body>
</html> 