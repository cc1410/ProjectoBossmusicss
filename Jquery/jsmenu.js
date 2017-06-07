$(document).ready(ini);

function ini(){
    $("#menu").hide();
    $("#divLogin").mouseenter(mostrarmenu);
    
}

function mostrarmenu(){
    $("#menu").css({"right": "-60px"});
    $("#menu").show();
    $("#menu").animate({"right" : "5px", "top":"70px"},600);
    $("#salida").click(escondermenu);
    
}

function escondermenu(){
    $("#menu").hide();
    
}