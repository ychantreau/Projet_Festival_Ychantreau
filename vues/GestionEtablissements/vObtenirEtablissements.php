<?php
use modele\dao\EtablissementDAO;
use modele\dao\AttributionDAO;
use modele\dao\Bdd;
require_once __DIR__.'/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

// AFFICHER L'ENSEMBLE DES ÉTABLISSEMENTS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// ÉTABLISSEMENT

echo "
<br>
<div style='margin-left:10%;margin-right:10%;'>
<table class='table table-bordered'>
<thead>
   <tr>
      <th><strong>Etablissements</strong></th>
      <th>Détail</th>
      <th>Modifier</th>
      <th>Supprimer</th>
   </tr></thead><tbody>";

$lesEtablissements = EtablissementDAO::getAll();
// BOUCLE SUR LES ÉTABLISSEMENTS
foreach ($lesEtablissements as $unEtablissement) {
    $id = $unEtablissement->getId();
    $nom = $unEtablissement->getNom();
    echo "
		<tr>
         <td>$nom</td>
         
         <td> 
         <a href='cGestionEtablissements.php?action=detailEtab&id=$id'>
         Voir détail</a></td>
         
         <td> 
         <a href='cGestionEtablissements.php?action=demanderModifierEtab&id=$id'>
         Modifier</a></td>";

    // S'il existe déjà des attributions pour l'établissement, il faudra
    // d'abord les supprimer avant de pouvoir supprimer l'établissement
//    if (!existeAttributionsEtab($connexion, $id)) {
    $lesAttributionsDeCetEtablissement = AttributionDAO::getAllByIdEtab($id);
    if (count($lesAttributionsDeCetEtablissement)==0) {
        echo "
            <td> 
            <a href='cGestionEtablissements.php?action=demanderSupprimerEtab&id=$id'>
            Supprimer</a></td>";
    } else {
        echo "
            <td>&nbsp; </td>";
    }
    echo "
      </tr>";
}
echo "
    </tbody>
</table>
<br>
<a href='cGestionEtablissements.php?action=demanderCreerEtab'>
Création d'un établissement</a>
</div>";

include("includes/_fin.inc.php");

