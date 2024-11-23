document.addEventListener('DOMContentLoaded', () => {
    const tabla = document.getElementById('dataTableBody');
    const paginacion = document.getElementById('pagination');
    const searchInput = document.getElementById('searchInput');

    let currentPage = 1;
    const recordsPerPage = 10;

    function cargarCalificaciones(page = 1, search = '') {
        fetch(`../obtener-calificaciones.php?page=${page}&search=${search}`)
            .then(response => response.json())
            .then(data => {
                const { data: calificaciones, totalPages } = data;
                tabla.innerHTML = '';

                if (calificaciones && calificaciones.length > 0) {
                    calificaciones.forEach(calificacion => {
                        const row = `
                            <tr>
                                <td>${calificacion.id}</td>
                                <td>${calificacion.nombre}</td>
                                <td>${calificacion.apellido}</td>
                                <td>${calificacion.asignatura}</td>
                                <td>${calificacion.semestre}</td>
                                <td>${calificacion.calificacion}</td>
                                <td class="activo" id="center">
                                    <a href="editar-calificacion.php?id=${calificacion.id}">
                                        <button class="edit"><i class="ti ti-pencil"></i></button>
                                    </a>
                                    <button class="delete" data-id="${calificacion.id}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                        tabla.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    tabla.innerHTML = '<tr><td colspan="7">No hay datos disponibles</td></tr>';
                }

                actualizarPaginacion(totalPages, page);
            })
            .catch(error => console.error('Error al cargar las calificaciones:', error));
    }

    function actualizarPaginacion(totalPages, currentPage) {
        paginacion.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.addEventListener('click', () => cargarCalificaciones(i, searchInput.value));
            paginacion.appendChild(button);
        }
    }

    searchInput.addEventListener('input', () => cargarCalificaciones(1, searchInput.value));
    cargarCalificaciones(currentPage);
});
