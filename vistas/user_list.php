<div class="container">
    <h1 class="title has-text-centered">Usuarios</h1>
    <h2 class="subtitle has-text-centered">Lista de usuarios</h2>
    <div class="text-center"> <!-- Agrega un contenedor con clase "text-center" para centrar el botón -->
        <a href="generar_pdf_usuarios.php" class="button is-primary">Descargar PDF de Usuarios</a>
    </div>
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
</div>

    <?php
        require_once "./php/main.php";
        if(isset($_POST['modulo_buscador'])){
            require_once "./php/buscador.php";
        }
        if(!isset($_SESSION['busqueda_usuario']) && empty($_SESSION['busqueda_usuario'])){
    ?>
 
    
    <?php } ?>

<div class="container">
    <?php
        require_once "./php/main.php";
        # Eliminar usuario #
        if(isset($_GET['user_id_del'])){
            require_once "./php/usuario_eliminar.php";
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
        $url="index.php?vista=user_list&page=";
        $registros=15;
        $busqueda="";
        # Paginador usuario #
        require_once "./php/usuario_lista.php";
    ?>
</div>


    <h2 class="subtitle"></h2>
</div>
