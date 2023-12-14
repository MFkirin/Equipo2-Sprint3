$(document).ready(function(){
    $("#providerSearcher").on("keyup", function() {
        const value = $(this).val().toLowerCase();
        $("#providerTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
$(document).ready(function(){
    $("#searcher").on("keyup", function() {
        const value = $(this).val().toLowerCase();
        console.log("algo");
        $(".item").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

