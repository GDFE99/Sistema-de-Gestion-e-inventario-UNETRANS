<div class="container">
    <h1 class="title has-text-centered">Profesores</h1>
    <h2 class="subtitle has-text-centered">Lista de profesores</h2> 
    <style>
       .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFFFFF;
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

<div class="container">
    <?php
        require_once "./php/main.php";
       if(isset($_GET['user_id_del'])){
        require_once "./php/profesor_eliminar.php";
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
        $url="index.php?vista=profesor_list&page=";
        $registros=15;
        $busqueda="";
        # Paginador de profesores #
        require_once "./php/profesor_lista.php";
    ?>
</div>
    <h2 class="subtitle"></h2>
</div>

<div>
                                