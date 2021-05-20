<?php
/**
 * Vue Liste des frais au forfait
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<div class="form-group">
    <form id="formValiderFiche" method="post" 
          action="index.php?uc=validerFrais&action=validerFrais"
          role="form">
        <div class="row">
            <h3>Eléments forfaitisés</h3>
            <div class="col-md-4">
                <fieldset>       
                    <?php
                    foreach ($lesFraisForfait as $unFrais) {
                        $idFraisForfait = $unFrais['idfrais'];
                        $libelle = htmlspecialchars($unFrais['libelle']);
                        $quantite = $unFrais['quantite'];
                        ?>
                        <div class="form-group">
                            <label for="idFrais"><?php echo $libelle ?></label>
                            <input type="number" id="idFrais_<?php echo $idFraisForfait ?>" 
                                   name="lesFraisForfait[<?php echo $idFraisForfait ?>]"
                                   size="10" maxlength="5" 
                                   value="<?php echo $quantite ?>"
                                   data-valueInitial="<?php echo $quantite ?>"
                                   class="form-control fraisForfait">
                        </div>
                        <?php
                    }
                    ?>
                    <button class="btn btn-warning" type="button" onclick="annule_modifications_forfait()">Annuler les modifications</button>
                </fieldset>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Descriptif des éléments hors forfait</div>
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="date">Date</th>
                            <th class="libelle">Libellé</th>  
                            <th class="montant">Montant</th>  
                            <th class="action">&nbsp;</th> 
                        </tr>
                    </thead>  
                    <tbody>
                        <?php
                        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                            $date = $unFraisHorsForfait['date'];
                            $montant = $unFraisHorsForfait['montant'];
                            $idFraisHorsForfait = $unFraisHorsForfait['id'];
                            ?>           
                            <tr class="fraisHorsForfait">
                                <td>
                                    <input type="text" id="idFrais_<?php echo $idFraisHorsForfait ?>_date" 
                                           name="lesFraisHorsForfait[<?php echo $idFraisHorsForfait ?>][date]"
                                           value="<?php echo $date ?>" 
                                           data-valueInitial ="<?php echo $date ?>"
                                           class="form-control fraisHorsForfait_<?php echo $idFraisHorsForfait ?>">
                                </td>
                                <td>
                                    <input type="text" id="idFrais_<?php echo $idFraisHorsForfait ?>_libelle" 
                                           name="lesFraisHorsForfait[<?php echo $idFraisHorsForfait ?>][libelle]"
                                           value="<?php echo $libelle ?>"
                                           data-valueInitial ="<?php echo $libelle ?>"
                                           class="form-control fraisHorsForfait_<?php echo $idFraisHorsForfait ?>">
                                </td>
                                <td>
                                    <input type="number" id="idFrais_<?php echo $idFraisHorsForfait ?>_montant" 
                                           name="lesFraisHorsForfait[<?php echo $idFraisHorsForfait ?>][montant]"
                                           value="<?php echo $montant ?>"
                                           data-valueInitial ="<?php echo $montant ?>"
                                           class="form-control fraisHorsForfait_<?php echo $idFraisHorsForfait ?>">
                                </td>
                                <td>
                                    <button class="btn btn-warning" type="button" onclick="annule_modifications_horsforfait(<?php echo $idFraisHorsForfait ?>)">Annuler les modifications</button>
                                    <button id="btn_suppr_horsforfait_<?php echo $idFraisHorsForfait ?>" class="btn btn-danger" type="button" onclick="supprime_fraishorsforfait(<?php echo $idFraisHorsForfait ?>)">Supprimer le frais</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>  
                </table>
            </div>
        </div>
        <input type="submit" value="Valider la fiche" class="btn btn-success" 
               role="button">
    </form>
</div>

<script>

    $(function () {

        $('#leVisiteur').val($('#visiteur').attr('data-value'));
        $('#leMois').val($('#moisFichesFraisVisiteur').val());

        $('.fraisForfait').on('input', function () {
            $(this).css('background-color', 'lightgreen');
            $('#fraisForfaitIsModif').val('O');
        });

        $('.fraisHorsForfait input').on('input', function () {
            $(this).css('background-color', 'lightgreen');
        });

    });

    function annule_modifications_forfait() {
        $('.fraisForfait').each(function () {
            $(this).val($(this).attr('data-valueInitial'));
            $(this).css('background-color', 'white');
        });
        $('#fraisForfaitIsModif').val('N');
    }

    function annule_modifications_horsforfait(num_ligne) {
        $('.fraisHorsForfait_' + num_ligne).each(function () {
            $(this).val($(this).attr('data-valueInitial'));
            $(this).css('background-color', 'white');
        });
        $('#btn_suppr_horsforfait_' + num_ligne).attr('disabled', false);
    }

    function supprime_fraishorsforfait(num_ligne) {
        $('.fraisHorsForfait_' + num_ligne).css('background-color', 'red');
        let libelle = $('#idFrais_' + num_ligne + '_libelle').val();
        $('#idFrais_' + num_ligne + '_libelle').val('[SUPPRIME]' + libelle);
        $('#btn_suppr_horsforfait_' + num_ligne).attr('disabled', true);
    }

    $('#formValiderFiche').submit(function () {
        event.preventDefault();
        var form = $(this)[0];
        var formData = new FormData(form);
        let lesFraisForfait = [];
        for(var pair of formData.entries()) {
            if(pair[0].toString().indexOf("lesFraisForfait") === 0){
                lesFraisForfait += pair[0];
            }
        }
        console.log(lesFraisForfait);
    });


</script>