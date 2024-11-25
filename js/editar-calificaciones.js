document.addEventListener("DOMContentLoaded", function() {
    // Obtener el formulario y el modal
    const formulario = document.getElementById('formulario-editar-calificacion');
    const modal = document.getElementById('modal-registro-exitoso');
    const cerrarModal = modal.querySelector('.cerrar');
    const mensajeModal = modal.querySelector('p');

    // Función para mostrar el modal
    function mostrarModal(mensaje) {
        mensajeModal.textContent = mensaje;
        modal.style.display = "block";
    }

    // Cerrar el modal cuando se haga clic en el botón de cerrar
    cerrarModal.addEventListener('click', function() {
        modal.style.display = "none";
    });

    // Prevenir el envío del formulario para realizar validaciones
    formulario.addEventListener('submit', function(event) {
        event.preventDefault();

        // Validaciones del formulario
        const cedula = formulario.querySelector('input[name="cedula"]');
        const calificacion = formulario.querySelector('input[name="calificacion"]');
        const semestre = formulario.querySelector('input[name="semestre"]');

        let valid = true;

        // Validar cédula (debe ser numérica y tener entre 7 y 9 dígitos)
        if (!/^\d{7,9}$/.test(cedula.value)) {
            valid = false;
            alert('La cédula debe contener entre 7 y 9 dígitos');
        }

        // Validar calificación (debe ser entre 0 y 20)
        if (calificacion.value < 0 || calificacion.value > 20) {
            valid = false;
            alert('La calificación debe estar entre 0 y 20');
        }

        // Validar semestre (debe ser un número entre 0 y 8)
        if (semestre.value < 0 || semestre.value > 8) {
            valid = false;
            alert('El semestre debe estar entre 0 y 8');
        }

        // Si todas las validaciones son correctas, enviar el formulario
        if (valid) {
            formulario.submit(); // Enviar el formulario al servidor
        }
    });
});
