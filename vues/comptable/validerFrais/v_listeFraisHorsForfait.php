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
                <tr>
                    <td>
                        <input type="text" id="idFrais_<?php echo $id ?>_date" 
                               name="lesFraisHorsForfait[<?php echo $idFrais ?>_date]"
                               size="10" maxlength="5" 
                               value="<?php echo $date ?>" 
                               class="form-control">
                    </td>
                    <td>
                        <input type="text" id="idFrais_<?php echo $id ?>_libelle" 
                               name="lesFraisHorsForfait[<?php echo $idFrais ?>_libelle]"
                               size="10" maxlength="5" 
                               value="<?php echo $libelle ?>" 
                               class="form-control">
                    </td>
                    <td>
                        <input type="text" id="idFrais_<?php echo $id ?>_montant" 
                               name="lesFraisHorsForfait[<?php echo $idFrais ?>_montant]"
                               size="10" maxlength="5" 
                               value="<?php echo $montant ?>" 
                               class="form-control">
                    </td>
                    <td>
                        <button class="btn btn-warning" type="button">Annuler les modifications</button>
                        <button class="btn btn-danger" type="button">Supprimer le frais</button>
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