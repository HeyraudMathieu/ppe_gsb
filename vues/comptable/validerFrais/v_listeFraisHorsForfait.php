<?php
/**
 * Vue Liste des frais hors forfait
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
                $id = $unFraisHorsForfait['id']; ?>           
                <tr class="fraisHorsForfait">
                    <td>
                        <input type="text" id="idFrais_<?php echo $id ?>_date" 
                               name="lesFraisHorsForfait[<?php echo $idFrais ?>_date]"
                               value="<?php echo $date ?>" 
                               data-valueInitial ="<?php echo $date ?>"
                               class="form-control fraisHorsForfait_<?php echo $id ?>">
                    </td>
                    <td>
                        <input type="text" id="idFrais_<?php echo $id ?>_libelle" 
                               name="lesFraisHorsForfait[<?php echo $idFrais ?>_libelle]"
                               value="<?php echo $libelle ?>"
                               data-valueInitial ="<?php echo $libelle ?>"
                               class="form-control fraisHorsForfait_<?php echo $id ?>">
                    </td>
                    <td>
                        <input type="text" id="idFrais_<?php echo $id ?>_montant" 
                               name="lesFraisHorsForfait[<?php echo $idFrais ?>_montant]"
                               value="<?php echo $montant ?>"
                               data-valueInitial ="<?php echo $montant ?>"
                               class="form-control fraisHorsForfait_<?php echo $id ?>">
                    </td>
                    <td>
                        <button class="btn btn-warning" type="button" onclick="annule_modifications_horsforfait(<?php echo $id ?>)">Annuler les modifications</button>
                        <button id="btn_suppr_horsforfait" class="btn btn-danger" type="button" onclick="supprime_fraishorsforfait(<?php echo $id ?>)">Supprimer le frais</button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>
<button class="btn btn-success" type="button">Valider la fiche</button>

<script>
        
    $(function(){
       
       $('.fraisHorsForfait input').on('input', function(){
          $(this).css('background-color','lightgreen');
       });
       
    });
    
    function annule_modifications_horsforfait(num_ligne){
        $('.fraisHorsForfait_' + num_ligne).each(function(){
            $(this).val($(this).attr('data-valueInitial'));
            $(this).css('background-color','white');
        });
        $('#btn_suppr_horsforfait').attr('disabled',false);
    }
    
    function supprime_fraishorsforfait(num_ligne){
        $('.fraisHorsForfait_' + num_ligne).css('background-color', 'red');
        let libelle = $('#idFrais_' + num_ligne + '_libelle').val();
        $('#idFrais_' + num_ligne + '_libelle').val('[SUPPRIME]' + libelle);
        $('#btn_suppr_horsforfait').attr('disabled',true);
    }
    
</script>