<?php
/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdogsb.inc.php';
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();

if(!isset($_POST['ajax'])){
    require 'vues/shared/v_entete.php';
}

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
if (!$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) {
case 'connexion':
    include 'controleurs/shared/c_connexion.php';
    break;
case 'deconnexion':
    include 'controleurs/shared/c_deconnexion.php';
    break;
default :
    if($_SESSION['droit'] == 1){
        switch ($uc) {
            case 'accueil':
                include 'controleurs/visiteur/c_accueil.php';
                break;
            case 'gererFrais':
                include 'controleurs/visiteur/c_gererFrais.php';
                break;
            case 'etatFrais':
                include 'controleurs/visiteur/c_etatFrais.php';
                break;
            default :
                break;
        }
    } else if($_SESSION['droit'] == 2){
        switch ($uc) {
            case 'accueil':
                include 'controleurs/comptable/c_accueil.php';
                break;
            case 'validerFrais':
                include 'controleurs/comptable/c_validerFrais.php';
                break;
            default :
                break;
        }
    }
    break;
}

if(!isset($_POST['ajax'])){
    require 'vues/shared/v_pied.php';
}