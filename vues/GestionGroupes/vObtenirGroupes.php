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
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong>Groupes</strong></td>
   </tr>";

$lesGroupes = GroupeDAO::getAll();
// BOUCLE SUR LES GROUPES
foreach ($lesGroupes as $unGroupe) {
    $id = $unGroupe->getId();
    $nom = $unGroupe->getNom();
    echo "
		<tr class='ligneTabNonQuad'>
         <td align='center'>$nom</td>
             
        </tr>";
/*<td width='16%' align='center'> 
         <a href='cGestionGroupes.php?action=detailGrp&id=$id'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='cGestionGroupes.php?action=demanderModifierGrp&id=$id'>
         Modifier</a></td>*/
    // S'il existe déjà des attributions pour le groupe, il faudra
    // d'abord les supprimer avant de pouvoir supprimer le groupe
//    if (!existeAttributionsGrp($connexion, $id)) {
   /*$lesAttributionsDeCeGroupe = AttributionDAO::getAllByIdGrp($id);
    if (count($lesAttributionsDeCeGroupe)=='N') {
        echo "
            <td width='16%' align='center'> 
            <a href='cGestionGroupes.php?action=demanderSupprimerEtab&id=$id'>
            Supprimer</a></td>";
   } else {
        echo "
            <td width='16%'>&nbsp; </td>";
    }*/
}
echo "
</table>";

include("includes/_fin.inc.php");