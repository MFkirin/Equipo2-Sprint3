"use strict";

function main(){
    $(document).ready(function(){
        $("#inputBuscador").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#providers tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#providerList").tablesorter();
        $("table th").click(function (){
               if ($(this).hasClass("tablesorter-headerAsc")) {
                   $(this).find("div>img").attr("src","/assets/img/caret-arriba.png");
               }else if ($(this).hasClass("tablesorter-headerDesc")){
                   $(this).find("div>img").attr("src","/assets/img/caret-abajo.png");
               }
        });
    });


}
document.addEventListener('DOMContentLoaded',main);