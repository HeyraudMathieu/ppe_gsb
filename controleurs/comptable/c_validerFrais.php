<?php

/**
 * Gestion de la validation des fiches de frais
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

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case 'selectionnerVisiteurMois':
        include 'vues/comptable/validerFrais/v_listeVisiteurMois.php';
        break;
    case 'recupereMois':
        ob_clean();
        $idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $response = array();
        foreach($lesMois as $unMois){
            $response[] = array('valeur'=>$unMois['mois'], 'label'=>$unMois['numMois'] . '/' . $unMois['numAnnee']);
        }
        echo json_encode($response);
        exit;
        break;
    case 'afficheFrais' :
        ob_clean();
        $idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        include 'vues/comptable/validerFrais/v_listeFraisForfait.php';
        include 'vues/comptable/validerFrais/v_listeFraisHorsForfait.php';
        exit;
        break;
}