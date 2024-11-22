<?php include('../auth/autenticación.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/Css/style.css">
    <link rel="stylesheet" href="../static/webfont/tabler-icons-outline.css">
    <link rel="icon" href="../static/img/file.png">
    <title>Calificaciones</title>
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
                <li class="t"><a href="../logout.php" id="cerrar-link"><i class="ti ti-logout"></i>Cerrar Sesión</a></li>
            </ul>
        </nav>
    </aside>

    <header class="cabecera">
        <nav class="menu">
            <h1 style="color: white;" class="titulo2">Calificaciones</h1>
        </nav>
    </header>

    <section id="content">
        <div id="data-container" class="datos">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar calificaciones..." class="buscar">
                <i class="search-icon ti ti-search"></i>
                <a href="añadir-calificación.php" class="calificaciones"> Añadir Calificación</a>
            </div>
            <table id="dataTable" class="zebra-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre </th>
                        <th>Apellido </th>
                        <th>Asignatura</th>
                        <th>Semestre</th>
                        <th>Calificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="dataTableBody">
                    <!-- Aquí se llenará dinámicamente con JavaScript -->
                </tbody>
            </table>
            <div id="pagination" class="pagination">
                <!-- Botones de paginación se generarán dinámicamente -->
            </div>
        </div>
    </section>

    <script src="../js/obtener-calificaciones.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>
