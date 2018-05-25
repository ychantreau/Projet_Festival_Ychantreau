<?php
use modele\metier\Groupe;
use modele\dao\GroupeDAO;
use modele\dao\AttributionDAO;
use modele\dao\Bdd;
require_once __DIR__.'/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");


// AFFICHER L'ENSEMBLE DES GROUPES
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// GROUPE

echo "
<br>
<div style='margin-left:10%;margin-right:10%;'>
<table class='table table-bordered'>
   <thead>
   <tr>
      <th><strong>Groupes</strong></th>
      <th>Détail</th>
   </tr>
   </thead>
   <tbody>";

$lesGroupes = GroupeDAO::getAll();
// BOUCLE SUR LES GROUPES
foreach ($lesGroupes as $unGroupe) {
    $id = $unGroupe->getId();
    $nom = $unGroupe->getNom();
    echo "
		<tr>
         <td>$nom</td>
             
        
        <td> 
         <a href='cGestionGroupes.php?action=detailGrp&id=$id'>
         Voir détail</a></td>
         ";
    // S'il existe déjà des attributions pour le groupe, il faudra
    // d'abord les supprimer avant de pouvoir supprimer le groupe
//    if (!existeAttributionsGrp($connexion, $id)) {
   /*$lesAttributionsDeCeGroupe = AttributionDAO::getAllByIdGrp($id);
    if (count($lesAttributionsDeCeGroupe)=='N') {
        echo "
            <td> 
            <a href='cGestionGroupes.php?action=demanderSupprimerEtab&id=$id'>
            Supprimer</a></td></tr>";
   } else {
        echo "
            <td>&nbsp; </td></tr>";
    }*/
}
echo "
</tbody></table>
</div>";

include("includes/_fin.inc.php");