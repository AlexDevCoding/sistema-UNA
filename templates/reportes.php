<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/Css/style.css">
    <link rel="stylesheet" href="../static/webfont/tabler-icons-outline.css">
    <link rel="icon" href="../static/img/file.png">
    <title>Reportes</title>
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
            <h1 style="color: white;" class="titulo2">Reportes</h1>
        </nav>
    </header>



    <section id="content"> 
        <div class="estadisticas-mayor">

        
            <div class="reportes">
                <div class="texto">
                    <i class="ti ti-school" style="font-size: 30px; color: #9ca3af;"></i>
                    <h1 class="texto2">Reportes De Estudiantes</h1>
                </div>
                <select name="reportes-estudiantes" class="reportes-estudiantes">
                    <option value="" selected>Seleccionar Periodo</option>
                    <option value="Diario">Diario</option>
                    <option value="Mensual">Mensual</option>
                </select>
                <button type="button" class="btn-generar" id="generar-reporte-estudiantes">Generar Reporte</button>
            </div>
        
            <div class="reportes">
                <div class="texto">
                    <i class="ti ti-school" style="font-size: 30px; color: #9ca3af;"></i>
                    <h1 class="texto2">Reportes De Calificaciones</h1>
                </div>
                <select name="reportes-calificaciones" class="reportes-estudiantes">
                    <option value="" selected>Seleccionar Periodo</option>
                    <option value="Diario">Diario</option>
                    <option value="Mensual">Mensual</option>
                </select>
                <button type="button" class="btn-generar" id="generar-reporte-calificaciones">Generar Reporte</button>
            </div>
        
        </div>
        
       

    </section>

    <script src="../js/index.js"></script>
    <script src="../js/reportes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</body>
</html>