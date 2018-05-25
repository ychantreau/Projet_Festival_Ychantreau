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

echo"<h2 class=center>Programmes par jours</h2><br_/>";

if ($nbGroupes != 0 && $nbLieux != 0 ){
     
    // BOUCLE SUR LES Date de représentation
    $test = 0;
    $dateTest = "0";
    foreach ($lesRepresentations as $uneRepresentation) {
        $dateRepresentation = $uneRepresentation->getDateRep();
        
        if($dateRepresentation != $dateTest){
            if($test == 1){
                echo"</table></div><br>";
            }
            $dateTest = $dateRepresentation;
            echo "<strong>$dateRepresentation</strong><br>
         <div style='margin-left:10%;margin-right:10%;'>
<table class='table table-bordered'>";
            echo "
         <tr>
            <th>Lieu</th>
            <th>Groupe</th>
            <th>Heure Début</th>
            <th>HeureFin</th>
         </tr>";
        }
        
        echo " 
            <tr>
            <td>".$uneRepresentation->getLieu()->getNom()."</td>
            <td>".$uneRepresentation->getGroupe()->getNom()."</td>
            <td><center>".$uneRepresentation->getHeureDebut()."</center></td>
            <td><center>".$uneRepresentation->getHeureFin()."</center></td>";
        
            if($test == 0){
                $test = 1;
            }
        echo "</div>";
    }
     
        
}
