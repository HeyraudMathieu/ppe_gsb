<?php

/**
 * Permet l'autocomplete sur un input en passant en paramètre par $_POST :
 * $_POST['input'] -> le début de saisie de l'utilisateur dans l'input, 
 * $_POST['nomFonctionPdo'] -> le nom de la fonction de la classe '/includes/class.pdogsb.inc.php' utilisé,
 * $_POST['valeur'] -> le/les nom(s) de colonne(s) voulu en retour associé a la clé 'valeur' de notre tableau json,
 * $_POST['label'] -> le/les nom(s) de colonne(s) voulu en retour associé a la clé 'label' de notre tableau json.
 * 
 * retourne un tableau json { valeur : , label: } 
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

require 'class.pdogsb.inc.php';

$pdo = PdoGsb::getPdoGsb();

foreach($_POST as $cle=>$val){
    $$cle = $val;
}

if($input){
    $lengthLabel = count($label);
    $lesLignes = $pdo->$nomFonctionPdo($input);
    $response = array();
    foreach($lesLignes as $uneLigne){
        $uneLigneLabel = $uneLigne;
        if($lengthLabel == 1){
            $uneLigneLabel = $uneLigne[$label[0]];
        }elseif($lengthLabel > 1) {
            $uneLigneLabel = $uneLigne[$label[0]] . $label[1] . $uneLigne[$label[2]];
        } elseif($lengthLabel > 3) {
            $uneLigneLabel = $uneLigne[$label[0]] . $label[1] . $uneLigne[$label[2]] . $label[3] . $uneLigne[$label[4]];
        }
        $response[] = array('valeur'=>$uneLigne[$valeur], 'label'=>$uneLigneLabel);
    }
    echo json_encode($response);
}