<?php
use modele\dao\RepresentationDAO;
use modele\dao\GroupeDAO;
use modele\dao\LieuDAO;
use modele\dao\Bdd;
require_once __DIR__.'/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

// Variable contenant les informations du groupe.

$lesGroupes = GroupeDAO::getAll();
$nbGroupes = count($lesGroupes);
$lesLieux = LieuDAO::getAll();
$nbLieux = count($lesLieux);
$lesRepresentations = RepresentationDAO::getAll();
$nbRepresentations = count($lesRepresentations);

if ($nbGroupes != 0 && $nbLieux != 0 && $nbLieux != 0 ){
    
    
    // BOUCLE SUR LES Date de représentation
    $dateTest = "0";
    $endTest = 0;
    foreach ($lesRepresentations as $uneRepresentation) {
        $dateRepresentation = $uneRepresentation->getDateRep();
        
        if($endTest == 1){
            echo"</table><br>";
        }
        
        if($dateRepresentation != $dateTest){
            $dateTest = $dateRepresentation;
            echo "<strong>$dateRepresentation</strong><br>
         <table width='45%' cellspacing='0' cellpadding='0' class='tabQuadrille'>";
            echo "
         <tr class='enTeteTabQuad'>
            <td width='30%'>Lieu</td>
            <td width='35%'>Groupe</td>
            <td width='35%'>Heure Début</td>
            <td width='30%'>HeureFin</td>
            <td width='35%'>'       '</td>
            <td width='35%'>'       '</td> 
         </tr>";
        }
        
        echo " 
            <tr class='ligneTabQuad'>
            <td>".$uneRepresentation->getLieu()."</td>
            <td>".$uneRepresentation->getGroupe()."</td>
            <td>".$uneRepresentation->getHeureDebut()."</td>
            <td>".$uneRepresentation->getHeureFin()."</td>
            <td> Bientôt, un lien pour modifier </td>
            <td> Bientôt, un lien pour modifier </td>";
        
            if($endTest == 1){
            $endTest = 1;
            }
    }
    echo"</table><br>"; 
        
}