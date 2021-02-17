<?php
/**
 * Gestion du suivi de paiement
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Rémy BENALOUANE <remybenalouane.fr>
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {    
    case 'selectionnerVisiteurMois':
        $lesVisiteurs = $pdo->getLesVisiteursParEtatFiche('VA');
        include 'vues/comptable/suivrePaiement/v_listeVisiteurMois.php';
        break;
        
    case 'recupereMois':
        $num_erreur = 0;
        $str_erreur = '';
        $str_idVisiteur = filter_input(INPUT_POST, 'str_idVisiteur', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($str_idVisiteur, 'VA');
        $response = array();
        foreach($lesMois as $unMois){
            $response[] = array('valeur'=>$unMois['mois'], 'label'=>$unMois['numMois'] . '/' . $unMois['numAnnee']);
        }
        retourAjax($response, $num_erreur, $str_erreur);
        break;

    case 'afficheFichesSuivrePaiement':
        $str_idVisiteur = filter_input(INPUT_POST, 'str_idVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($str_idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($str_idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($str_idVisiteur, $leMois);
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        include 'vues/comptable/validerFrais/v_listeFraisForfait.php';
        include 'vues/comptable/validerFrais/v_listeFraisHorsForfait.php';
        break;
    
}