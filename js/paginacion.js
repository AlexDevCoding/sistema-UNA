function cargarPagina(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../obtener-calificaciones.php?page=' + page, true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('dataTableBody').innerHTML = this.responseText;
        } else {
            console.error('Error al cargar la página: ' + this.status);
        }
    };
    xhr.onerror = function() {
        console.error('Error de red');
    };
    xhr.send();
}