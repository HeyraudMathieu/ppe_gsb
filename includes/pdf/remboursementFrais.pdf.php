<?php

require './fpdf/fpdf.php';



// Initialisation du PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 13.5);

// Ajout image GSB
$pdf->Image('./images/logo.jpg', 82,5);
$pdf->Ln(35);

$pdf->SetTextColor(31,73,125);
$pdf->Cell(0,10, 'REMBOURSEMENT DE FRAIS ENGAGES',1,1,'C');

$pdf->SetFont('Times', '', 11);
$pdf->SetTextColor(0,0,0);

// 1ere ligne
$pdf->Cell(0,10,'','LR',1, 'L');

// 2eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'Visiteur',0,0);
$pdf->Cell(55, 10);
$pdf->Cell(1,10, 'NR', 0, 0);
$pdf->Cell(33, 10);
$pdf->Cell(1, 10, $prenom.' '. strtoupper($nom),0);
$pdf->Cell(0,10,'','R',1);

// 3eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'Mois',0,0);
$pdf->Cell(55, 10);
$pdf->Cell(1,10, utf8_decode($moi).' '.$numAnnee, 0, 0);
$pdf->Cell(0,10,'','R',1);

// Interligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(160,10,'','B',0);
$pdf->Cell(0,10,'','R',1);

// Debut du Tableau
// 1ere ligne
$pdf->SetFont('Times','I',12);
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'','L',0);
$pdf->Cell(50, 10, 'Frais Forfaitaires', 0, 0, 'C');
$pdf->Cell(35,10, utf8_decode('Quantité'),0,0,'C');
$pdf->Cell(40,10,'Montant unitaire',0,0,'C');
$pdf->Cell(35,10,'Total',0,0,'C');
$pdf->Cell(-1,10,'','R',0);
$pdf->Cell(0,10,'','R',1);
$pdf->SetFont('Times','',11);

// 2eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'','LTB',0);
$pdf->Cell(50, 10, utf8_decode($lesFraisPDF[0]['libelle']), 'TB', 0, 'L');
$pdf->Cell(35,10, $lesFraisPDF[0]['quantite'],1,0,0);
$pdf->Cell(40,10,$lesFraisPDF[0]['montant'],1,0,0);
$pdf->Cell(34,10,$lesFraisPDF[0]['total'],1,0,0);
$pdf->Cell(0,10,'','R',1);

// 3eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'','LTB',0);
$pdf->Cell(50, 10, utf8_decode($lesFraisPDF[1]['libelle']), 'TB', 0, 'L');
$pdf->Cell(35,10, $lesFraisPDF[1]['quantite'],1,0,0);
$pdf->Cell(40,10,$lesFraisPDF[1]['montant'],1,0,0);
$pdf->Cell(34,10,$lesFraisPDF[1]['total'],1,0,0);
$pdf->Cell(0,10,'','R',1);

// 4eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'','LTB',0);
$pdf->Cell(50, 10, utf8_decode($lesFraisPDF[2]['libelle']), 'TB', 0, 'L');
$pdf->Cell(35,10, $lesFraisPDF[2]['quantite'],1,0,0);
$pdf->Cell(40,10,$lesFraisPDF[2]['montant'],1,0,0);
$pdf->Cell(34,10,$lesFraisPDF[2]['total'],1,0,0);
$pdf->Cell(0,10,'','R',1);

// 5eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'','LTB',0);
$pdf->Cell(50, 10, utf8_decode($lesFraisPDF[3]['libelle']), 'TB', 0, 'L');
$pdf->Cell(35,10, $lesFraisPDF[3]['quantite'],1,0,0);
$pdf->Cell(40,10,$lesFraisPDF[3]['montant'],1,0,0);
$pdf->Cell(34,10,$lesFraisPDF[3]['total'],1,0,0);
$pdf->Cell(0,10,'','R',1);

// Resultat TOTAL des Frais forfetaires
$resultFrais = floatval($lesFraisPDF[0]['total']+$lesFraisPDF[1]['total']+$lesFraisPDF[2]['total']+$lesFraisPDF[3]['total']);

// 6eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(126,10,'','L',0);
$pdf->Cell(17, 10,'TOTAL','LB',0);
$pdf->Cell(17, 10, number_format((float)$resultFrais,2,'.','') ,'BR',0,'R');
$pdf->Cell(0,10,'','R',1);

// Interligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'','L',0);
$pdf->Cell(159,10,'','R',0);
$pdf->Cell(0,10,'','R',1);

// 7eme ligne
$pdf->SetFont('Times','I',12);
$pdf->SetTextColor(31,73,125);
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(160,10,'Autres Frais', 'LR',0, 'C');
$pdf->Cell(0,10,'','R',1);


// 8eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(1,10,'','L',0);
$pdf->Cell(50, 10, 'Date', 0, 0, 'C');
$pdf->Cell(75,10, utf8_decode('Libellé'),0,0,'C');
$pdf->Cell(35,10,'Montant',0,0,'C');
$pdf->Cell(-1,10,'','R',0);
$pdf->Cell(0,10,'','R',1);
$pdf->SetFont('Times','',11);
$pdf->SetTextColor(0,0,0);

// Initialisation de la variable resultat hors frais
$resultHorsFrais=0;

// 9eme ligne
foreach($lesFraisHorsForfait as $row){
    $pdf->Cell(14,10,'','L',0);
    $pdf->Cell(50,10,$row['date'],1,0);
    $pdf->Cell(75,10,utf8_decode($row[3]), 1,0,'R');
    $pdf->Cell(35,10,utf8_decode($row[5]),'TBR',0, 'R');
    $pdf->Cell(0,10,'','R',1);
    $resultHorsFrais = $resultHorsFrais + floatval($row[5]);
}

// 10eme ligne
$pdf->Cell(14,10,'','L',0);
$pdf->Cell(125,10,'','LB',0);
$pdf->Cell(17, 10,'TOTAL','LB',0);
$pdf->Cell(18, 10, number_format((float)$resultHorsFrais,2,'.','') ,'BR',0,'R');
$pdf->Cell(0,10,'','R',1);

// Interligne
$pdf->Cell(0,10,'','LR',1);

// 11eme ligne (total)
$pdf->Cell(105,10,'','L',0);
$pdf->Cell(34,10,'TOTAL'.' '.$numMois.'/'.$numAnnee,1,0);
$pdf->Cell(35,10,number_format((float)$resultFrais+$resultHorsFrais,2,'.','') ,1,0, 'R');
$pdf->Cell(0,10,'','R',1);

// Fin du tableau
$pdf->Cell(0,10,'','LRB',1);


// Signature
$pdf->Ln(5);
$pdf->Cell(110,10,'',0,0);
$pdf->Cell(10,10,utf8_decode('Fait à Paris, le '),0,0);
$pdf->Ln(5);
$pdf->Cell(110,10,'',0,0);
$pdf->Cell(10,10,'Vu l\'agent comptable',0,0);
$pdf->Ln(3);
$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->SetXY($x,$y);
$pdf->Cell(10,10,$pdf->Image('./images/signatureComptable.jpg', $x+98,$y+7),0,0);

// Envoie au navigateur
$pdf->Output();

?>