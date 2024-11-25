<?php
header('Content-Type: application/json');
include 'config.php'; // Archivo de configuración para la conexión `$conn`
error_reporting(E_ALL);
ini_set('display_errors', 1); // Mostrar todos los errores para depuración

try {
    // Verificar si la conexión a la base de datos es exitosa
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Obtener parámetros de la solicitud
    $tipo_reporte = $_GET['tipo_reporte'] ?? '';
    $periodo = $_GET['periodo'] ?? '';

    // Validar parámetros
    if (empty($tipo_reporte) || empty($periodo)) {
        throw new Exception("Parámetros incompletos. Se requiere 'tipo_reporte' y 'periodo'.");
    }

    // Calcular el rango de fechas
    $fecha_inicio = '';
    $fecha_fin = '';

    if ($periodo === 'Diario') {
        $fecha_inicio = date('Y-m-d');
        $fecha_fin = date('Y-m-d');
    } elseif ($periodo === 'Mensual') {
        $fecha_inicio = date('Y-m-01');
        $fecha_fin = date('Y-m-t');
    } else {
        throw new Exception("Período no válido. Usa 'Diario' o 'Mensual'.");
    }



    // Definir la consulta SQL según el tipo de reporte
    $sql = '';
    if ($tipo_reporte === 'estudiantes') {
        $sql = "SELECT id, cedula, nombre, apellido, carrera, telefono, fecha_ingreso
                FROM estudiantes
                WHERE fecha_ingreso BETWEEN ? AND ?";
    } elseif ($tipo_reporte === 'calificaciones') {
        $sql = "SELECT e.nombre, e.apellido, c.asignatura, c.semestre, c.calificacion, c.estado, c.comentario
                FROM calificaciones c
                JOIN estudiantes e ON c.estudiante_id = e.id
                WHERE c.fecha_registro BETWEEN ? AND ?";
    } else {
        throw new Exception("Tipo de reporte no válido. Usa 'estudiantes' o 'calificaciones'.");
    }

    // Preparar la consulta y ejecutarla
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular los parámetros
    if (!$stmt->bind_param("ss", $fecha_inicio, $fecha_fin)) {
        throw new Exception("Error al vincular los parámetros.");
    }

    // Ejecutar la consulta
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Error al obtener los resultados: " . $stmt->error);
    }

    // Construir el resultado
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Verificar que se obtuvieron datos
    if (empty($data)) {
        echo json_encode(["mensaje" => "No hay datos para el período seleccionado"]);
    } else {
        echo json_encode(["success" => true, "data" => $data]);
    }

} catch (Exception $e) {
    http_response_code(400); // Cambiar a 400 para mostrar error de solicitud incorrecta
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    // Cerrar la conexión
    if (isset($conn)) {
        $conn->close();
    }
}
?>
