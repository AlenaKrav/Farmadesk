document.addEventListener("DOMContentLoaded", function () {
    window.confirmarBorrado = function (e, id) {
        // Evitar que la acción por defecto (redirigir) ocurra
        e.preventDefault();

        // Mostrar la alerta de confirmación usando SweetAlert
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Este registro será eliminado permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            // Si el usuario confirma, redirige para borrar
            if (result.isConfirmed) {
                // Cambiar la URL y redirigir al usuario para borrar el registro
                window.location.href = 'pacientes/borrar?id=' + id;
                return true;
            } else {
                return false;
            }
        });
    };
});

// Definimos la función en el ámbito global
// document.addEventListener("DOMContentLoaded", function () {
//     window.confirmarBorrado = function () {
//         alert("Funciona!");
//     };
// });


