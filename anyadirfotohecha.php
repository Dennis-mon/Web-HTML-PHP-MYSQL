<?php
    if(isset($_POST['titulo']) ? $_POST['titulo'] : ''){
        $titulo = $_POST['titulo'];
    } else {
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'anyadirfoto.php?error=T';
            header("Location: http://$host$uri/$extra");
            exit;
    }

    $alt = $_POST["textoalt"];
    if(strlen($alt) < 10){
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'anyadirfoto.php?error=A';
        header("Location: http://$host$uri/$extra");
        exit;
    }

    if(empiezaalternativo($alt)){
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'anyadirfoto.php?error=AM';
        header("Location: http://$host$uri/$extra");
        exit;
    }

    function empiezaalternativo($cadena){
        $patron = '/^texto|imagen|imagende|foto|fotode/i';
        return preg_match($patron, $cadena);
    }
?> 

<?php include('headprivado.php'); 
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["texta"];
    if($_POST["frec"] == NULL){
        $fecha = date('Y-m-d');
    } else {
        $fe = $_POST["frec"];
        $fecha = date('Y-m-d', strtotime($fe));
    }
    $pais = $_POST['country'];
    $album = $_POST["album"];
    $textalt = $_POST["textoalt"];
    $FRegistro = date( 'Y-m-d H:i:s' );
    $direccion = "";

    if($_FILES["foto"]["error"] > 0){
        $direccion = "\Fotos/foto_usuario.png";
    } else{
        move_uploaded_file($_FILES["foto"]["tmp_name"], 'C:\xampp\htdocs\Daw\Fotos/' . $_FILES["foto"]["name"] );
        $direccion = "\Fotos/" . $_FILES["foto"]["name"] ;
    }

    $sql = "INSERT INTO fotos (Titulo, Descripcion, Fecha, Pais, Album, Fichero, Alternativo, FRegistro) 
            VALUES ('$titulo', '$descripcion', '$fecha', '$pais', '$album', '$direccion', '$textalt', '$FRegistro')";
    if(!(mysqli_query($link, $sql))){
        echo "Error: ". $query . "<br>" . mysqli_error($conn);
    }

    if($_FILES["foto"]["error"] > 0){
    } else{

        $sentencia = 'SELECT * FROM fotos ORDER BY FRegistro DESC';
        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
        $nueva = mysqli_fetch_assoc($resultado);

        $nuevadireccion = './Fotos/' . $_FILES["foto"]["name"] . '_' . $nueva["IdFoto"] . '.png';
        rename('./Fotos/' . $_FILES["foto"]["name"], $nuevadireccion);

        $sql2 = 'UPDATE fotos SET Fichero = "' . $nuevadireccion . '" WHERE IdFoto = ' . $nueva['IdFoto'] . ' ';
        if(!(mysqli_query($link, $sql2))){
            echo "Error: ". $query . "<br>" . mysqli_error($conn);
        }
    }
    
    ?>
        <div id="datos_album2">
            <h3>Solicitud de añadir foto a álbum</h3>
        </div>
        <form id="album" method="post" class="formularios">
            <fieldset>
                <legend>Foto añadida</legend>
                <p>
                    <label>Título de la foto</label>
                    <label><?php echo $titulo ?></label>
                </p>
                <p>
                    <label>Fecha de la foto: </label>
                    <label><?php echo $fecha ?></label>
                </p>
                <p>
                    <label>Descripción de la foto:</label>
                    <label><?php echo $descripcion ?></label>
                </p>
                <p>
                    <label>Texto alternativo de la foto: </label>
                    <label><?php echo $textalt ?></label>
                </p>
                <p>
                    <label>País: </label>
                    <?php
                        $sentencia = 'SELECT * FROM paises WHERE IdPais = ' . $pais . ' ';
                        if(!($resultado = @mysqli_query($link, $sentencia))) {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                            echo '</p>';
                            exit;
                        }
                        $fila = mysqli_fetch_assoc($resultado);

                        echo '<label>' . $fila['NomPais'] . '</label>';
                    ?>
                </p> 
                <p>
                    <label>Álbum al que añadir</label>
                    <label><?php echo "Álbum: $album "?></label>
                </p>
            </fieldset>
        </form>
    <?php include('footer.php'); ?>
</body>
</html>