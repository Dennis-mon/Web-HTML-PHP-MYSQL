<?php 
/*
    if(empty($_POST["name"]) || empty($_POST["password"]) || empty($_POST["password2"])){
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'registro.php?error=1';
        header("Location: http://$host$uri/$extra");
        exit;
    }
    else{
        if($_POST["password"] == $_POST["password2"]){
            $bien = "bien";
        }
        else{
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'registro.php?error=2';
            header("Location: http://$host$uri/$extra");
            exit;
        }
    }
    */
    $username = $_POST["name"];
    //$password = hash('MD5', $_POST["password"]);
    $password = $_POST["password"];
    $email = $_POST["email"];
    $sexoBD = 0;
    $fechanac = $_POST["birthday"];
    $fecha = date('Y-m-d', strtotime($fechanac));
    $ciudad = $_POST["town"];
    $pais = 2;
    $estilo = 1;
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

    $servidor = parse_ini_file("servidor.ini");

    $link = @mysqli_connect(
        $servidor['Server'], // El servidor
        $servidor['User'], // El usuario
        $servidor['Password'], // La contraseña
        $servidor['Database']); // La base de datos
    if(!$link) {
        echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
        echo '</p>';
        exit;
    }

    $sql = "INSERT INTO usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, Estilo) 
            VALUES ('$username', '$password', '$email', '$sexoBD', '$fecha', '$ciudad', '$pais', '$foto', '$estilo')";
    if(mysqli_query($link, $sql)){
        echo "El usuario se ha añadido correctamente a la base de datos";
    }
    else{
        echo "Error: ". $query . "<br>" . mysqli_error($conn);
    }
    mysqli_close($link);
    //------------------------------------USUARIO----------------------------------------------------------
        $username = $_POST["name"];

        //COMPROBAR SI LA CADENA DE TEXTO DEL USUARIO TIENE ENTRE 3 Y 15 CARACTERES
        function comprobarLongitud($texto){
                $longitud = strlen($texto);
                return $longitud >=3 && $longitud <=15;
        }
        //COMPROBAR SI UN TEXTO SOLO TIENE LETRAS Y NUMEROS
        function comprobarLetrasNum($texto){
                $patron = '/^[A-Za-z0-9]+$/';
                return preg_match($patron, $texto);
        }

        if(comprobarLongitud($username)){
            //Hacerlo de nuevo
            if(comprobarLetrasNum($username)){

            }
            else{
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'registro.php?error=18';
                    header("Location: http://$host$uri/$extra");
                    echo "Letras fueras del rango";
                    exit;
            }
        }
        else{
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'registro.php?error=3';
                header("Location: http://$host$uri/$extra");
                echo "Longitud fuera del rango";
                exit;
        }
    //------------------------------------CONTRASEÑA----------------------------------------------------------
        $password = $_POST["password"];

        //COMPROBAR SI UN TEXTO SOLO TIENE LETRAS, NUMEROS Y GUIONES
        function comprobarLetrasNumGuion($texto){
            $patron = '/^[A-Za-z0-9_-]+$/';
            return preg_match($patron, $texto);
        }
        //COMPROBAR SI UN TEXTO TIENE AL MENOS UNA MINUS, UNA MAYUS Y UN NUM
        function comprobarMayusMinusNum($texto){
            $patron = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).+$/';
            return preg_match($patron, $texto);
        }
        function comprobarLongitudPass($texto){
            $longitud = strlen($texto);
            return $longitud >=6 && $longitud <=15;
        }

        if(comprobarLongitudPass($password)){
            //Hacerlo de nuevo
            if(comprobarLetrasNumGuion($password)==strlen($password)){
                if(comprobarMayusMinusNum($password)>=3){
                }
                else{
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'registro.php?error=4';
                    header("Location: http://$host$uri/$extra");
                    echo "No hay un minimo de un numero, minúscula o mayúscula";
                    exit;
                }

            }
            else{
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'registro.php?error=5';
                    header("Location: http://$host$uri/$extra");
                    echo "Letras fueras del rango";
                    exit;
            }
        }
        else{
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'registro.php?error=6';
                header("Location: http://$host$uri/$extra");
                echo "Longitud fuera del rango";
                exit;
        }

        $password2 = $_POST["password2"];

        if($password==$password2){
        }
        else{
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'registro.php?error=7';
            header("Location: http://$host$uri/$extra");
            echo "Las contraseñas no eran iguales";
            exit;
        }

    //------------------------------------EMAIL----------------------------------------------------------
        $email = $_POST["email"];
        if(strlen($email)>254){
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'registro.php?error=8';
            header("Location: http://$host$uri/$extra");
            echo "El email se pasa de 254 caracteres";
            exit;
        }
        $partes = explode("@", $email);
        $partelocal = $partes[0];
        $dominio = $partes[1];
        $partedom = explode(".", $dominio);
            $subdom1 = $partedom[0];
            $subdom2 = $partedom[1];
            if(strlen($subdom1)>63){
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'registro.php?error=9';
                header("Location: http://$host$uri/$extra");
                echo "Subdominio se pasa de 63 caracteres";
                exit;
            }
            if(strlen($subdom2)>63){
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'registro.php?error=10';
                header("Location: http://$host$uri/$extra");
                echo "Subdominio se pasa de 63 caracteres";
                exit;
            }
            /* Con $chars = str_split($dominio);
                    foreach($chars as $char){
                        comprobamos letra por letra
                    }
        */

        function comprobarCaracteresEmail($texto){
            $patron = '/^[A-Za-z0-9_!#$%&`*+=?^{}|~-.]+$/';
            return preg_match($patron, $texto);
        }
        function comprobarCaracteresSubdominio($texto){
            $patron = '/^[A-Za-z0-9-]+$/';
            return preg_match($patron, $texto);
        }

        if(strlen($partelocal)>=1 && strlen($partelocal)<=64){
            if(strlen($dominio)>=1 && strlen($partelocal)<=255){
                if(comprobarCaracteresEmail($partelocal)==strlen($partelocal)){
                    if(comprobarCaracteresSubdominio($subdom1)==strlen($subdom1)){

                    }
                    else{
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        $extra = 'registro.php?error=11';
                        header("Location: http://$host$uri/$extra");
                        echo "El subdominio 1 tiene carácteres no permitidos";
                        exit;
                    }
                    if(comprobarCaracteresSubdominio($subdom2)==strlen($subdom2)){

                    }
                    else{
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        $extra = 'registro.php?error=12';
                        header("Location: http://$host$uri/$extra");
                        echo "El subdominio 2 tiene carácteres no permitidos";
                        exit;
                    }
                }
                else{
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'registro.php?error=13';
                    header("Location: http://$host$uri/$extra");
                    echo "Partelocal con valores no permitidos";
                    exit;
                }
            }
            else{
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'registro.php?error=14';
                header("Location: http://$host$uri/$extra");
                echo "Dominio >255 o <1";
                exit;
            }
        }
        else{
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'registro.php?error=15';
            header("Location: http://$host$uri/$extra");
            echo "Parte local >64 o <1";
            exit;
        }

    //------------------------------------SEXO----------------------------------------------------------
        $sexo = $_POST["sexo"];

        if($sexo == "Hombre" || $sexo == "Mujer"){
            if($sexo=="Hombre"){
                $sexoBD=0;
            }
            else{
                $sexoBD=1;
            }
        }
        else{
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'registro.php?error=16';
            header("Location: http://$host$uri/$extra");
            echo "Elige un sexo válido";
            exit;
        }
    //------------------------------------FECHANAC----------------------------------------------------------
        $fechanac = $_POST["birthday"];
        //GENERA FECHA HOY
        function generarFecha(){
            return date('d/m/Y');
        }
        //COMPARA FECHAS Y SACA LA DIFERENCIA
        function comprobarFecha($fecha1, $fecha){
            $diferencia = (new DateTime($fecha1))->diff(new DateTime($fecha));
            
            return DateTime::createFromFormat('d/m/Y', $fecha) !== false && $diferencia->y >= 18;
            //Devuelve cierto si la fecha es válida y hay una diferencia de al menos 18 años respecto a hoy
        }
        //COMPARAR LA FECHA DE HOY CON LA QUE HA INTRODUCIDO EL USUARIO
        $fechahoy = generarFecha();
        if(comprobarFecha($fechahoy, $fechanac)){
            echo "La fecha es válida y la persona tiene al menos 18 años";
        }
        else{
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'registro.php?error=17';
            header("Location: http://$host$uri/$extra");
            echo "Fecha no válida o menor de 18 años";
            exit;
        }


        $sql = "INSERT INTO usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento) 
                VALUES ('$username', '$password', '$email', '$sexoBD', '$fechanac')";
        if(mysqli_query($link, $sql)){
            echo "El usuario se ha añadido correctamente a la base de datos";
        }
        else{
            echo "Error: ". $query . "<br>" . mysqli_error($conn);
        }
        mysqli_close($link);
?>


<?php include('headpublic.php'); ?>

    <form id="registro" class="formularios">
        <fieldset>
            <legend>Regístrate</legend>
            <p>
                
                <label for="name">Nombre de usuario: </label>
                <p><?php echo $username;?></p>
            </p>
            <p>
                <label for="email">Dirección email: </label>
                <p><?php echo $email;?></p>
            </p>
            <p>
                <label for="sexo">Sexo: </label>
                <p><?php echo $sexo;?></p>
            </p>
            <p>
                <label for="birthday">Fecha de nacimiento: </label>
                <p><?php echo $fechanac;?></p>
            </p>
            <p>
                <label for="country">País de residencia: </label>
                <p><?php echo $_POST["country"];?></p>
            </p>
            <p>
                <label for="town">Ciudad: </label>
                <p><?php echo $_POST["town"];?></p>
            </p>
            <p><input type="reset" value="Limpiar formulario" class="boton_fin"><input type="submit" value="Registrarse" class="boton_fin"></p>
        </fieldset>
    </form>

    <?php include('footer.php'); ?>
</body>
</html>