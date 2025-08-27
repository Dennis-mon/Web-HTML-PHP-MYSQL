<?php include('headpublic.php'); ?>

    <section class="fotos_escogida">
        <h2>Foto escogida</h2>
        <?php
            /*Para la foto escogida*/
            if(($fichero = @file("fotoElegida.txt")) == false){
                echo '<p>No se pudo leer o arbir el archivo fotoEegida.txt</p>';
            } else {
                foreach($fichero as $numLinea => $linea){
                    if($numLinea % 2 == 0){
                    } else {
                        switch($numLinea){
                            case 1:
                                if(num($linea[0])){
                                    $hacer = 1;
                                } else {
                                    $hacer = 0;
                                    echo '<p>No hay foto escogida</p>';
                                }
                                $imagenes = explode("::", $linea);
                                $mostrar = rand(0, (count($imagenes)-1));
                                break;
                            case 3:
                                $autor = explode("::", $linea);
                                break;
                            case 5:
                                $comentario = explode("::", $linea);
                                break;
                        }
                    }
                }
            }

            function num($texto){
                $patron = '/^[0-9]/';
                return preg_match($patron, $texto);
            }

            if($hacer == 1){
                $inicio = 'SELECT * FROM fotos WHERE IdFoto = ' . $imagenes[$mostrar] . '';
                if(!($res = @mysqli_query($link, $inicio))) {
                    echo "<p>Error al ejecutar la sentencia <b>$inicio</b>: " . mysqli_error($link);
                    echo '</p>';
                    exit;
                }
                $lafoto = mysqli_fetch_assoc($res);
                $fotos = mysqli_num_rows($res);

                if($fotos == 1){
                    /*Lo pegamos en pantalla*/ 
                    echo '<label>';
                    echo '<label>Título: ' . $lafoto['Titulo'] . '</label><br/>';
                    echo '<a href="aviso.php"><img src="./' . $lafoto['Fichero'] . '" alt="' . $lafoto['Alternativo'] . '" class="fotos_pagina"></a><br/>';
                    echo '<label>Crítico: ' . $autor[$mostrar] . '</label><br/>';
                    echo '<label>Reseña: ' . $comentario[$mostrar] . '</label><br/>';
                    echo '<label>Descripción: ' . $lafoto['Descripcion'] . '</label><br/>';
                    $new=date("d/m/Y", strtotime($lafoto['Fecha']));
                    echo '<label>Fecha: ' . $new . '</label><br/>';
                    $pais2 = 'SELECT * FROM paises WHERE IdPais = ' . $lafoto['Pais'] . '';
                    $resultadoP2 = @mysqli_query($link, $pais2);
                    $filaP2 = mysqli_fetch_assoc($resultadoP2);    
                    echo '<label>País: ' . $filaP2['NomPais'] . '</label><br/>'; 
                    echo '</label>';
                } else {
                    echo '<p>No hay resultado en la base de datos</p>';
                }
            }

            $archivo = file_get_contents("./consejos.JSON");
            $consejos = json_decode($archivo, true);
            $mostrarconsejo = rand(0, (count($consejos) - 1));
            echo '<h2>Consejo Fotográfico</h2>';
            echo '<label>';
            echo '<label>Categoría: ' . $consejos[$mostrarconsejo]["Categoría"] . '</label><br/>';
            echo '<label>Material: ' . $consejos[$mostrarconsejo]["Dificultad"] . '</label><br/>';
            echo '<label>Consejo: ' . $consejos[$mostrarconsejo]["Consejo"] . '</label>';
            echo '</label>';
        ?>
    </section>

    <section id="section_fotos" class="fotos_principal">
    <?php 
        if(isset($_GET["error"]) && $_GET["error"]=="L"){
            $err = "El usuario o contraseña introducido no es correcto";
            echo "<h1>$err</h1>";
        }

        // Ejecuta una sentencia SQL
        $sentencia = 'SELECT * FROM fotos ORDER BY FRegistro DESC';
        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
            echo '</p>';
            exit;
        }

    ?>
        <h2>Últimas fotos</h2> 

        <?php
            // Recorre el resultado y mostramos las 5 últimas fotos
            $contador = 0;
            while($fila = mysqli_fetch_assoc($resultado)) {
                if($contador < 5){
                    echo '<label>';
                        echo '<a href="aviso.php"><img src="./' . $fila['Fichero'] . '" alt="' . $fila['Alternativo'] . '" class="fotos_pagina"></a><br>';
                        echo '<label>Título: ' . $fila['Titulo'] . '</label><br/>';
                        $new_date=date("d/m/Y", strtotime($fila['Fecha']));
                        echo '<label>Fecha: ' . $new_date . '</label><br/>';
                        $pais = 'SELECT * FROM paises WHERE IdPais = ' . $fila['Pais'] . '';
                        $resultadoP = @mysqli_query($link, $pais);
                        $filaP = mysqli_fetch_assoc($resultadoP);
                        
                        echo '<label>País: ' . $filaP['NomPais'] . '</label>'; 
                    echo '</label>';
                    $contador = $contador + 1;
                }else{
                    if($contador == 5){
                        break;
                    }
                }
            }
        ?>

    </section>

    <?php 
        include('footer.php');

        // Libera la memoria ocupada por el resultado
        mysqli_free_result($resultado);
        // Cierra la conexión
        mysqli_close($link);
    ?>

</body>
</html> 