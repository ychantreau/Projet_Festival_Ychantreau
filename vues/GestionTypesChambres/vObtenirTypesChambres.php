<?php
use modele\dao\TypeChambreDAO;
use modele\dao\AttributionDAO;
use modele\dao\Bdd;
require_once __DIR__ . '/../../includes/autoload.php';

include("includes/_debut.inc.php");

// AFFICHER L'ENSEMBLE DES TYPES DE CHAMBRES 
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR 
// TYPE DE CHAMBRE

echo "
<br>
<div style='margin-left:10%;margin-right:10%;'>
<table class='table table-bordered'>
<thead>
   <tr>
      <th><strong>Types de chambres</strong></th>
      <th>Détail</th>
      <th>Modifier</th>
      <th>Supprimer</th>
   </tr></thead><tbody>";
$lesTypesChambres = TypeChambreDAO::getAll();


// BOUCLE SUR LES TYPES DE CHAMBRES
foreach ($lesTypesChambres as $unTypeChambre) {
    $id = $unTypeChambre->getId();
    $libelle = $unTypeChambre->getLibelle();
    echo "
      <tr> 
         <td>$id</td>
         <td>$libelle</td>
         <td>
         
         <a href='cGestionTypesChambres.php?action=demanderModifierTypeChambre&id=$id'>
         Modifier</a></td>";

    // S'il existe déjà des attributions pour le type de chambre, il faudra
    // d'abord les supprimer avant de pouvoir supprimer le type de chambre
//    if (!existeAttributionsTypeChambre($connexion, $id)) {
    if (count(AttributionDAO::getAllByIdTypeChambre($id))==0) {
        echo "
            <td>
            <a href='cGestionTypesChambres.php?action=demanderSupprimerTypeChambre&id=$id'>
            Supprimer</a></td>";
    } else {
        echo "<td>&nbsp; </td>";
    }
    echo "               
    </tr>";
}
echo " </tbody>   
</table><br>
<a href='cGestionTypesChambres.php?action=demanderCreerTypeChambre'>
Création d'un type de chambre</a></div>";

include("includes/_fin.inc.php");

