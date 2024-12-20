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
    <title>Editar Estudiante</title>
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
       

        <form action="../editar-estudiantes.php" method="POST" id="editForm">
            <fieldset class="formulario" id="form1">
                <h3 style="text-align: center; font-size: 25px;">Editar estudiante </h3>
                <input type="hidden" name="id" id="studentId">
                <input type="text" name="cedula" id="cedula" placeholder="Cédula" class="campo" pattern="\d{8}" title="La cédula debe contener 8 dígitos" >
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="campo" >
                <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="campo" >
                <input type="tel" name="telefono" id="telefono" placeholder="Teléfono" class="campo" pattern="\d{10,11}" title="El teléfono debe contener 10 o 11 dígitos">
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" placeholder="Fecha de ingreso" class="campo" style="padding: 10px;" required>
                <select id="carrera" name="carrera" class="campo" style="padding: 10px;" style="background: red;">
                    <option value="Seleccionar">Seleccionar</option>
                    <option value="Sistemas">Sistemas</option>
                    <option value="Telecomunicaciones">Telecomunicaciones</option>
                  
                </select>
                <input type="submit" value="Editar Estudiante" class="campo" style="background: #edcaff; color: rgb(6, 13, 35); ">
            </fieldset>
        </form>




    </section>

    <div id="modal-registro-exitoso" class="modal">
        <div class="modal-contenido" id="modal1">
            <div id="originalData" style="display: none;"></div>
            <span class="cerrar" id="cerrar2">&times;</span>
            <p></p>
        </div>
    </div>

    <footer>

        <p>Desarrollado Por&nbsp; <a href="https://github.com/AlexDevCoding" class="items" target="_blank" rel="noopener noreferrer">AlexDevCoding.</a>&nbsp; © 2024.</p>   <a class="git-hub ti ti-brand-github" href="https://github.com/Josue547" target="_blank" rel="noopener noreferrer"></a>
    </footer>
    <script src="../js/editar-estudiantes.js"></script>

</body>
</html>
