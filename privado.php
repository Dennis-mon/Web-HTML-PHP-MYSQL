<?php include('headprivado.php'); ?>

    <div id="contenedor_datos">
        <section id="datos_usuario">
            <div id="zona_foto">
                <h2><em>Datos Personales</em></h2>
                <?php
                    $usu = $_GET["Usuario"];
                    $sentencia = 'SELECT * FROM usuarios WHERE IdUsuario = ' . $usu . '';
                    if(!($resultado = @mysqli_query($link, $sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                        echo '</p>';
                        exit;
                    }
                    $Usuario = mysqli_fetch_assoc($resultado);
                    echo '<p>Nombre Usuario: '.$Usuario['NomUsuario'].'</p>';
                
                if(($Usuario['Foto']) == ""){

                }
                ?>
                <img height="300px" src="data:image/jpg;base64,<?php echo base64_encode($Usuario['Foto'])?>"/>
            </div>

            <div id="datos_persona">
                <?php
                    if($Usuario['Sexo'] == 0){
                        $sexo="Masculino";
                    }
                    else{
                        $sexo="Femenino";
                    }
                    echo '<p>Email: '.$Usuario['Email'].'</p>';
                    $new_date=date("d/m/Y", strtotime($Usuario['FNacimiento']));
                    echo '<p>Fecha Nacimiento: '.$new_date.'</p>';
                    echo '<p>Sexo: '.$sexo.'</p>';
                    echo '<p>Ciudad: '.$Usuario['Ciudad'].'</p>';
                    
                    $sentencia3 = 'SELECT * FROM paises WHERE IdPais = 1';
                    if(!($resultado3 = @mysqli_query($link, $sentencia3))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia3</b>: " . mysqli_error($link);
                        echo '</p>';
                        exit;
                    }
                    $pais = mysqli_fetch_assoc($resultado3);
                    echo '<p>País: '.$pais['NomPais'].'</p>';

                    $sentencia = 'SELECT * FROM usuarios WHERE NomUsuario = "' . $_SESSION['usuario'] . '"';
                    if(!($resultado = @mysqli_query($link, $sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                        echo '</p>';
                        exit;
                    }
                    $Usuario = mysqli_fetch_assoc($resultado);
                    echo '<li><a href="modificarDatos.php?Usuario= ' . $Usuario['IdUsuario'] . '">Modificar Datos</a></li>';
                    echo '<p><a></a></p>';
                ?>
            </div>
        </section>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>