document.addEventListener('DOMContentLoaded', () => {
    const studentId = new URLSearchParams(window.location.search).get('id');
    if (studentId) loadStudentData(studentId);
});

async function loadStudentData(studentId) {
    try {
        const response = await fetch(`../editar-estudiantes.php?id=${studentId}`);
        const data = await response.json();
        
        if (data.success) {
            populateForm(data.student);
            storeOriginalData(data.student);
        } else {
            showModal('Error', 'Error al cargar los datos del estudiante', 'error');
        }
    } catch (error) {
        console.error('Error al cargar los datos del estudiante:', error);
        showModal('Error', 'Se produjo un error al cargar los datos del estudiante', 'error');
    }
}

function populateForm(student) {
    const fields = ['id', 'cedula', 'nombre', 'apellido', 'telefono', 'fecha_ingreso', 'carrera'];
    fields.forEach(field => {
        const element = document.getElementById(field === 'id' ? 'studentId' : field);
        if (field === 'carrera' && element.tagName === 'SELECT') {
            // Ensure that the option exists before selecting it
            const option = Array.from(element.options).find(opt => opt.value === student[field]);
            if (option) {
                element.value = student[field];
            }
        } else {
            element.value = student[field];
        }
    });
}

function storeOriginalData(student) {
    const originalData = document.getElementById('originalData');
    ['cedula', 'nombre', 'apellido', 'telefono', 'fecha_ingreso', 'carrera'].forEach(field => {
        originalData.dataset[`original${capitalizeFirstLetter(field)}`] = student[field];
    });
}

document.getElementById('editForm').addEventListener('submit', async function(event) {
    event.preventDefault();
    
    if (!hasChanges()) {
        showModal('Error', 'No se han editado los datos', 'error');
        return;
    }

    try {
        const response = await fetch(this.action, {
            method: this.method,
            body: new FormData(this)
        });
        const data = await response.json();
        
        if (data.success) {
            showModal('Éxito', 'Estudiante editado con éxito', 'success', () => {
                window.location.href = 'estudiantes.php';
            });
        } else {
            showModal('Error', data.message || 'Error al editar el estudiante', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showModal('Error', 'Se produjo un error al intentar editar el estudiante', 'error');
    }
});

function hasChanges() {
    const originalData = document.getElementById('originalData').dataset;
    const fields = ['cedula', 'nombre', 'apellido', 'telefono', 'fecha_ingreso', 'carrera'];
    return fields.some(field => 
        document.getElementById(field).value !== originalData[`original${capitalizeFirstLetter(field)}`]
    );
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function showModal(title, message, type, callback) {
    const modal = document.getElementById("modal-registro-exitoso");
    const span = modal.querySelector(".cerrar");
    const modalContent = modal.querySelector(".modal-contenido p");

    const icon = type === "success" ? "ti ti-circle-check" : "ti ti-alert-circle";
    const iconClass = type === "success" ? "icono-exito" : "icono-error";

    modalContent.innerHTML = `
        <div class="modal-icono ${iconClass}"><i class="${icon}"></i></div>
        <div class="modal-texto">
            <h3>${title}</h3>
            <p>${message}</p>
        </div>
    `;
    modal.style.display = "block";

    const closeModal = () => {
        modal.style.display = "none";
        if (callback) callback();
    };

    span.onclick = closeModal;
    window.onclick = (event) => {
        if (event.target === modal) closeModal();
    };
}
