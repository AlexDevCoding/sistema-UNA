document.addEventListener('DOMContentLoaded', () => {
    const cedulaInput = document.querySelector('input[name="cedula"]');
    const nombreInput = document.querySelector('input[name="nombre"]');
    const apellidoInput = document.querySelector('input[name="apellido"]');
    const carreraSelect = document.querySelector('select[name="carrera"]');

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

                    if (data.carrera && [...carreraSelect.options].some(option => option.value === data.carrera)) {
                        carreraSelect.value = data.carrera;
                    } else {
                        carreraSelect.value = 'Seleccionar';
                    }
                } else {
                    alert(data.message || 'Error al buscar estudiante');
                    nombreInput.value = '';
                    apellidoInput.value = '';
                    carreraSelect.value = 'Seleccionar';
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    });
});
