$(document).ready(function () {
    $('#paciente_id').on('keyup', function () {
        let term = $(this).val();
        if (term.length > 0) {
            $.ajax({
                url: '/farma/admin/pacientes/sugerencias',
                method: 'GET',
                data: { term: term },
                success: function (data) {
                    let resultados = data;
                    let html = '';
                    $('#sugerencias').removeClass("desactivado").html('');
                    if (resultados.length === 0) {
                        html = '<div class="desactivado">No hay sugerencias</div>';
                        $('#sugerencias').html(html).show().addClass("desactivado");

                    }
                    else {
                        resultados.forEach(function (paciente) {
                            html += `<div class="sugerencia" data-id="${paciente.id_paciente}">${paciente.nombre_completo}</div>`;
                        });
                        $('#sugerencias').html(html).show();
                        console.log(data);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al obtener sugerencias: ' + error);
                    $('#sugerencias').html('<div class="desactivado">Error al cargar sugerencias</div>').show().addClass("desactivado");
                }

            });
        } else {
            $('#sugerencias').hide();
        }
    });

    $(document).on('click', '.sugerencia', function () {
        let id = $(this).data('id');
        $('#paciente_id').val(id);
        $('#sugerencias').hide();
    });

});