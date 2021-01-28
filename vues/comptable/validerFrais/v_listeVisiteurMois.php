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
<h2>Validation des fiches de frais</h2>
<div class="row">
    <div class="form-group col-md-12" style="line-height:2.2;">
        <div class="col-md-4">
            <label for="visiteur" class="col-md-6">Choisir le visiteur : </label>
            <div class="col-md-6">
                <input type="text" id="visiteur" class="form-control" name="visiteur">
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
<script>
    $(function(){
        
        autocomplete('visiteur', 'getLesVisiteursLike', 'id', ['nom',' ', 'prenom']);
        grise_mois();
        $('#visiteur').on('input',function (){
            $('#moisFichesFraisVisiteur').empty();
            $('#visiteur').attr('value', '');
            grise_mois();
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
                ajax : true,
                visiteur: $('#visiteur').attr('value')
            },
            success: function(data){
                $('#moisFichesFraisVisiteur').empty();
                $('#moisFichesFraisVisiteur').append($('<option>', { 
                        value: '',
                        text : ''
                    }));
                $.each(data, function (i, item) {
                    $('#moisFichesFraisVisiteur').append($('<option>', { 
                        value: item.value,
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
    
    
</script>