<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/Css/style.css">
    <link rel="stylesheet" href="../static/webfont/tabler-icons-outline.css">
    <link rel="icon" href="../static/img/file.png">
   
    <title>Document</title>
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

            

        </nav>


    </header>

    <section>
  

    <form id="formulario-registro" action="../registrar-estudiante.php" method="POST">
        <fieldset class="formulario" id="form1">
            <h3 style="text-align: center; font-size: 25px;">Añadir estudiante </h3>
            <input type="text" name="cedula" placeholder="Cédula" class="campo" pattern="\d{8}" title="la cedula debe contener 8 digitos" required>
            <input type="text" name="nombre" placeholder="Nombre" class="campo" required>
            <input type="text" name="apellido" class="campo" placeholder="Apellido" required>
            <input type="tel" name="telefono" placeholder="Teléfono" class="campo" pattern="\d{10,11}" title="El teléfono debe contener 10 u 11 dígitos" required>
            <input type="date" name="fecha" class="campo" placeholder="Fecha de ingreso " style="padding: 10px; color: #888;" required>
            <select id="carrera" name="carrera" class="campo" style="padding: 10px;" style="background: red;">
                    <option value="Seleccionar">Seleccionar</option>
                    <option value="Sistemas">Sistemas</option>
                    <option value="Telecomunicaciones">Telecomunicaciones</option>
            </select>
            <input type="submit" value="Agregar Estudiante"  style="background: #edcaff; color: rgb(6, 13, 35);">
        </fieldset>
    </form>
</section>


<div id="modal-registro-exitoso" class="modal">
    <div class="modal-contenido">
        <span class="cerrar">&times;</span>
        <p></p>
    </div>
</div>
<footer>

    <p>Desarrollado Por&nbsp; <a href="https://github.com/AlexDevCoding" class="items" target="_blank" rel="noopener noreferrer">AlexDevCoding.</a>&nbsp; © 2024.</p>   <a class="git-hub ti ti-brand-github" href="https://github.com/Josue547" target="_blank" rel="noopener noreferrer"></a>
</footer>
<script src="../js/agregar-estudiantes.js"></script>

</body>
</html>