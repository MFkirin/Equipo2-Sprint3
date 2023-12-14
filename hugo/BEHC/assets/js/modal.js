$(document).ready(function () {


    // Manejar clics en el enlace de eliminación
    $('.delete-link').click(function (e) {
        // Mostrar el modal de confirmación
        $('#confirmDeleteModal').modal('show');

        // Obtener el ID del proveedor a eliminar desde el atributo de datos
        const providerId = $(this).data('id');

        // Configurar el botón de confirmación en el modal
        $('#confirmDeleteBtn').off('click').on('click', function () {
            // Realizar la eliminación utilizando AJAX
            eliminarProveedor(providerId);
            $('#confirmDeleteModal').modal('hide'); // Ocultar el modal después de la confirmación
        });


    });

    // Agregar aquí la función eliminarProveedor(providerId) que te proporcioné anteriormente
    function eliminarProveedor(providerId) {
        // Realizar la solicitud AJAX para eliminar el proveedor
        $.ajax({
            url: '/provider_delete_process.php',
            method: 'POST',
            data: { id: providerId },
            success: function (response) {

                // Obtener la fila de la tabla correspondiente al proveedor eliminado
                const filaAEliminar = $('#providerTable').find('[data-id="' + providerId + '"]').closest('tr');

                // Desvanecer la fila y luego eliminarla del DOM
                filaAEliminar.fadeOut('slow', function() {
                    $(this).remove();
                });
            },
            error: function (error) {
                console.error('Error al eliminar proveedor:', error);
            }
        });
    }
});
