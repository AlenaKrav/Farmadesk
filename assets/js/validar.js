document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        let nombreRegex = /^[A-Za-zÁáÉéÍíÓóÚúÑñÜü\s'-]+$/;
        let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        let tlfRegex = /(\+34)?[6-9]\d{8}/;

        let nombre = document.getElementById("nombre").value;
        let email = document.getElementById("email").value;
        let telefono = document.getElementById("telefono").value;
        let mensaje = document.getElementById("mensaje").value;

        let errorNombre = document.querySelector("#nombre + .error");
        let errorEmail = document.querySelector("#email + .error");
        let errorTelefono = document.querySelector("#telefono + .error");
        let errorMensaje = document.querySelector("#mensaje + .error");

        function validarNombre() {
            if (!nombreRegex.test(nombre)) {
                errorNombre.innerText = "El nombre solo puede contener caracteres válidos.";
                errorNombre.style.display = "flex";
                actualizarEstado(document.getElementById("nombre"), "is-valid", "is-invalid");
                return false;
            } else {
                errorNombre.innerText = "";
                actualizarEstado(document.getElementById("nombre"), "is-invalid", "is-valid");
                return true;
            }
        }

        function validarEmail() {
            if (!emailRegex.test(email)) {
                errorEmail.innerText = "Por favor ingresa un correo electrónico válido.";
                errorEmail.style.display = "flex";
                actualizarEstado(document.getElementById("email"), "is-valid", "is-invalid");
                return false;
            } else {
                errorEmail.innerText = "";
                actualizarEstado(document.getElementById("email"), "is-invalid", "is-valid");
                return true;
            }
        }

        function validarTelefono() {
            if (!tlfRegex.test(telefono)) {
                errorTelefono.innerText = "Por favor ingresa un teléfono válido.";
                errorEmail.style.display = "flex";
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

        let nombreValido = validarNombre();
        let emailValido = validarEmail();
        let tlfValido = validarTelefono();
        let msjValido = validarMensaje();

        if (nombreValido && emailValido && tlfValido && msjValido) {
            console.log("Formulario enviado");
            setTimeout(function () {
                document.getElementById("contactForm").submit();
            }, 100);
        } else {
            alert("Por favor, corrige los errores antes de enviar.");
        }
    });
});

function actualizarEstado(elemento, claseRemove, claseAdd) {
    elemento.classList.remove(claseRemove);
    elemento.classList.add(claseAdd);
}
