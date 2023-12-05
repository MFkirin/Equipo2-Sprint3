$(document).ready(function(){
    $("#providerSearcher").on("keyup", function() {
        const value = $(this).val().toLowerCase();
        $("#providerTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});