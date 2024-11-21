<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = mysqli_real_escape_string($conn, $_POST['cedula']);
    $asignatura = mysqli_real_escape_string($conn, $_POST['asignatura']);
    $semestre = mysqli_real_escape_string($conn, $_POST['Semestre']);
    $calificacion = mysqli_real_escape_string($conn, $_POST['calificacion']);
    $comentario = isset($_POST['comentario']) ? mysqli_real_escape_string($conn, $_POST['comentario']) : null;

    if (empty($cedula) || empty($asignatura) || empty($semestre) || empty($calificacion)) {
        echo json_encode(["mensaje" => "Todos los campos son obligatorios.", "estado" => "error"]); // Devolver como JSON
        exit;
    }

    if ($calificacion < 0 || $calificacion > 20) {
        echo json_encode(["mensaje" => "La calificación debe estar entre 0 y 20.", "estado" => "error"]); // Devolver como JSON
        exit;
    }

    $estado = $calificacion >= 10 ? 'Aprobado' : 'Reprobado';

    $sql_estudiante = "SELECT id FROM estudiantes WHERE cedula = '$cedula'";
    $result = mysqli_query($conn, $sql_estudiante);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $estudiante_id = $row['id'];

        $sql_calificacion = "INSERT INTO calificaciones (estudiante_id, asignatura, semestre, calificacion, estado, comentario) 
                              VALUES ('$estudiante_id', '$asignatura', '$semestre', '$calificacion', '$estado', '$comentario')";

        if (mysqli_query($conn, $sql_calificacion)) {
            echo json_encode(["mensaje" => "Calificación registrada con éxito.", "estado" => "success"]); // Devolver como JSON
            exit;
        } else {
            echo json_encode(["mensaje" => "Error al registrar la calificación: " . mysqli_error($conn), "estado" => "error"]); // Devolver como JSON
            exit;
        }
    } else {
        echo json_encode(["mensaje" => "El estudiante con cédula $cedula no existe.", "estado" => "error"]); // Devolver como JSON
    }
}

mysqli_close($conn);
?>
