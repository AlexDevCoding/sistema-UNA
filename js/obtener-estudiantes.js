document.addEventListener('DOMContentLoaded', () => {
    const cedulaInput = document.querySelector('input[name="cedula"]');
    const nombreInput = document.querySelector('input[name="nombre"]');
    const apellidoInput = document.querySelector('input[name="apellido"]');
    const carreraInput = document.querySelector('input[name="carrera"]');

    cedulaInput.addEventListener('blur', () => {
        const cedula = cedulaInput.value.trim();

        if (cedula) {
            fetch('../buscar-estudiantes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cedula })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    nombreInput.value = data.nombre;
                    apellidoInput.value = data.apellido;
                    carreraInput.value = data.carrera || '';
                } else {
                    alert(data.message || 'No se encontró el estudiante');
                    nombreInput.value = '';
                    apellidoInput.value = '';
                    carreraInput.value = '';
                }
            })
            .catch(error => {
                console.error('Error al buscar estudiante:', error);
            });
        }
    });
});
