document.addEventListener("DOMContentLoaded", function () {
    // Añadir el evento al formulario
    document.getElementById("contactForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Evitar el envío inmediato del formulario

        // Expresiones regulares para las validaciones
        let nombreRegex = /^[A-Za-zÁáÉéÍíÓóÚúÑñÜü\s'-]+$/;
        let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        let tlfRegex = /(\+34)?[6-9]\d{8}/;

        // Obtener valores de los campos del formulario
        let nombre = document.getElementById("nombre").value;
        let email = document.getElementById("email").value;
        let telefono = document.getElementById("telefono").value;
        let mensaje = document.getElementById("mensaje").value;

        // Obtener referencias a los contenedores de error
        let errorNombre = document.querySelector("#nombre + .error");
        let errorEmail = document.querySelector("#email + .error");
        let errorTelefono = document.querySelector("#telefono + .error");
        let errorMensaje = document.querySelector("#mensaje + .error");

        // Funciones de validación
        function validarNombre() {
            if (nombre === "") {
                errorNombre.innerText = "El nombre no puede ir vacío.";
                actualizarEstado(document.getElementById("nombre"), "is-valid", "is-invalid");
                return false;
            } else if (!nombreRegex.test(nombre)) {
                errorNombre.innerText = "El nombre solo puede contener caracteres válidos.";
                actualizarEstado(document.getElementById("nombre"), "is-valid", "is-invalid");
                return false;
            } else {
                errorNombre.innerText = "";
                actualizarEstado(document.getElementById("nombre"), "is-invalid", "is-valid");
                return true;
            }
        }

        function validarEmail() {
            if (email === "") {
                errorEmail.innerText = "El email no puede ir vacío.";
                actualizarEstado(document.getElementById("email"), "is-valid", "is-invalid");
                return false;
            } else if (!emailRegex.test(email)) {
                errorEmail.innerText = "Por favor ingresa un correo electrónico válido.";
                actualizarEstado(document.getElementById("email"), "is-valid", "is-invalid");
                return false;
            } else {
                errorEmail.innerText = "";
                actualizarEstado(document.getElementById("email"), "is-invalid", "is-valid");
                return true;
            }
        }

        function validarTelefono() {
            if (telefono === "") {
                errorTelefono.innerText = "El teléfono no puede ir vacío.";
                actualizarEstado(document.getElementById("telefono"), "is-valid", "is-invalid");
                return false;
            } else if (!tlfRegex.test(telefono)) {
                errorTelefono.innerText = "Por favor ingresa un teléfono válido.";
                actualizarEstado(document.getElementById("telefono"), "is-valid", "is-invalid");
                return false;
            } else {
                errorTelefono.innerText = "";
                actualizarEstado(document.getElementById("telefono"), "is-invalid", "is-valid");
                return true;
            }
        }

        function validarMensaje() {
            if (mensaje === "") {
                errorMensaje.innerText = "El mensaje no puede ir vacío.";
                actualizarEstado(document.getElementById("mensaje"), "is-valid", "is-invalid");
                return false;
            } else {
                errorMensaje.innerText = "";
                actualizarEstado(document.getElementById("mensaje"), "is-invalid", "is-valid");
                return true;
            }
        }

        // Validar todos los campos
        let nombreValido = validarNombre();
        let emailValido = validarEmail();
        let tlfValido = validarTelefono();
        let msjValido = validarMensaje();

        // Verificar si todos los campos son válidos
        if (nombreValido && emailValido && tlfValido && msjValido) {
            // Si todo está bien, enviamos el formulario
            console.log("Formulario enviado");  // Imprime para verificar si pasa la validación
            // alert("Formulario enviado con éxito.");

            // Usamos setTimeout para enviar el formulario después de un pequeño retraso
            setTimeout(function() {
                document.getElementById("contactForm").submit();
            }, 100);  // 100ms de retraso, puedes aumentar este valor si es necesario
        } else {
            alert("Por favor, corrige los errores antes de enviar.");
        }
    });
});

// Función para actualizar las clases de los campos
function actualizarEstado(elemento, claseRemove, claseAdd) {
    elemento.classList.remove(claseRemove);
    elemento.classList.add(claseAdd);
}
