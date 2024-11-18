<?php
// Verifica si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    // Si no está autenticado, redirige al login
    header('Location: ../templates/login.html');
    exit();
}
?>