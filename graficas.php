<?php
header('Content-Type: application/json');

include 'config.php';

$carreras = [];
$fechas = [];
$graficocarreras = ['categories' => [], 'data' => []];
$totalEstudiantes = [];
$resultData = []; 

try {

    $sqlcarreras = "SELECT carrera, COUNT(*) as total FROM estudiantes GROUP BY carrera";
    $resultcarreras = $conn->query($sqlcarreras);

    if (!$resultcarreras) {
        throw new Exception("Error en la consulta de carreras: " . $conn->error);
    }

    while ($row = $resultcarreras->fetch_assoc()) {
        $carreras[$row['carrera']] = $row['total'];
        $graficocarreras['categories'][] = $row['carrera'];
        $graficocarreras['data'][] = (int)$row['total'];
    }


    $sqlFechas = "
        SELECT DATE_FORMAT(fecha_ingreso, '%Y-%m') as mes, COUNT(*) as total
        FROM estudiantes
        GROUP BY mes
    ";
    $resultFechas = $conn->query($sqlFechas);

    if (!$resultFechas) {
        throw new Exception("Error en la consulta de fechas: " . $conn->error);
    }

    while ($row = $resultFechas->fetch_assoc()) {
        $fechas[$row['mes']] = $row['total'];
    }


    $sqlTotalEstudiantes = "
        SELECT DATE_FORMAT(fecha_ingreso, '%Y-%m') as fecha, COUNT(*) as total
        FROM estudiantes
        GROUP BY fecha
        ORDER BY fecha
    ";
    $resultTotalEstudiantes = $conn->query($sqlTotalEstudiantes);

    if (!$resultTotalEstudiantes) {
        throw new Exception("Error en la consulta de total de estudiantes: " . $conn->error);
    }

    while ($row = $resultTotalEstudiantes->fetch_assoc()) {
        $totalEstudiantes[$row['fecha']] = $row['total'];
    }

 
    $startOfMonth = date('Y-m-01');
    $endOfMonth = date('Y-m-t');


    $sqlMonth = "SELECT COUNT(*) AS student_count FROM estudiantes WHERE fecha_ingreso BETWEEN ? AND ?";
    if ($stmtMonth = $conn->prepare($sqlMonth)) {
        $stmtMonth->bind_param('ss', $startOfMonth, $endOfMonth);
        $stmtMonth->execute();
        $resultMonth = $stmtMonth->get_result();
        if ($rowMonth = $resultMonth->fetch_assoc()) {
            $resultData['students_this_month'] = $rowMonth['student_count'];
        } else {
            $resultData['students_this_month'] = 0;
        }
        $resultMonth->free();
        $stmtMonth->close();
    } else {
        throw new Exception("Error en la consulta de estudiantes este mes: " . $conn->error);
    }


    $startOfWeek = date('Y-m-d', strtotime('monday this week'));
    $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
    
    $sqlWeek = "SELECT COUNT(*) AS student_count FROM estudiantes WHERE fecha_ingreso BETWEEN ? AND ?";
    if ($stmtWeek = $conn->prepare($sqlWeek)) {
        $stmtWeek->bind_param('ss', $startOfWeek, $endOfWeek);
        $stmtWeek->execute();
        $resultWeek = $stmtWeek->get_result();
        if ($rowWeek = $resultWeek->fetch_assoc()) {
            $resultData['students_this_week'] = $rowWeek['student_count'];
        } else {
            $resultData['students_this_week'] = 0;
        }
        $resultWeek->free();
        $stmtWeek->close();
    } else {
        throw new Exception("Error en la consulta de estudiantes esta semana: " . $conn->error);
    }


    $sqlTotalStudents = "SELECT COUNT(*) AS student_count FROM estudiantes";
    if ($resultTotalStudentsCount = $conn->query($sqlTotalStudents)) {
        if ($rowTotal = $resultTotalStudentsCount->fetch_assoc()) {
            $resultData['total_students'] = $rowTotal['student_count'];
        } else {
            $resultData['total_students'] = 0;
        }
    } else {
        throw new Exception("Error en la consulta de número total de estudiantes: " . $conn->error);
    }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

$conn->close();

echo json_encode([
    "carreras" => $carreras,
    "fechas" => $fechas,
    "graficocarreras" => $graficocarreras,
    "totalEstudiantes" => $totalEstudiantes,
    "students_this_month" => $resultData['students_this_month'],
    "students_this_week" => $resultData['students_this_week'],
    "total_students" => $resultData['total_students']
]);
?>
