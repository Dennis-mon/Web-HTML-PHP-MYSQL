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

     session_start();
     if(isset($_COOKIE['recordarme']) || isset($_SESSION['usuario'])){

         if(isset($_SESSION['usuario'])){
             $data = array($_SESSION['usuario'],"");
         }else{
             $data = json_decode($_COOKIE['recordarme'], true);
             $_SESSION['inicio'] = 'S';
             $_SESSION['usuario'] = $data[0];

             $sentencia1 = 'SELECT * FROM usuarios WHERE NomUsuario = "' . $_SESSION['usuario'] . '" ';
             if(!($resultado1 = @mysqli_query($link, $sentencia1))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                    echo '</p>';
                    exit;
                }
             $u = mysqli_fetch_assoc($resultado1);
             
             $_SESSION['estilo'] = $u['Estilo'];
         }

         $data2 = json_decode($_COOKIE['tiempo'], true);
         $es = $_SESSION['estilo'];
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

<body>
    <header class="headpu">
        <div id="head_title">
            <h1>PI - Pictures & Images</h1>
            <p><em>Tu espacio de fotos favorito</em></p>
        </div>

            <?php
                if(isset($_COOKIE['recordarme']) || isset($_SESSION['usuario'])){                     
                    ?>
                    <form action="pagcontrolacceso.php?sesion=S" id="login" method="post">
                    <?php
                    echo "<h2>Hola $data[0],</h2>";
                    echo "<h2>su última visita fue el</h2>";
                    echo "<h2>$data2[0] a las $data2[1]</h2>";
                    ?>
                    <input type="submit" value="Acceder" class="boton_fin">
                    </form>
                    <?php
                }else{ 
                ?> 
                    <form action="pagcontrolacceso.php" id="login" method="post">
                    <h2>Formulario para Inicio de sesión</h2>
                    <p><label for="user">&#128100 Usuario: </label>
                    <input type="text" id="user" name="user"></p>
        
                    <p><label for="pass">&#128273 Contraseña: <label>
                    <input type="password" id="pass" name="pass"></p>
        
                    <p><input type="checkbox" name="rec">Recordarme</p>
                    
        
                    <input type="reset" value="Limpiar formulario" class="boton_fin">
                    <input type="submit" value="Iniciar Sesión" class="boton_fin">
                    </form>
                <?php
                }
            ?>

    </header>
    
    <nav id="barra_nav">
        <label for="checkmenu">&equiv;</label>
        <input type="checkbox" id="checkmenu">
        <ul>
            <li><a href="index.php">Inicio</a></li>  
            <li><a href="registro.php">Registrarse</a></li>
            <li><a href="buscar.php">Buscar</a></li>
        </ul>
    </nav>