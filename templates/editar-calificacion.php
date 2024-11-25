<?php
// Incluir la conexión a la base de datos
include '../config.php';

// Verificar si se pasa un ID en la URL
if (isset($_GET['id'])) {
    $id_calificacion = $_GET['id'];

    // Consulta para obtener los datos de la calificación y el estudiante
    $sql = "SELECT c.id AS calificacion_id, c.calificacion, c.asignatura, 
                   e.cedula, e.nombre, e.apellido
            FROM calificaciones c
            JOIN estudiantes e ON c.estudiante_id = e.id
            WHERE c.id = ?";

    if (!$conn) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $id_calificacion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $calificacion = $result->fetch_assoc();
        $cedula = $calificacion['cedula'];
        $nombre = $calificacion['nombre'];
        $apellido = $calificacion['apellido'];
        $calificacion_value = $calificacion['calificacion'];
        $asignatura = $calificacion['asignatura'];
    } else {
        echo "Calificación no encontrada.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $calificacion_value = $_POST['calificacion'];
        $asignatura = $_POST['asignatura'];

        $update_calificaciones_sql = "UPDATE calificaciones 
                                      SET calificacion = ?, asignatura = ? 
                                      WHERE id = ?";
        $update_stmt = $conn->prepare($update_calificaciones_sql);
        if (!$update_stmt) {
            die("Error al preparar la consulta de actualización: " . $conn->error);
        }
        $update_stmt->bind_param("ssi", $calificacion_value, $asignatura, $id_calificacion);

        if (!$update_stmt->execute()) {
            die("Error al actualizar la calificación: " . $conn->error);
        }

        header('Location: calificaciones.php');
        exit;
    }
} else {
    echo "ID de calificación no especificado.";
    exit;
}

?>
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
    <title>Editar Calificación</title>
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
            <!-- Puedes añadir enlaces aquí -->
        </nav>
    </header>

    <section>
        <form id="formulario-editar-calificacion" action="editar-calificacion.php?id=<?php echo $id_calificacion; ?>" method="POST">
            <fieldset class="formulario" id="form1">
                <h3 style="text-align: center; font-size: 25px;">Editar Calificación</h3>
                <input type="hidden" name="id" value="<?php echo $id_calificacion; ?>">

                <input type="text" name="cedula" placeholder="Cédula" class="campo" pattern="\d{7,9}" 
                       title="La cédula debe contener entre 7 y 9 dígitos" required value="<?php echo $cedula; ?>" disabled>
                <input type="text" name="nombre" placeholder="Nombre" class="campo" required value="<?php echo $nombre; ?>" disabled>
                <input type="text" name="apellido" placeholder="Apellido" class="campo" required value="<?php echo $apellido; ?>" disabled>
                <input type="number" name="calificacion" class="campo" placeholder="Calificación" min="0" max="20" 
                       style="padding: 10px;" value="<?php echo $calificacion_value; ?>" required>
                <input type="text" name="asignatura" class="campo" placeholder="Asignatura" style="padding: 10px;" 
                       required value="<?php echo $asignatura; ?>">
             
                <input type="submit" value="Guardar cambios" style="background: #edcaff; color: rgb(6, 13, 35);">
            </fieldset>
        </form>
    </section>

    <footer>
        <p>Desarrollado Por&nbsp; <a href="https://github.com/AlexDevCoding" class="items" target="_blank" rel="noopener noreferrer">AlexDevCoding.</a>&nbsp; © 2024.</p>
        <a class="git-hub ti ti-brand-github" href="https://github.com/Josue547" target="_blank" rel="noopener noreferrer"></a>
    </footer>
</body>
<script src="../js/editar-calificaciones.js"></script>
</html>
