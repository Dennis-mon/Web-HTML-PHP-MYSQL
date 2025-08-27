<?php include('headpublic.php'); ?>

    <section id="img_resultado">
        <h3>Resultado de la búsqueda</h3>

        <?php
            if(isset($_POST["titulo"]) && $_POST["titulo"] != ''){
               echo '<h4>Titulo: ' . $_POST["titulo"] . '</h4>';
               $tit = "S";
            }else{
                $tit = "N";
                echo '<h4>Titulo: Sin especificar</h4>';
            }

            if(isset($_POST["fecha1"]) && $_POST["fecha1"] != ''){
                echo '<h4>Fecha: ' . $_POST["fecha1"] . ' y ';
                $fe1 = "S";
            }else{
                echo '<h4>Fecha: Sin especificar y ';
                $fe1 = "N";
            }

            if(isset($_POST["fecha2"]) && $_POST["fecha2"] != ''){
                echo ' ' . $_POST["fecha2"] . ' </h4>';
                $fe2 = "S";
            }else{
                echo ' Sin especificar </h4>';
                $fe2 = "N";
            }
        ?>
        <h4>País: <?php echo $_POST["lugartomada"];?></h4>

        <?php
            // Ejecuta una sentencia para saber el pais
            $sentencia1 = 'SELECT * FROM paises WHERE NomPais = "' . $_POST["lugartomada"] . '" ';
            if(!($resultado1 = @mysqli_query($link, $sentencia1))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }
            $fila1 = mysqli_fetch_assoc($resultado1);

            //Ejecutamos una sentencia para encontrar las fotos
            $sentencia2 = 'SELECT * FROM fotos WHERE ';
            if($fe1 == "S"){
                $sentencia2 = $sentencia2 . 'Fecha >= "' . $_POST["fecha1"] . '" AND ';
            }
            if($fe2 == "S"){
                $sentencia2 = $sentencia2 . 'Fecha <= "' . $_POST["fecha2"] . '" AND ';
            }

            if($tit == "S"){
                $sentencia2 = $sentencia2 . 'Titulo = "' . $_POST["titulo"] . '" AND ';
            }

            $sentencia2 = $sentencia2 . 'Pais = ' . $fila1['IdPais'] . '';

            if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
                echo '</p>';
                exit;
            }

            $totalFilas    =    mysqli_num_rows($resultado2);
            
            if($totalFilas == 0){
                echo "<h4>No se encontrarón resultados para dicha búsqueda</h4>";
            }

            while($fila2 = mysqli_fetch_assoc($resultado2)) {
                //Resultado de la búsqueda
                echo '<label>';
                    echo '<a href="detalle.php?fondo=' . $fila2['IdFoto'] . '"><img src="./' . $fila2['Fichero'] . '" alt="' . $fila2['Alternativo'] . '" class="fotos_pagina"></a><br>';
                    echo '<label>Título: ' . $fila2['Titulo'] . '</label><br/>';
                    echo '<label>Fecha: ' . $fila2['Fecha'] . '</label><br/>';
                    echo '<label>País: ' . $fila1['NomPais'] . '</label> ';
                echo ' </label>';
            }
        ?>

    </section>

    <?php include('footer.php'); ?>
</body>
</html> 