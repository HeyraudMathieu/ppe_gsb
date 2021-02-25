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
        $lesVisiteurs = $pdo->getLesVisiteursParEtatFiche('CL');
        include 'vues/comptable/validerFrais/v_listeVisiteurMois.php';
        break;
    case 'recupereMois':
        $num_erreur = 0;
        $str_erreur = '';
        $str_idVisiteur = filter_input(INPUT_POST, 'str_idVisiteur', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($str_idVisiteur, 'CL');
        $response = array();
        foreach ($lesMois as $unMois) {
            $response[] = array('valeur' => $unMois['mois'], 'label' => $unMois['numMois'] . '/' . $unMois['numAnnee']);
        }
        retourAjax($response, $num_erreur, $str_erreur);
        break;
    case 'afficheFrais':
        $str_idVisiteur = filter_input(INPUT_POST, 'str_idVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'str_mois', FILTER_SANITIZE_STRING);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($str_idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($str_idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($str_idVisiteur, $leMois);
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        include 'vues/comptable/validerFrais/v_listeFrais.php';
        break;
    case 'verifAvantValidation':
        $num_erreur = 0;
        $str_erreur = '';
        $response = array();
        $lesFraisForfait = filter_input(INPUT_POST, 'lesFraisForfait', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $fraisForfaitIsModif = filter_input(INPUT_POST, 'fraisForfaitIsModif', FILTER_SANITIZE_STRING);
        $lesFraisHorsForfait = filter_input(INPUT_POST, 'lesFraisHorsForfait', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $fraisHorsForfaitIsModif = filter_input(INPUT_POST, 'fraisHorsForfaitIsModif', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $idVisiteur = filter_input(INPUT_POST, 'str_idVisiteur', FILTER_SANITIZE_STRING);
        $mois = filter_input(INPUT_POST, 'str_mois', FILTER_SANITIZE_STRING);
        if ($fraisForfaitIsModif == 'O') {
            if (lesQteFraisValides($lesFraisForfait)) {
                $pdo->majFraisForfait($idVisiteur, $mois, $lesFraisForfait);
            } else {
                $num_erreur = -1;
                $str_erreur = 'Les valeurs des frais doivent être numériques';
                $response = array('num_erreur' => $num_erreur, 'str_erreur' => $str_erreur);
            }
        }
        echo json_encode($response);
        break;
    case 'validerFrais':

        /*
          $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
          $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
          $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
          valideInfosFrais($dateFrais, $libelle, $montant);
          if (nbErreurs() != 0) {
          include 'vues/shared/v_erreurs.php';
          } else {

          } */
        break;
}