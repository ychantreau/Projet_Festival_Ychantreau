<?php

use modele\dao\GroupeDAO;
use modele\metier\Groupe;
use modele\dao\Bdd;

require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

// OBTENIR LE DÉTAIL DU GROUPE SÉLECTIONNÉ

$unGrp = GroupeDAO::getOneById($id);
/* @var $unGrp Groupe  */
$nom = $unGrp->getNom();
$identite = $unGrp->getIdentite();
$adresse = $unGrp->getAdresse();
$nbPers = $unGrp->getNbPers();
$pays = $unGrp->getNomPays();
$hebergement = $unGrp->getHebergement();


echo "
<br>
<table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong>ID : $id</strong></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='20%'> Nom: </td>
      <td>$nom</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Identite responsable: </td>
      <td>$identite</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Adresse postale: </td>
      <td>$adresse</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Nombre de personnes: </td>
      <td>$nbPers</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Pays: </td>
      <td>$pays</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Hébergement: </td>
      <td>$hebergement</td>
   </tr>
</table>
<br>
<a href='cGestionGroupes.php'>Retour</a>";

include("includes/_fin.inc.php");

