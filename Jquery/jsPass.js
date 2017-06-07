$(document).ready(inicio);

function inicio() {
    $("#cambiar_password").hide();
    $("#cambiar").click(function () {
        $("#cambiar_password").fadeToggle();
    });
}
