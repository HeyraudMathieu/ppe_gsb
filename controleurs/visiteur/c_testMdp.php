<?php
/**
 * Gestion des frais
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

$idVisiteur = $_SESSION['idVisiteur'];
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'hash':
    /**
        $lemdp = $pdo->updateMdp("a283");
        $verif = password_verify('azerty', $lemdp);
        var_dump($lemdp, $verif);
        */
        /**
        $visi = $pdo->updateMdp("a283");
        var_dump($visi);
        
        $lesVisiteurs = $pdo->getAllVisiteurs();
        foreach($lesVisiteurs as $row){
            $pdo->udpdateMdp($row['id']);
        }
        */
    
        $pdo->updateMdp('a283');
        //$pdo->checkMdp('a283');
    break;
}
