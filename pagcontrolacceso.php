<?php
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
    
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    //$has  = hash('MD5', $_POST['pass']);

    //Busacamos el usuario en la base de datos
    $sentencia1 = 'SELECT * FROM usuarios WHERE NomUsuario = "' . $_POST['user'] . '" AND Clave = "' . $pass . '" ';
        if(!($resultado1 = @mysqli_query($link, $sentencia1))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
    $totalFilas = mysqli_num_rows($resultado1);

    if(isset($_GET["sesion"]) && $_GET["sesion"]=="S"){
        $time = time();
        $dia = date("d-m-y",$time);
        $hora = date("H:i", $time);
        $tiempo = array($dia,$hora);
        setcookie('tiempo', json_encode($tiempo), time() + 90 * 24 * 60 * 60);
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'registrado.php';
        header("Location: http://$host$uri/$extra");
        exit;
    }else{ 
        if($totalFilas == 1){
            $fila1 = mysqli_fetch_assoc($resultado1);

            //Inicializamos el estilo
            $estilo = $fila1['Estilo'];

            //Iniciamos Sesión
            session_start();
            $_SESSION['inicio'] = 'S';
            $_SESSION['usuario'] = $user;
            $_SESSION['estilo'] = $estilo;
            $_SESSION['id'] = $fila1['IdUsuario'];

            $time = time();
            $dia = date("d-m-y",$time);
            $hora = date("H:i", $time);
            $tiempo = array($dia,$hora);
            setcookie('tiempo', json_encode($tiempo), time() + 90 * 24 * 60 * 60);

            if(isset($_POST['rec'])){
                $array = array($user,$pass);
                setcookie('recordarme', json_encode($array), time() + 90 * 24 * 60 * 60);
            }

            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'registrado.php';
            header("Location: http://$host$uri/$extra");
            exit;
        }else{
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php?error=L';
            header("Location: http://$host$uri/$extra");
            exit;
        }
    } 

    