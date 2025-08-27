<?php 

session_start();
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

//Eliminamos de la base de datos

    if(isset($_POST['pass']) ? $_POST['pass'] : '' ){
        echo 'si';
    } else {
        $i = $_SESSION["id"];
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'darmebaja.php?Usuario=' . $i . '';
        header("Location: http://$host$uri/$extra");
        exit;
    }

    $password = hash('MD5', $_POST["pass"]);
    $iduser = $_SESSION['usuario'];

    $sentencia = 'SELECT * FROM usuarios WHERE NomUsuario = "' . $iduser . '"';
        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
    $Usuario = mysqli_fetch_assoc($resultado);

    if($password == $Usuario['Clave']){

        $sentencia2 = 'SELECT * FROM fotos f, albumes a WHERE f.Album = a.IdAlbum AND a.Usuario = ' . $Usuario['IdUsuario'] . '';
        if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
        while($fotos = mysqli_fetch_assoc($resultado2)) {
            unlink('./' . $fotos['Fichero']);
        }

        $sql = ' DELETE FROM usuarios WHERE NomUsuario = "' . $iduser . '" AND Clave = "' . $password . '" ';
        if(!($resultado = mysqli_query($link, $sql))){
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
    } else {
        $i = $_SESSION["id"];
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'darmebaja.php?Usuario=' . $i . '';
        header("Location: http://$host$uri/$extra");
        exit;
    }

    mysqli_close($link);



    //Eliminamos sesiones y cookies
    setcookie('recordarme');
    setcookie('recordarme', '', time() - 42000, '/');

    setcookie('tiempo');
    setcookie('tiempo', '', time() - 42000, '/');

    $_SESSION = array();
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();

    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");
    exit;
?>