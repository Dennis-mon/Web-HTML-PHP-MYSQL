<?php
    if(isset($_POST['titulo']) ? $_POST['titulo'] : ''){
        $titulo = $_POST['titulo'];
    } else {
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'creaalbum.php?error=T';
            header("Location: http://$host$uri/$extra");
            exit;
    }

    if(isset($_POST['descripcion']) ? $_POST['descripcion'] : ''){
        $descripcion = $_POST['descripcion'];
    } else {
        $descripcion = 'Sin Descripción';
    }
?>
<?php include('headprivado.php'); ?>

    <?php
        $sentencia = 'SELECT IdUsuario FROM usuarios WHERE NomUsuario = "' . $_SESSION['usuario'] . '" ';
        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
        $fila = mysqli_fetch_assoc($resultado);
        $id = $fila['IdUsuario'];

        $sentencia1 = "INSERT INTO albumes (Titulo, Descripcion, Usuario)
                      Values('$titulo','$descripcion',$id)";
        if(!($resultado1 = @mysqli_query($link, $sentencia1))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
    ?>

    <fieldset class="formularios">
        <p>
            <label for="titulo">Título del álbum: <?php echo $titulo?></label>
        </p>
        <p>
            <label for="descripcion">Descripción del Album: <?php echo $descripcion?></label>
        </p>
        <p>
            <a href="anyadirfoto.php?album=S">Añade una foto a tu nuevo álbum desde aquí</a>
        </p>
    </fieldset>
    <?php include('footer.php'); ?>
</body>
</html>