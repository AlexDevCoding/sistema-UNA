function updateStats() {
    fetch('../graficas-index.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('student-count').innerHTML = `<p class="estudiantes-estadisticas">Total de estudiantes: <span>${data.total_students}</span></p>`;
        document.getElementById('students-this-week').innerHTML = `<p class="estudiantes-estadisticas">Estudiantes ingresados esta semana: <span>${data.students_this_week}</span></p>`;
        document.getElementById('students-this-month').innerHTML = `<p class="estudiantes-estadisticas">Estudiantes ingresados este mes: <span>${data.students_this_month}</span></p>`;
        renderStudentChart(data);
        renderCourseChart(data);
    })
    .catch(error => console.error('Error:', error));
}