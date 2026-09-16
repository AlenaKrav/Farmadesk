document.addEventListener("DOMContentLoaded", function () {
    window.confirmarBorrado = function (e, id) {
        e.preventDefault();

        let currentURL = window.location.href;

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Este registro será eliminado permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = currentURL + '/borrar?id=' + id;
                return true;
            } else {
                return false;
            }
        });
    };
});

