<?php
include('../auth/autenticación.php');
include('config.php'); // Archivo para la conexión a la base de datos

$query = "SELECT * FROM calificaciones";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['estudiante_id'] . "</td>";
        echo "<td>" . $row['asignatura'] . "</td>";
        echo "<td>" . $row['semestre'] . "</td>";
        echo "<td>" . $row['calificacion'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>" . $row['comentario'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
}
?>
