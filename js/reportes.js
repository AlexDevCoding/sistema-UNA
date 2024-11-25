document.addEventListener("DOMContentLoaded", () => {
    const estudiantesSelect = document.querySelector('select[name="reportes-estudiantes"]');
    const calificacionesSelect = document.querySelector('select[name="reportes-calificaciones"]');

    const estudiantesBtn = document.getElementById("generar-reporte-estudiantes");
    const calificacionesBtn = document.getElementById("generar-reporte-calificaciones");

    // Evento para manejar la selección de "Estudiantes"
    estudiantesSelect.addEventListener("change", () => {
        if (estudiantesSelect.value) {
            calificacionesSelect.disabled = true;
            calificacionesBtn.disabled = true;
        } else {
            calificacionesSelect.disabled = false;
            calificacionesBtn.disabled = false;
        }
    });

    // Evento para manejar la selección de "Calificaciones"
    calificacionesSelect.addEventListener("change", () => {
        if (calificacionesSelect.value) {
            estudiantesSelect.disabled = true;
            estudiantesBtn.disabled = true;
        } else {
            estudiantesSelect.disabled = false;
            estudiantesBtn.disabled = false;
        }
    });

    // Evento para generar reporte de estudiantes
    estudiantesBtn.addEventListener("click", async () => {
        const periodo = estudiantesSelect.value;
        if (!periodo) {
            alert("Por favor selecciona un período para el reporte de estudiantes.");
            return;
        }
        await generarPDF("estudiantes", periodo);
        resetFields(); // Restablecer campos
    });

    // Evento para generar reporte de calificaciones
    calificacionesBtn.addEventListener("click", async () => {
        const periodo = calificacionesSelect.value;
        if (!periodo) {
            alert("Por favor selecciona un período para el reporte de calificaciones.");
            return;
        }
        await generarPDF("calificaciones", periodo);
        resetFields(); // Restablecer campos
    });

    // Función para restablecer campos después de generar un reporte
    function resetFields() {
        estudiantesSelect.value = "";
        calificacionesSelect.value = "";
        estudiantesSelect.disabled = false;
        calificacionesSelect.disabled = false;
        estudiantesBtn.disabled = false;
        calificacionesBtn.disabled = false;
    }
});

// Función para generar el PDF (idéntica a la proporcionada anteriormente)
async function generarPDF(tipoReporte, periodo) {
    try {
        const url = `../obtener-reportes.php?tipo_reporte=${tipoReporte}&periodo=${periodo}`;
       

        const response = await fetch(url);

        if (!response.ok) {
            const errorText = await response.text();
            alert("Error al generar el reporte: " + response.statusText);
            return;
        }

        const data = await response.json();

        if (data.error) {
            alert(data.error);
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: "landscape", unit: "mm", format: "a4" });

        // Encabezado
        doc.setFillColor(0, 51, 153);
        doc.rect(0, 0, 297, 25, "F");
        doc.setFont("helvetica", "bold");
        doc.setFontSize(20);
        doc.setTextColor(255, 255, 255);
        doc.text(`Reporte de ${tipoReporte.toUpperCase()}`, 15, 15);

        doc.setFont("helvetica", "normal");
        doc.setFontSize(12);
        doc.setTextColor(80, 80, 80);
        doc.text(`Período: ${periodo}`, 15, 35);
        doc.text(`Fecha de generación: ${new Date().toLocaleDateString()}`, 15, 42);

        if (data.length > 0) {
            let y = 55;
            const headers = tipoReporte === "estudiantes"
                ? ["Nombre", "Apellido", "Edad", "Clase"]
                : ["Estudiante", "Materia", "Nota", "Fecha"];

            const columnWidths = tipoReporte === "estudiantes"
                ? [70, 70, 30, 90]
                : [70, 90, 40, 57];

            generarTabla(doc, data, headers, columnWidths, y);
        } else {
            doc.text("No hay datos disponibles para este reporte.", 15, 55);
        }

        const nombreArchivo = `Reporte_${tipoReporte}_${periodo}_${new Date().toISOString().split("T")[0]}.pdf`;
        doc.save(nombreArchivo);
    } catch (error) {
        alert("Error al generar el reporte: " + error.message);
    }
}

// Función para generar tablas (idéntica a la proporcionada anteriormente)
function generarTabla(doc, data, headers, columnWidths, startY) {
    let y = startY;
    let currentX = 15;

    doc.setFillColor(240, 240, 240);
    doc.rect(10, y - 7, 277, 10, "F");
    doc.setFont("helvetica", "bold");
    doc.setTextColor(60, 60, 60);
    doc.setFontSize(10);

    headers.forEach((header, index) => {
        doc.text(header.toUpperCase(), currentX, y);
        currentX += columnWidths[index];
    });

    doc.setFont("helvetica", "normal");
    doc.setTextColor(0, 0, 0);
    y += 10;

    data.forEach((row, rowIndex) => {
        if (y > 180) {
            doc.addPage();
            y = 30;
        }

        if (rowIndex % 2 === 0) {
            doc.setFillColor(249, 249, 249);
            doc.rect(10, y - 7, 277, 10, "F");
        }

        currentX = 15;
        Object.values(row).forEach((value, index) => {
            let texto = String(value);
            if (texto.length > 25) {
                texto = texto.substring(0, 22) + "...";
            }
            doc.text(texto, currentX, y);
            currentX += columnWidths[index];
        });
        y += 10;
    });
}
