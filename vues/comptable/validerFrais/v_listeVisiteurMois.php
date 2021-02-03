<?php

/**
 * Vue Liste Visiteur Mois
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Mathieu HEYRAUD <matheyraud@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<h2>
    Validation de la fiche de frais
</h2>
<div id="lesErreurs"></div>
<div class="row">
    <div class="form-group col-md-12" style="line-height:2.2;">
        <div class="col-md-4">
            <label for="visiteur" class="col-md-6">Choisir le visiteur : </label>
            <div class="col-md-6">
                <input type="text" id="visiteur" class="form-control" name="idVisiteur">
            </div>
        </div>
        <div class="col-md-4">
            <label for="mois" class="col-md-3">Mois : </label>
            <div class="col-md-5">
                <select id="moisFichesFraisVisiteur" class="form-control" name="mois">
                </select>
            </div>
        </div>
    </div>
</div>
<div id="lesFraisAValider"></div>
<script>
    $(function(){
        
        // permet de gérer l'autocomplete de l'input d'id 'visiteur'
        autocomplete('visiteur', 'getLesVisiteursLike', 'id', ['nom',' ', 'prenom']);
        
        grise_mois();
        
        $('#visiteur').on('input',function (){
            $('#moisFichesFraisVisiteur').empty();
            $('#visiteur').attr('value', '');
            grise_mois();
        });
        
        $('#moisFichesFraisVisiteur').on('change', function (){
            affiche_frais();
        });
    });
    
    function autocomplete_select(event, ui){
        $('#visiteur').val(ui.item.label);
        $('#visiteur').attr('value', ui.item.valeur);
        recupere_mois();
        return false;
    }
    
    function grise_mois(){
        $('#moisFichesFraisVisiteur').attr('disabled',true);
    }
    
    function degrise_mois(){
        $('#moisFichesFraisVisiteur').attr('disabled',false);
    }
    
    function recupere_mois(){
        $.ajax({
            type: "POST",
            url: "index.php?uc=validerFrais&action=recupereMois",
            dataType: "json",
            data: {
                idVisiteur: $('#visiteur').attr('value')
            },
            success: function(data){
                $('#moisFichesFraisVisiteur').empty();
                $('#moisFichesFraisVisiteur').append($('<option>', { 
                        value: '',
                        text : '' 
                    }));
                $.each(data, function (i, item) {
                    $('#moisFichesFraisVisiteur').append($('<option>', { 
                        value: item.valeur,
                        text : item.label 
                    }));
                });
                degrise_mois();
            },
            error: function (xhr, thrownError) {
                console.log(xhr.statusText);
                console.log(xhr.responseText);
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
    
    function affiche_frais(){
        if($('#moisFichesFraisVisiteur').val() !== "" && $('#moisFichesFraisVisiteur').val() !== null){
            $.ajax({
                type: "POST",
                url: "index.php?uc=validerFrais&action=afficheFrais",
                dataType: "html",
                data: {
                    idVisiteur: $('#visiteur').attr('value'),
                    mois: $('#moisFichesFraisVisiteur').val()
                },
                success: function(data){
                    $('#lesFraisAValider').empty();
                    $('#lesFraisAValider').append(data);
                },
                error: function (xhr, thrownError) {
                    console.log(xhr.statusText);
                    console.log(xhr.responseText);
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
    }
    
</script>