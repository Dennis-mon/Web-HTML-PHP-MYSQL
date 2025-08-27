<?php include('headprivado.php'); ?>

<?php 
    $IColor = NULL;

    $pag = isset($_POST['paginas']) ? $_POST['paginas'] : '';
    $fotos = $pag * 3;
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    if($color == "on"){
        $IColor = 1;
    }else{
        $color = "off";
        $IColor = 0;
    }
    $dpi = isset($_POST['dpi']) ? $_POST['dpi'] : '';
    $total = 0;

    if($pag < 5){
        $total = $pag * 0.10;
    }else{
        if($pag >=5 && $pag < 11){
            $total = 0.40 + (($pag - 4) * 0.08);
        }else{
            $total = 0.96 + (($pag - 10) * 0.07);
        }
    }
    if($color == "on"){
        $total = $total + ($fotos * 0.05);
    }
    if($dpi > 300){
        $total = $total + ($fotos * 0.02);
    }

    //Insertar la solicitud
    $album = $_POST["album"];
    $nombre = $_POST["name"];
    $nom = explode(" ", $nombre);
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["texta"];
    $email = $_POST["email"];
    $direccion = $_POST["calle"];
    $colorp = $_POST["colorp"];
    $copias = $_POST["paginas"];
    $dpi = $_POST["dpi"];
    if($_POST["frec"] == NULL){
        $fecha = date('Y-m-d');
    } else {
        $fe = $_POST["frec"];
        $fecha = date('Y-m-d', strtotime($fe));
    }
    $FRegistro = date( 'Y-m-d H:i:s' );
    
    $sql = "INSERT INTO solicitudes (Album, Nombre, Apellidos, Titulo, Descripcion, Email, Direccion, Color, Copias, Resolucion, Fecha, IColor, FRegistro, Coste) 
            VALUES ('$album', '$nom[0]', '$nom[1]', '$titulo', '$descripcion', '$email' , '$direccion', '$colorp', '$copias', '$dpi', '$fecha', $IColor, '$FRegistro', '$total')";
            if(!($resultado = @mysqli_query($link, $sql))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
?>

    <div id="datos_album">
        <h3>Solicitud de impresión de álbum registrada</h3>
        <p>Usted ha enviado la solicitud de un álbum, abajo aparecerán los detalles que seleccionó.</p>
        <p>El álbum que ha solicitado consta de <?php echo $pag?> páginas y <?php echo $fotos?> número de fotos</p>
        <p>El precio de este álbum será <strong><?php echo $total?>€</strong></p>
    </div>
    
    <form id="resumenalbum" class="formulariosres">
        <fieldset>
            <p>
                <label>Nombre</label>
                <p><?php echo $_POST["name"];?></p>
            </p>
            <p>
                <label>Título del álbum</label>
                <p><?php echo $_POST["titulo"];?></p>
            </p>
            <p>
                <label>Texto Adicional</label>
                <p><?php echo $_POST["texta"];?></p>
            </p>
            <p>
                <label>Email</label>
                <p><?php echo $_POST["email"];?></p>
            </p>
            <p>
                <div>
                    <label class="divlabel">Dirección</label>
                    <p><?php echo $_POST["calle"];?></p>
                    <p><?php echo $_POST["numero"];?></p>
                    <p><?php echo $_POST["cp"];?></p>
                    <p><?php echo $_POST["dir"];?></p>
                    <p><?php echo $_POST["prov"];?></p>
                </div>
            </p>
            <p>
                <label>Teléfono</label>
                <p><?php echo $_POST["telefono"];?></p>
            </p>
            <p>
                <label>Color de la portada</label>
                <p><?php echo $_POST["colorp"];?></p>
            </p>
            <p>
                <label>Número de copias</label>
                <p><?php echo $_POST["paginas"];?></p>
            </p>
            <p>
                <label>Resolución DPI</label>
                <p><?php echo $_POST["dpi"];?></p>
            </p>
            <p>
                <label>Fecha aproximada de recepción</label>
                <p><?php echo $_POST["frec"];?></p>
            </p>
            <p>
                <label>Álbum</label>
                <p><?php echo $_POST["album"];?></p>
            </p>
            <p>
                <label>¿Impresión a color?</label>
                <p><?php echo $color;?></p>
            </p>
        </fieldset>
    </form>

    <?php include('footer.php'); ?>
</body>
</html>