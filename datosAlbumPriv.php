<?php include('headprivado.php'); ?>

    <section id="datosAlbumPublico">
        <?php
        $al = $_GET["Album"];
        
        // Ejecuta una sentencia para buscar el album
        $sentencia = 'SELECT * FROM albumes WHERE IdAlbum = ' . $al . '';
        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
        $album = mysqli_fetch_assoc($resultado);


        echo '<h2> ' . $album['Titulo'] . ' </h2>';
        echo '<h3> ' . $album['Descripcion'] . ' </h3>';
        echo '<h3><a href="anyadirfoto.php">Añadir foto a Álbum</a></h3>';

        // Ejecuta una sentencia para nombrar los paises
        $sentencia2 = 'SELECT * FROM fotos WHERE Album = ' . $al . '';
        if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }
        $totalFotos = mysqli_num_rows($resultado2);

        echo '<section>';
        echo '<p> Numero de fotos: ' . $totalFotos . ' </p>';

        echo '<p> Paises en los que se tomaron las fotos: ';
        while($fotosPara = mysqli_fetch_assoc($resultado2)){
            $sentencia4 = 'SELECT * FROM paises WHERE IdPais = ' . $fotosPara['Pais'] . '';
            if(!($resultado4 = @mysqli_query($link, $sentencia4))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia4</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
            $Paises = mysqli_fetch_assoc($resultado4);

            echo ' ' . $Paises['NomPais'] . ', ';
        }
        echo '</p>';

        //Esta sentencia es para buscar las fechas limite
        $sentencia6 = 'SELECT * FROM fotos WHERE Album = ' . $al . ' ORDER BY Fecha DESC';
            if(!($resultado6 = @mysqli_query($link, $sentencia6))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia6</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }

            $sentencia7 = 'SELECT * FROM fotos WHERE Album = ' . $al . ' ORDER BY Fecha ASC';
            if(!($resultado7 = @mysqli_query($link, $sentencia7))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia7</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
        
        
        $Fmax = mysqli_fetch_assoc($resultado6);
        $Fminima = mysqli_fetch_assoc($resultado7);

        echo '<p> Fecha mínima: ' . $Fminima['Fecha'] . ' y Fecha máxima: ' . $Fmax['Fecha'] . ' </p>';

        //Este sentencia es para buscar las fotos
        $sentencia5 = 'SELECT * FROM fotos WHERE Album = ' . $al . '';
        if(!($resultado5 = @mysqli_query($link, $sentencia5))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia5</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }

        while($fotos = mysqli_fetch_assoc($resultado5)){
            echo '<label>';
                echo '<a href="detalle.php?fondo=' . $fotos['IdFoto'] . '"><img src="./' . $fotos['Fichero'] . '" alt="' . $fotos['Alternativo'] . '" class="fotos_pagina"></a><br>';
                echo '<label>Título: ' . $fotos['Titulo'] . '</label><br/>';
                echo '<label>Fecha: ' . $fotos['Fecha'] . '</label><br/>';    

                //Este sentencia es para buscar el nombre del pais
                $sentencia3 = 'SELECT * FROM paises WHERE IdPais = ' . $fotos['Pais'] . '';
                if(!($resultado3 = @mysqli_query($link, $sentencia3))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia3</b>: " . mysqli_error($link);
                    echo '</p>';
                    exit;
                }
                $Pais = mysqli_fetch_assoc($resultado3);

                echo '<label>País: ' . $Pais['NomPais'] . '</label>'; 
            echo '</label>';
        }

        echo '</section>';

        ?>
    </section>

    <?php include('footer.php'); ?>
</body>
</html> 