<?php include('headprivado.php'); ?>
       
        <form action="albumdatos.php" id="estilos" method="post" class="formularios">
            <fieldset>
                <?php
                echo '<p>Estilos disponibles del usuario: </p>';
                $sentencia3 = 'SELECT * FROM estilos';
                if(!($resultado3 = @mysqli_query($link, $sentencia3))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia3</b>: " . mysqli_error($link);
                    echo '</p>';
                    exit;
                }
                while($estilo = mysqli_fetch_assoc($resultado3)){
                    echo '<p><a href="estilocambiado.php?estilo='. $estilo['IdEstilo'] .'">Estilo: '.$estilo['Nombre'].'</a></p>';
                }
                ?>
            </fieldset>
        </form>

        <?php include('footer.php'); ?>
</body>
</html>