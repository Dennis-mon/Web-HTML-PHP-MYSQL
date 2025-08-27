<?php include('headprivado.php'); ?>

    <div id="contenedor_datos">
        <section id="datos_usuario">
            <div id="zona_foto">
                <h2><em>Datos Personales</em></h2>
                <?php
                        $usu = $_SESSION["id"];
                        $sentencia = 'SELECT * FROM usuarios WHERE IdUsuario = ' . $usu . '';
                        if(!($resultado = @mysqli_query($link, $sentencia))) {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                            echo '</p>';
                            exit;
                        }
                        $Usuario = mysqli_fetch_assoc($resultado);
                
                        if(($Usuario['Foto']) == ""){
                            
                        }

                        $usernameaux = $Usuario['NomUsuario'];
                        //$password = hash('MD5', $_POST["password"]);
                        $passwordaux = $Usuario['Clave'];
                        $emailaux = $Usuario['Email'];
                        $ciudadaux = $Usuario['Ciudad'];
                        $paisaux = 2;
                        //$fotoaux = $Usuario['Foto'];

                    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
                    
                    $username = $_POST["name"];
                    if($username==""){
                        $username = $usernameaux;
                    }
                      //$password = hash('MD5', $_POST["password"]);
                    $password = $_POST["password"];
                    if($password==""){
                        $password = $passwordaux;
                    }
                    $email = $_POST["email"];
                    if($email==""){
                        $email = $emailaux;
                    }
                    $ciudad = $_POST["town"];
                    if($ciudad==""){
                        $ciudad = $ciudadaux;
                    }
                    $pais = 2;
                    /*
                    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
                    if($foto==""){
                        $foto = $fotoaux;
                    }
                    <img height="300px" src="data:image/jpg;base64,<?php echo base64_encode($Usuario['Foto'])?>"/>
                    */
                    $iduser = $_SESSION['usuario'];

                    $sql = "UPDATE usuarios SET NomUsuario='$username', Clave='$password', Email='$email', Ciudad='$ciudad', Pais='$pais', Foto='$foto' WHERE NomUsuario = '$iduser'";
                      //$sql = "UPDATE usuarios SET NomUsuario='$usernameaux', Clave='$passwordaux', Email='$emailaux', Ciudad='$ciudadaux', Pais='$paisaux', Foto='$foto' WHERE NomUsuario = '$iduser'";
                    if(mysqli_query($link, $sql)){
                        echo "El usuario se ha actualizado correctamente en la base de datos";
                    }
                    else{
                        echo "Error: ". $query . "<br>" . mysqli_error($conn);
                    }
                      
                    echo '<p>Nombre Usuario: '.$_SESSION['usuario'].'</p>';
                    //////////////////////////////////////////////////////////////////////////////
                ?>
                <img src="data:image/jpg;base64,<?php echo base64_encode($Usuario['Foto'])?>"/>
            </div>

            <div id="datos_persona">
                <?php
                    //$Usuario['FNacimiento']
                    //$fechaNac = 'SELECT DATE_FORMAT(FNacimiento,'%d-%m-%Y') FROM usuarios WHERE IdUsuario = 2';
                    //echo '<p>Contraseña: '.$Usuario['Clave'].'</p>';
                    //echo '<p>Repetir Contraseña: '.$Usuario['Clave'].'</p>';
                    //echo '<p>Contraseña: ********</p>';
                    //echo '<p>Repetir Contraseña: ********</p>';
                    echo '<p>Email: '.$Usuario['Email'].'</p>';
                    $new_date=date("d/m/Y", strtotime($Usuario['FNacimiento']));
                    echo '<p>Fecha Nacimiento: '.$new_date.'</p>';
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