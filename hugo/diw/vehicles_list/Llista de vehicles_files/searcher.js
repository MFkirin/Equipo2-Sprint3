$(document).ready(function () {
    // Input filtering
    $(".table-searcher-input").on('input', function () {
        filterTable();
    });

    // Table row toggling
    $("#invoices-table tbody tr").each(function () {
        // Ocultar todos los td excepto el primero solo en dispositivos móviles
        if (window.matchMedia("(max-width: 767px)").matches) {
            $(this).find("td:not(:first-child)").hide();
        }
    });

    // Toggle en clic de fila, excepto en el botón
    $("#invoices-table tbody tr").click(function (event) {
        if (!$(event.target).is("button")) {
            // Utilizar slideToggle solo en dispositivos móviles
            if (window.matchMedia("(max-width: 767px)").matches) {
                $(this).find("td:not(:first-child)").slideToggle();
            }
        }
    });

    function filterTable() {
        var filter = $(".table-searcher-input").val().toUpperCase();
        $("#invoices-table tbody tr").each(function () {
            var rowVisible = false;

            // Verificar cada celda en la fila
            $(this).find("td").each(function () {
                var cellText = $(this).text();
                if (cellText.toUpperCase().indexOf(filter) > -1) {
                    rowVisible = true;
                    return false; // Romper el bucle si se encuentra una coincidencia en cualquier celda
                }
            });

            if (rowVisible)
                $(this).show();
            else
                $(this).hide();
        });
    }
});
