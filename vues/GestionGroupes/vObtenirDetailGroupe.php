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
<div style='margin-left:10%;margin-right:10%;'>
<table class='table table-bordered'>
   
   <tr>
      <td><strong>ID : $id</strong></td>
   </tr>
   <tr'>
      <td> Nom: </td>
      <td>$nom</td>
   </tr>
   <tr>
      <td> Identite responsable: </td>
      <td>$identite</td>
   </tr>
   <tr>
      <td> Adresse postale: </td>
      <td>$adresse</td>
   </tr>
   <tr>
      <td> Nombre de personnes: </td>
      <td>$nbPers</td>
   </tr>
   <tr>
      <td> Pays: </td>
      <td>$pays</td>
   </tr>
   <tr>
      <td> Hébergement: </td>
      <td>$hebergement</td>
   </tr>
</table>
<br>
<a href='cGestionGroupes.php'>Retour</a><br></div>";

include("includes/_fin.inc.php");

