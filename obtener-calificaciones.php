<?php
include('config.php');

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $limit;

// Obtener término de búsqueda si existe
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchTerm = "%$search%";

// Ajustar consulta para incluir búsqueda
$query = $conn->prepare("
    SELECT calificaciones.id, calificaciones.estudiante_id, calificaciones.asignatura, calificaciones.semestre, calificaciones.calificacion, estudiantes.nombre, estudiantes.apellido 
    FROM calificaciones 
    JOIN estudiantes ON calificaciones.estudiante_id = estudiantes.id 
    WHERE estudiantes.nombre LIKE ? OR estudiantes.apellido LIKE ? OR calificaciones.asignatura LIKE ?
    LIMIT ? OFFSET ?");
$query->bind_param("sssii", $searchTerm, $searchTerm, $searchTerm, $limit, $offset);
$result = $query->execute();
$result = $query->get_result();

if (!$result) {
    echo json_encode(['error' => 'Error en la consulta a la base de datos.']);
    exit;
}

// Calcular total de registros con el término de búsqueda
$totalQuery = $conn->prepare("
    SELECT COUNT(*) AS total 
    FROM calificaciones 
    JOIN estudiantes ON calificaciones.estudiante_id = estudiantes.id 
    WHERE estudiantes.nombre LIKE ? OR estudiantes.apellido LIKE ? OR calificaciones.asignatura LIKE ?");
$totalQuery->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
$totalQuery->execute();
$totalResult = $totalQuery->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

// Procesar resultados
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Responder en formato JSON
echo json_encode([
    'data' => $data,
    'totalPages' => $totalPages,
    'currentPage' => $page,
]);
?>
