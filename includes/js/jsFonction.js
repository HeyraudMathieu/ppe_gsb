// Toutes fonctions javascript à portée globale
var idDivNotification = 'notifications';

function ajoutNotification(num_erreur, str_message){
    $('#' + idDivNotification).show();
    $('#' + idDivNotification).css('text-align','center');
    if(num_erreur === 0){
        $('#' + idDivNotification).addClass('alert alert-success');
    } else {
        $('#' + idDivNotification).addClass('alert alert-danger');
    }
    $('#' + idDivNotification).val(str_message);
}


function enleveNotification(){
    $('#' + idDivNotification).removeClass();
    $('#' + idDivNotification).hide();
}