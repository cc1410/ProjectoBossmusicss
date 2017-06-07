$(document).ready(inicio);

function inicio() {
    $("#regLocal").hide();
    $("#regMusico").hide();
    $("#regFans").hide();
    $("#local").click(mostrarFormLocal);
    $("#musico").click(mostrarFormMusico);
    $("#fans").click(mostrarFormFans);
}

function mostrarFormLocal() {
    $("#regMusico").hide();
    $("#regFans").hide();
    $("#regLocal").fadeToggle();
}
function mostrarFormFans() {
    $("#regLocal").hide();
    $("#regMusico").hide();
    $("#regFans").fadeToggle();
}
function mostrarFormMusico() {
    $("#regLocal").hide();
    $("#regFans").hide();
    $("#regMusico").fadeToggle();
}


