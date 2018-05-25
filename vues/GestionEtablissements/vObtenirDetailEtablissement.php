<?php

use modele\dao\EtablissementDAO;
use modele\metier\Etablissement;
use modele\dao\Bdd;

require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

// OBTENIR LE DÉTAIL DE L'ÉTABLISSEMENT SÉLECTIONNÉ

$unEtab = EtablissementDAO::getOneById($id);
/* @var $unEtab Etablissement  */
$nom = $unEtab->getNom();
$adresseRue = $unEtab->getAdresse();
$codePostal = $unEtab->getCdp();
$ville = $unEtab->getVille();
$tel = $unEtab->getTel();
$adresseElectronique = $unEtab->getEmail();
$type = $unEtab->getTypeEtab();
$civiliteResponsable = $unEtab->getCiviliteResp();
$nomResponsable = $unEtab->getNomResp();
$prenomResponsable = $unEtab->getPrenomResp();


echo "
<div style='margin-left:10%;margin-right:10%;'>
<table class='table table-bordered'>
   <tbody>
   <tr>
      <td><strong>$nom</strong></td>
   </tr>
   <tr >
      <td> Id: </td>
      <td>$id</td>
   </tr>
   <tr>
      <td> Adresse: </td>
      <td>$adresseRue</td>
   </tr>
   <tr>
      <td> Code postal: </td>
      <td>$codePostal</td>
   </tr>
   <tr >
      <td> Ville: </td>
      <td>$ville</td>
   </tr>
   <tr>
      <td> Téléphone: </td>
      <td>$tel</td>
   </tr>
   <tr>
      <td> E-mail: </td>
      <td>$adresseElectronique</td>
   </tr>
   <tr>
      <td> Type: </td>";
if ($type == 1) {
    echo "<td> Etablissement scolaire </td>";
} else {
    echo "<td> Autre établissement </td>";
}
echo "
   </tr>
   <tr>
      <td> Responsable: </td>
      <td>$civiliteResponsable&nbsp; $nomResponsable&nbsp; $prenomResponsable
      </td>
   </tr>
   </tbody>
</table>
<br>
<a href='cGestionEtablissements.php'>Retour</a></div>";

include("includes/_fin.inc.php");

