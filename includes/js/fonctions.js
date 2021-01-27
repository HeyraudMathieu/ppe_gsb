/**
 * Fonctions javascript globales pouvant être utilisées par les vues de l'application
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Mahieu HEYRAUD <matheyraud@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

/**
 * Fonction qui permet l'autcomplete sur un input
 * 
 * @param {type} idInput
 * @param {type} nomFonctionPdo
 * @param {type} valeur
 * @param {type} label
 * @returns {undefined}
 */
function autocomplete(idInput, nomFonctionPdo, valeur, label){
        $("#" + idInput).autocomplete({
            source : function( request, response ) {
                $.ajax({
                    type: "POST",
                    url: "/includes/autocomplete.php",
                    dataType: "json",
                    data: {
                        input: request.term,
                        nomFonctionPdo: nomFonctionPdo,
                        valeur: valeur,
                        label: label
                    },
                    success: function(data){
                        response(data);
                    },
                    error: function (xhr, thrownError) {
                        alert(xhr.statusText);
                        alert(xhr.responseText);
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            },
            select: function (event, ui) {
                // Action effectuée lors de la sélection d'un élément de l'autocomplete
                // fonction à écrire sur la vue utilisant la fonction autocomplete
                autocomplete_select(event, ui);
            }
        });
    }
