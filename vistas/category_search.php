

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        if(isset($_POST['modulo_buscador'])){
            require_once "./php/buscador.php";
        }

        if(!isset($_SESSION['busqueda_categoria']) && empty($_SESSION['busqueda_categoria'])){
    ?>
    <h1 class="title has-text-centered">Categorías</h1>
    <h2 class="subtitle  has-text-centered">Buscar categoría</h2>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto; /* Margen automático para centrar el contenedor */
            padding: 20px;
            background-color: #FFFFFF; /* Fondo blanco para el contenedor */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4; /* Color de fondo para toda la página */
            text-align: center; /* Centra el texto en el cuerpo de la página */
        }

        .form-rest {
            max-width: 500px;
            margin: 0 auto;
        }

        .select, .input, .button {
            margin-bottom: 10px;
        }
    </style>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="categoria">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué categoria estas buscando?" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30" >
                    </p>
                    <p class="control">
                        <button class="button is-info" type="submit" >Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="categoria"> 
                <input type="hidden" name="eliminar_buscador" value="categoria">
                <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_categoria']; ?>”</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
            </form>
        </div>
    </div>

    <?php
            # Eliminar categoria #
            if(isset($_GET['category_id_del'])){
                require_once "./php/categoria_eliminar.php";
            }

            if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }

            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=category_search&page="; /* <== */
            $registros=15;
            $busqueda=$_SESSION['busqueda_categoria']; /* <== */

            # Paginador categoria #
            require_once "./php/categoria_lista.php";
        } 
    ?>
</div>