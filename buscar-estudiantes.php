<?php
header('Content-Type: application/json');

include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['cedula'])) {
    echo json_encode(['success' => false, 'message' => 'No se recibió la cédula']);
    exit;
}

$cedula = $data['cedula'];

// Actualizar la consulta para incluir el campo carrera
$sql = "SELECT nombre, apellido, carrera FROM estudiantes WHERE cedula = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
    exit;
}

$stmt->bind_param("s", $cedula);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $estudiante = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'nombre' => $estudiante['nombre'],
        'apellido' => $estudiante['apellido'],
        'carrera' => $estudiante['carrera'] // Incluir la carrera en la respuesta
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Estudiante no encontrado']);
}

$stmt->close();
$conn->close();
?>
