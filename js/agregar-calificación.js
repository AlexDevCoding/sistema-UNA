document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.getElementById("formulario-registro");

    formulario.addEventListener("submit", async (event) => {
        event.preventDefault(); // Evitar la acción predeterminada del formulario

        const datos = new FormData(formulario); // Obtener los datos del formulario

        try {
            // Enviar los datos al servidor
            const respuesta = await fetch("../registrar-calificacion.php", {
                method: "POST",
                body: datos,
            });

            // Convertir la respuesta a formato JSON
            const jsonRespuesta = await respuesta.json();

            if (respuesta.ok && jsonRespuesta.estado === "success") {
                mostrarModal("Éxito", jsonRespuesta.mensaje, "success"); // Mostrar modal de éxito
                formulario.reset(); // Resetear el formulario
            } else {
                mostrarModal("Error", jsonRespuesta.mensaje, "error"); // Mostrar modal de error
            }
        } catch (error) {
            mostrarModal("Error de Conexión", `Error al conectar con el servidor: ${error.message}`, "error"); // Mostrar error de conexión
        }
    });
});

function mostrarModal(title, message, type) {
    const modal = document.getElementById("modal-registro-exitoso");
    const span = document.createElement("span");
    span.className = "cerrar";
    span.innerHTML = "&times;";

    const modalContent = document.querySelector(".modal-contenido");

    let icon = "";
    let iconClass = "";

    if (type === "success") {
        icon = "ti ti-circle-check"; 
        iconClass = "icono-exito"; 
    } else if (type === "error") {
        icon = "ti ti-alert-circle"; 
        iconClass = "icono-error"; 
    }

    modalContent.innerHTML = `
        <div class="modal-icono ${iconClass}"><i class="${icon}"></i></div>
        <div class="modal-texto">
            <h3>${title}</h3>
            <p>${message}</p>
        </div>
    `;
    modalContent.appendChild(span);

    modal.style.display = "block";

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
