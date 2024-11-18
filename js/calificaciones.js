// Función para filtrar las calificaciones
document.getElementById('searchInput').addEventListener('keyup', function() {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll('#dataTableBody tr');

    rows.forEach(function(row) {
        var cells = row.getElementsByTagName('td');
        var found = false;

        for (var i = 0; i < cells.length; i++) {
            if (cells[i].textContent.toLowerCase().includes(input)) {
                found = true;
                break;
            }
        }

        row.style.display = found ? '' : 'none';
    });
});
