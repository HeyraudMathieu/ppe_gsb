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
    $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
    $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
    $response = array();
    foreach($lesMois as $unMois){
        $response[] = array('valeur'=>$unMois['mois'], 'label'=>$unMois['numMois'] . '/' . $unMois['numAnnee']);
    }
    echo json_encode($response);
    break;
}