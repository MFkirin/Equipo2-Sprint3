"use strict";

function main(){
        $(document).ready(function() {
            var estado = false;

            $('tr').on('click', function () {

                if (estado == true) {
                    $(this).find('.noshow').css({
                        "display": "inline"
                    });
                    estado = false;
                } else {
                    $(this).find(".noshow").css({
                        "display": "none"
                    });
                    estado = true;
                }
            });
        });
}

document.addEventListener('DOMContentLoaded',main);