
<?php
    include('../auth/autenticación.php')
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/Css/style.css">
    <link rel="stylesheet" href="../static/webfont/tabler-icons-outline.css">
    <link rel="icon" href="../static/img/file.png">
    <link rel="stylesheet" href="../static/Css/medias-queries.css">
    <title>Panel de Estudiantes</title>
    <script src="../js/echarts.min.js"></script>

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

            <h1 style="color: white;" class="titulo2">Tablero</h1>

        </nav>


    </header>
        

    <section id="content">
        
    <div class="estadisticas-mayor">
       
        <div class="estadisticas" >
            <i class="ti ti-school" style="font-size: 30px;"></i>
            <span id="student-count"></span>

        </div>
        
        
        <div class="estadisticas">
              <i class="ti ti-school" style="font-size: 30px;"></i>
            <span id="students-this-week"></span>
        </div>

        <div class="estadisticas">
            <i class="ti ti-school" style="font-size: 30px;"></i>
        <span id="students-this-month"></span>
        </div>

        <div class="estadisticas" id="linea">
            <canvas class="estadisticas" id="linea myPieChart"></canvas>
        </div>
        
        
        <div class="estadisticas" id="circulo">
        
        </div>


    </div>

    </section>

    <footer>

        <p>Desarrollado Por&nbsp; <a href="https://github.com/AlexDevCoding" class="items" target="_blank" rel="noopener noreferrer">AlexDevCoding.</a>&nbsp; © 2024.</p>   <a class="git-hub ti ti-brand-github" href="https://github.com/Josue547" target="_blank" rel="noopener noreferrer"></a>
    </footer>

    <script src="../js/index.js"></script>

</body>
</html>
