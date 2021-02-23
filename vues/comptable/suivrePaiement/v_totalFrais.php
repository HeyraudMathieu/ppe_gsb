<?php
/**
 * Vue Liste du total des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Rémy BENALOUANE <remybenalouane.fr>
 */
?>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Total des frais</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="total_ff">Frais forfait</th>
                    <th class="total_hf">Frais hors forfait</th>  
                    <th class="total">Total</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
                    <td> <?php echo $totalFraisForfait?>
                    </td>
                    <td> <?php echo $totalFraisHorsForfait?>
                    </td>
                    <td> <?php echo $totalFrais?>
                    </td>
                </tr>
            </tbody>  
        </table>
    </div>
</div>
<button class="btn btn-success" type="button" onclick="">Mise en paiement</button>