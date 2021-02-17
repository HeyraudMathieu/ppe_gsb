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
                <input list="visiteur_fiche_CR" id="visiteur" name="idVisiteur" data-value=""/>
                <datalist id="visiteur_fiche_CR">
                    <?php 
                    foreach($lesVisiteurs as $unVisiteur){
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prennom = $unVisiteur['prenom'];
                    ?>
                    <option value="<?php echo $nom . ' ' . $prennom ?>" data-value="<?php echo $id ?>">
                    <?php } ?>
                </datalist>
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
<div id="lesFrais"></div>
<script>
    $(function(){
        
        grise_mois();
        
        $('#visiteur').on('input',function (){
            //$('#moisFichesFraisVisiteur').empty();
            //$('#visiteur').attr('value', '');
            //grise_mois();
            let text = $(this).val();
            $('#visiteur_fiche_CR').find('option').each(function(){
                if($(this).val() == text){
                    $('#visiteur').attr('data-value',$(this).attr('data-value'));
                    recupere_mois();
                }
            })
            
        });
        
        $('#moisFichesFraisVisiteur').on('change', function (){
            affiche_frais();
        });
    });
    
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
                ajax: true,
                str_idVisiteur: $('#visiteur').attr('data-value')
            },
            success: function(data){
                $('#moisFichesFraisVisiteur').empty();
                $('#moisFichesFraisVisiteur').append($('<option>', { 
                        value: '',
                        text : '' 
                    }));
                $.each(data.response, function (i, item) {
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
                    ajax: true,
                    str_idVisiteur: $('#visiteur').attr('data-value'),
                    str_mois: $('#moisFichesFraisVisiteur').val()
                },
                success: function(data){
                    $('#lesFrais').empty();
                    $('#lesFrais').append(data);
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