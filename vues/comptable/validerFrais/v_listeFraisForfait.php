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
<div class="row">
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="" 
              role="form">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais_<?php echo $idFrais ?>" 
                               name="lesFrais[<?php echo $idFrais ?>]"
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
        </form>
    </div>
</div>

<script>
        
    $(function(){
       
       $('.fraisForfait').on('input', function(){
          $(this).css('background-color','lightgreen');
       });
       
    });
    
    function annule_modifications_forfait(){
        $('.fraisForfait').each(function(){
            $(this).val($(this).attr('data-valueInitial'));
            $(this).css('background-color','white');
        });
    }
    
</script>