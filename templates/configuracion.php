
<?php
    include('../auth/autenticación.php')
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/Css/style.css">
    <link rel="icon" href="../static/img/file.png">
    <link rel="stylesheet" href="../static/webfont/tabler-icons-outline.css">
    <title>Panel de Estudiantes</title>
</head>
<body>
    <aside>
        <div class="subbox">
            <img src="../static/img/file.png" alt="Avatar">
            <h3>admin</h3>
        </div>
        <nav>
            <ul>
                <a class="boton-enlace" id="añadir-estudiantes-link" href="agregar-estudiantes.php">Añadir estudiantes</a>
                <li class="t"><a href="index.php" id="tablero-link"><i class="ti ti-layout-dashboard"></i>Tablero</a></li>
                <li class="t"><a href="estudiantes.php" id="estudiantes-link"><i class="ti ti-users"></i>Estudiantes</a></li>
                <li class="t"><a href="calificaciones.php" id="calificaciones-link"><i class="ti ti-certificate"></i>Calificaciones</a></li>
            </ul>
            <ul class="submenu">
                <li class="t"><a href="estadisticas.php" id="estadisticas-link"><i class="ti ti-chart-bar-popular"></i>Estadísticas</a></li>
                <li class="t"><a href="reportes.php" id="reportes-link"><i class="ti ti-report"></i>Reportes</a></li>
                <li class="t"><a href="configuracion.php" id="configuracion-link"><i class="ti ti-settings"></i>Configuración</a></li>
                <li class="t"><a href="../logout.php" id="cerrar-link"><i class="ti ti-logout"></i>Cerrar Sección</a></li>
            </ul>
        </nav>
    </aside>

    <header class="cabecera">
        <nav class="menu">
            <h1 style="color: white;" class="titulo2">Configuración</h1>
        </nav>
    </header>
    
    <section id="content">
        <form id="formulario-registro" action="../editar-administrador.php" method="POST">
            <fieldset class="formulario" id="form1">
                <h2 style="text-align: center;">Editar administrador</h2>
                <input type="hidden" name="id" id="usuario-id">
        
                <input type="text" name="nombre" placeholder="Nombre" class="campo" id="nombre" autocomplete="off">
                <input type="text" name="apellido" class="campo" placeholder="Apellido" id="apellido" autocomplete="off">
                <input type="text" name="usuario" placeholder="Usuario" class="campo" id="usuario" autocomplete="off">
                <input type="email" name="correo" placeholder="Correo" class="campo" id="correo" autocomplete="off">
                <input type="password" name="contrasena" placeholder="Nueva Contraseña" class="campo" id="contrasena" autocomplete="new-password">

        
                <input type="submit" value="Editar admin" class="campo" style="background: #edcaff; color: rgb(6, 13, 35);">
            </fieldset>
        </form>
        
        
    </section>

    <footer>

        <p>Desarrollado Por&nbsp; <a href="https://github.com/AlexDevCoding" class="items" target="_blank" rel="noopener noreferrer">AlexDevCoding.</a>&nbsp; © 2024.</p>   <a class="git-hub ti ti-brand-github" href="https://github.com/Josue547" target="_blank" rel="noopener noreferrer"></a>
    </footer>
    <script src="../js/editar-administrador.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>
