<?php

/* Ce fichier ne sera jamais utilisé, il a juste été créer par malcompréhension du sujet.
 * Nous nous sommes convenu qu'il serait intéressant de le garder au cas où il nous serait demandé
 * de pouvoir modifier ou créer les groupes sans utiliser la PhpMyAdmin.
*/
use modele\dao\GroupeDAO;
use modele\metier\Groupe;
use modele\dao\Bdd;
require_once __DIR__.'/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

// CRÉER OU MODIFIER UN GROUPE 
if ($action == 'demanderCreerGroup') {
    $id = '';
    $nom = '';
    $responsable = '';
    $codePostal = '';
    $nbPersonnes = '';
    $nomPays = '';
    $hebergement = '';
}
//ModificationGroupe
if ($action == 'demanderModifierGroup') {
    $unGroupe = GroupeDAO::getOneById($id);
    /* @var $unGroupe Groupe */
    $nom = $unGroupe->getNom();
    $responsable = $unGroupe->getIdentite();
    $codePostal = $unGroupe->getAdresse();
    $nbPersonnes = $unGroupe->getNbPers();
    $nomPays = $unGroupe->getNomPays();
    $hebergement = $unGroupe->getHebergement();        
}

// Initialisations en fonction du mode (création ou modification)
if ($action == 'demanderCreerGroup' || $action == 'validerCreerGroup') {
    $creation = true;
    $message = "Nouveau Groupe";  // Alimentation du message de l'en-tête
    $action = "validerCreerGroup";
} else {
    $creation = false;
    $message = "$nom ($id)";            // Alimentation du message de l'en-tête
    $action = "validerModifierGroup";
}

echo "
<form method='POST' action='cGestionGroupes.php?'>
   <input type='hidden' value='$action' name='action'>
   <br>
   <table width='85%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'><strong>$message</strong></td>
      </tr>";

if ($creation) {
    // On utilise les guillemets comme délimiteur de champ dans l'echo afin
    // de ne pas perdre les éventuelles quotes saisies (même si les quotes
    // ne sont pas acceptées dans l'id, on a le souci de ré-afficher l'id
    // tel qu'il a été saisi) 
    echo '
         <tr class="ligneTabNonQuad">
            <td> Id*: </td>
            <td><input type="text" value="' . $id . '" name="id" size ="10" 
            maxlength="8"></td>
         </tr>';
} else {
    echo "
         <tr>
            <td><input type='hidden' value='$id' name='id'></td><td></td>
         </tr>";
}
echo '
      <tr class="ligneTabNonQuad">
         <td> Nom*: </td>
         <td><input type="text" value="' . $nom . '" name="nom" size="50" 
         maxlength="45"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Adresse*: </td>
         <td><input type="text" value="' . $responsable . '" name="adresseRue" 
         size="50" maxlength="45"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Code postal*: </td>
         <td><input type="text" value="' . $nbPersonnes . '" name="codePostal" 
         size="7" maxlength="5"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Ville*: </td>
         <td><input type="text" value="' . $nomPays . '" name="ville" size="40" 
         maxlength="35"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Ville*: </td>
         <td><input type="text" value="' . $hebergement . '" name="ville" size="40" 
         maxlength="35"></td>
      </tr>
      ';

echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
   </table>
   <a href='cGestionGroupes.php'>Retour</a>
</form>";

include("includes/_fin.inc.php");



