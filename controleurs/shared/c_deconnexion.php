<?php
/**
 * Gestion de la déconnexion
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

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
case 'demandeDeconnexion':
    include 'vues/shared/v_deconnexion.php';
    break;
case 'valideDeconnexion':
    if (estConnecte()) {
        include 'vues/shared/v_deconnexion.php';
    } else {
        ajouterErreur("Vous n'êtes pas connecté");
        include 'vues/shared/v_erreurs.php';
        include 'vues/shared/v_connexion.php';
    }
    break;
default:
    include 'vues/shared/v_connexion.php';
    break;
}
