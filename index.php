<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <?php include "./inc/head.php"; ?>
</head>
<body>
<?php
// Definir la vista por defecto si no se especifica
if (!isset($_GET['vista']) || $_GET['vista'] == "") {
    $_GET['vista'] = "login";
}

// Verificar si la vista solicitada existe y no es 'login' ni '404'
if (is_file("./vistas/" . $_GET['vista'] . ".php") && $_GET['vista'] != "login" && $_GET['vista'] != "404") {
    // Verificar el estado de sesión y el tipo de usuario
    if ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == "")) {
        // Si la sesión no está activa, incluir el formulario de cierre de sesión y detener la ejecución
        include "./vistas/logout.php";
        exit();
    }
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == '1') {
        // Usuario es administrador
        includeAdminView($_GET['vista']);
    } elseif (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == '2') {
        // Usuario es super administrador
        includeSuperAdminView($_GET['vista']);
    } else {
        // Usuario no es administrador ni super administrador
        includeUserView($_GET['vista']);
    }

    // Incluir scripts comunes al final de la página
    include "./inc/script.php";
} else {
    // Si la vista solicitada es 'login' o no existe, cargar la página correspondiente
    if ($_GET['vista'] == "login") {
        include "./vistas/login.php";
    } else {
        include "./vistas/404.php";
    }
}

// Función para incluir vistas específicas para administradores
function includeAdminView($view) {
    $allowedViewsForAdmin = array(
        'home_admin',   // Página principal para administradores
        'user_new',     // Crear nuevo usuario (solo para administradores)
        'user_list',    // Lista de usuarios (solo para administradores)
        'logout',
        'user_update', 
        'password_res',  
        'user_search',
        'user_count', 
        'database_res',
        'ver_logs',
        'ver_pdf',
        '404'           // Página de error 404
    );

    if (in_array($view, $allowedViewsForAdmin)) {
        include "./inc/adminvar.php"; // Incluir barra de navegación para administradores
        include "./vistas/" . $view . ".php"; // Incluir la vista solicitada para administradores
    } else {
        include "./vistas/404.php"; // Si la vista no está permitida para administradores, cargar error 404
    }
}

// Función para incluir vistas específicas para usuarios no administradores
function includeUserView($view) {
    $allowedViewsForUser = array(
        'home',
        'logout',  
        'ver_prestamo', 
        
        'user_update', 
        'profesor_new', 
        'profesor_list',
        'profesor_search',
        'product_update', 
        'product_search', 
        'product_new', 
        'product_list',  
        'product_img', 
        'product_category',  
        'prestamos_update', 
        'prestamos_search', 
        'nueva_prestamo',
        'category_list',
        'category_new',
        'category_search',
        'category_update',
        'ver_prestamo?profesor_id=76',
        'ver_prestamo',
        'password_res',
        'generar_pdf',
        'procesar_prestamo',
        'ver_pdf',
        'buscador_php',
        'user_count',
        'profesor_search',
        'categoria_guardar',
        '404'       // Página de error 404
    );

   

    if (in_array($view, $allowedViewsForUser)) {
        include "./inc/navbar.php"; // Incluir barra de navegación para usuarios no administradores
        include "./vistas/" . $view . ".php"; // Incluir la vista solicitada para usuarios no administradores
    } else {
        include "./vistas/404.php"; // Si la vista no está permitida para usuarios no administradores, cargar error 404
    }
}

function includeSuperAdminView($view) { 
    $allowedViewsForSuperAdmin = array( 
        'home_sadmin', 
        'logout', 
        'user_new', 
        'user_list', 
        'user_update', 
        'user_search', 
        'password_res', 
        'profesor_new', 
        'profesor_list', 
        'product_update', 
        'product_search', 
        'product_new', 
        'product_list', 
        'product_img', 
        'product_category', 
        'prestamos_update', 
        'prestamos_search', 
        'nueva_prestamo', 
        'category_list', 
        'category_new', 
        'category_search', 
        'category_update', 
        'ver_logs', 
        'ver_prestamo', 
        'generar_pdf', 
        'procesar_prestamo', 
        'ver_pdf', 
        'buscador_php', 
        'user_count', 
        'categoria_guardar', 
        'database_res',
        '404' 
    
    ); 
    if (in_array($view, $allowedViewsForSuperAdmin)) { 
        include "./inc/sadminvar.php"; 
        include "./vistas/" . $view . ".php"; 
    } else { 
        include "./vistas/404.php"; 
    } 
}
?>
</body>
</html>

<script>
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    if (error === 'stock_insuficiente') {
        alert('No hay stock del producto');
    }
}
</script>

<?php
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<div class="notification is-success">
            <button class="delete"></button>
             ' . urldecode($_GET['message']) . '
          </div>';
}
?>

<!-- Agregar jQuery (si no está incluido ya) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Función para cerrar la notificación al hacer clic en el botón de cierre
        $('.delete').on('click', function() {
            $(this).parent('.notification').remove(); // Eliminar el elemento padre (la notificación)
        });
    });
</script>
