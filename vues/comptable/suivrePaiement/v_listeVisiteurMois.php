<?php

/**
 * Vue Liste Visiteur Mois
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Rémy BENALOUANE
 */
?>
<h2>
    Suivre le paiement des fiches de frais
</h2>
<div id="lesErreurs"></div>
<div class="row">
    <div class="form-group col-md-12" style="line-height:2.2;">
        <div class="col-md-4">
            <label for="visiteur" class="col-md-6">Choisir le visiteur : </label>
            <div class="col-md-6">
                <input list="visiteur_fiche_VA" id="visiteur" name="idVisiteur"/>
                <datalist id="visiteur_fiche_VA">
                    <?php 
                    foreach($lesVisiteurs as $unVisiteur){
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                    ?>
                    <option value="<?php echo $nom . ' ' . $prenom ?>" data-value="<?php echo $id ?>">
                    <?php } ?>
                </datalist>
            </div>
        </div>
        <div class="col-md-4">
            <label for="mois" class="col-md-3">Mois : </label>
            <div class="col-md-5">
                <select id="moisFichesSuivrePaiement" class="form-control" name="mois">
                </select>
            </div>
        </div>
    </div>
</div>
<div id="lesFichesSuivies"></div>
<script>
    $(function(){
        
        grise_mois();
        
        $('#visiteur').on('input',function (){
            //$('#moisFichesFraisVisiteur').empty();
            //$('#visiteur').attr('value', '');
            //grise_mois();
            let text = $(this).val();
            $('#visiteur_fiche_VA').find('option').each(function(){
                if($(this).val() == text){
                    $('#visiteur').attr('data-value',$(this).attr('data-value'));
                    recupere_mois();
                }
            })
            
        });
        
        $('#moisFichesSuivrePaiement').on('change', function (){
            affiche_fiches_suivies();
        });
    });
    
    function grise_mois(){
        $('#moisFichesSuivrePaiement').attr('disabled',true);
    }
    
    function degrise_mois(){
        $('#moisFichesSuivrePaiement').attr('disabled',false);
    }
    
    function recupere_mois(){
        $.ajax({
            type: "POST",
            url: "index.php?uc=suivrePaiement&action=recupereMois",
            dataType: "json",
            data: {
                ajax: true,
                str_idVisiteur: $('#visiteur').attr('data-value'),
            },
            success: function(data){
                $('#moisFichesSuivrePaiement').empty();
                $('#moisFichesSuivrePaiement').append($('<option>', { 
                        value: '',
                        text : '' 
                    }));
                $.each(data.response, function (i, item) {
                    $('#moisFichesSuivrePaiement').append($('<option>', { 
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
    
    function affiche_fiches_suivies(){
        if($('#moisFichesSuivrePaiement').val() !== "" && $('#moisFichesSuivrePaiement').val() !== null){
            $.ajax({
                type: "POST",
                url: "index.php?uc=suivrePaiement&action=afficheFichesSuivrePaiement",
                dataType: "html",
                data: {
                    ajax: true,
                    str_idVisiteur: $('#visiteur').attr('data-value'),
                    str_mois: $('#moisFichesSuivrePaiement').val()
                },
                success: function(data){
                    $('#lesFichesSuivies').empty();
                    $('#lesFichesSuivies').append(data);
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