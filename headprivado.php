<?php
    //Comprobamos La Sesión
    session_start(); 
    if(isset($_GET["estilo"])){
        $_SESSION['estilo'] = $_GET["estilo"];
    }
    if(isset($_SESSION['inicio']) && $_SESSION['inicio'] == 'S'){

    }else{
        $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            header("Location: http://$host$uri/$extra");
            exit;
    }

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PI - Pictures & Images</title>
    <link href="./estilo_publico.css" rel="stylesheet" type="text/css">

    <?php
    if(isset($_SESSION['estilo'])){
        $es = $_SESSION['estilo'];
        
        $sentencia = 'SELECT * FROM estilos WHERE IdEstilo = ' . $es . '';
        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }

        $estiloI = mysqli_fetch_assoc($resultado);
        echo '<link href="./' . $estiloI['Fichero'] . '" rel="stylesheet" type="text/css" title="Modo Oscuro">';
    }
    ?>

    <link href="./print.css" rel="stylesheet" type="text/css" media="print">
    <link href="./great.css" rel="stylesheet" type="text/css" media="screen and (min-width: 1281px)" />
    <link href="./medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 701px) and (max-width: 1280px)" />
    <link href="./mini.css" rel="stylesheet" type="text/css" media="screen and (max-width: 700px)" />
   
</head>
<body id="body"> 
    
    <header class="headpr">
        <div id="head_title">
            <h1>PI - Pictures & Images</h1>
            <p><em>Tu espacio de fotos favorito</em></p>
            <?php
                if(isset($_SESSION['usuario'])){  
                    $time = time();       
                    $hora = date("H", $time);
                    $us = $_SESSION['usuario'];

                    if($hora>5 && $hora<12){
                        echo "<p><em>Buenos días $us</em></p>";
                    }
                    if($hora>11 && $hora<16){
                        echo "<p><em>Hola $us</em></p>";
                    }
                    if($hora>15 && $hora<20){
                        echo "<p><em>Buenas tardes $us</em></p>";
                    }
                    if($hora>19 || $hora<6){
                        echo "<p><em>Buenas noches $us</em></p>";
                    } 
                }      
            ?>
        </div>
    </header>

    <nav id="barra_nav">
        <label for="checkmenu">&equiv;</label>
        <input type="checkbox" id="checkmenu">
        <ul>
            <li><a href="registrado.php">Inicio</a></li>
            <li><a href="registro.php">Registrarse</a></li>  
            <li><a href="buscar.php">Buscar</a></li>
            <?php
        //Solicitar Album
            $sentencia = 'SELECT * FROM usuarios WHERE NomUsuario = "' . $_SESSION['usuario'] . '"';
            if(!($resultado = @mysqli_query($link, $sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
            $Usuario = mysqli_fetch_assoc($resultado);
            echo '<li><a href="privado.php?Usuario= ' . $Usuario['IdUsuario'] . '">Mis Datos</a></li>';
            echo '<li><a href="solicitaralbum.php?Usuario= ' . $Usuario['IdUsuario'] . '">Solicitar Album</a></li>';
            ?>
            <li><a href="creaalbum.php">Crear nuevo álbum</a></li>
            <li><a href="anyadirfoto.php">Añadir foto a álbum</a></li>
            <?php
        //Visualizar Album
            $sentencia = 'SELECT * FROM usuarios WHERE NomUsuario = "' . $_SESSION['usuario'] . '"';
            if(!($resultado = @mysqli_query($link, $sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
            $Usuario = mysqli_fetch_assoc($resultado);
            echo '<li><a href="visualizarAlbum.php?Usuario= ' . $Usuario['IdUsuario'] . '">Visualizar mis álbumes</a></li>'
            ?>
            <li><a href="estilosdisponibles.php">Mis Estilos</a></li>
            <li><a href="cerrarsesion.php">Cerrar sesión</a></li>
            <?php
        //Dar baja
            $sentencia = 'SELECT * FROM usuarios WHERE NomUsuario = "' . $_SESSION['usuario'] . '"';
            if(!($resultado = @mysqli_query($link, $sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
            $Usuario = mysqli_fetch_assoc($resultado);
            echo '<li><a href="darmebaja.php?Usuario= ' . $Usuario['IdUsuario'] . '">Darme Baja</a></li>'
            ?>
        </ul>
    </nav>