<?php
include('auth/autenticación.php');
include('config.php');

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT calificaciones.id, calificaciones.estudiante_id, calificaciones.asignatura, calificaciones.semestre, calificaciones.calificacion, estudiantes.nombre, estudiantes.apellido 
          FROM calificaciones 
          JOIN estudiantes ON calificaciones.estudiante_id = estudiantes.id 
          LIMIT $limit OFFSET $offset";

$result = $conn->query($query);

$totalQuery = "SELECT COUNT(*) AS total FROM calificaciones";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellido'] . "</td>";
        echo "<td>" . $row['asignatura'] . "</td>";
        echo "<td>" . $row['semestre'] . "</td>";
        echo "<td>" . $row['calificacion'] . "</td>";
        echo "<td class='activo' id='ad'>";
        echo "<a href='editar-calificacion.php?id=" . $row['id'] . "'><button class='edit'><i class='ti ti-pencil'></i></button></a>";
        echo "<button class='delete' data-id='" . $row['id'] . "'><i class='ti ti-trash'></i></button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
}

echo "</table>";
echo "<div id='pagination'>";
$buttonsToShow = 2;
$startPage = max(1, $page - $buttonsToShow);
$endPage = min($totalPages, $page + $buttonsToShow);

for ($i = $startPage; $i <= $endPage; $i++) {
    echo "<button class='page-button' data-page='$i' onclick='cargarPagina($i)'>$i</button>";
}
echo "</div>";

?>


<script>

</script>

