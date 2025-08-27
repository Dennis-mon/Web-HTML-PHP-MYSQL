<?php include('headprivado.php'); ?>
       
        <form action="albumdatos.php" id="album" method="post" class="formularios">
            <fieldset>
                <legend>Formulario de solicitud</legend>
                <p id="subtitulo">Rellena este formulario aportando todos los detalles de tu álbum deseado.</p>
                <?php
                    if(isset($_GET["error"]) && $_GET["error"]=="T"){
                        echo '<p id="subtitulo">Es necesario introducir un título para el álbum</p>';
                    }
                ?>
                <p>
                    <label for="titulo">Título del álbum (*)</label>
                    <input type="text" name="titulo" id="titulo" maxlength="200">
                </p>
                <p>
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcionAl">
                </p>
                <p>
                    <input type="submit" value="Crear Álbum" class="boton_fin">
                </p>
            </fieldset>
        </form>

        <?php include('footer.php'); ?>
</body>
</html>