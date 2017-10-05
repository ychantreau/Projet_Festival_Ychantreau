<?php

/**
 * Contrôleur : gestion des groupes
 */

use modele\dao\GroupeDAO;
use modele\metier\Groupe;
use modele\dao\Bdd;
require_once __DIR__.'/includes/autoload.php';
Bdd::connecter();

include("includes/_gestionErreurs.inc.php");
//include("includes/gestionDonnees/_connexion.inc.php");
//include("includes/gestionDonnees/_gestionBaseFonctionsCommunes.inc.php");

// 1ère étape (donc pas d'action choisie) : affichage du tableau des 
// groupes
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

include("vues/GestionGroupes/vObtenirGroupes.php");

// Aiguillage selon l'étape

/*switch ($action) {
    case 'initial' :
        include("vues/GestionGroupes/vObtenirGroupes.php");
        break;

    case 'detailGrp':
        $id = $_REQUEST['id'];
        include("vues/GestionGroupes/vObtenirDetailGroupe.php");
        break;

    case 'demanderSupprimerGrp':
        $id = $_REQUEST['id'];
        include("vues/GestionGroupes/vSupprimerGroupe.php");
        break;

    case 'demanderCreerGrp':
        include("vues/GestionGroupes/vCreerModifierGroupe.php");
        break;

    case 'demanderModifierGrp':
        $id = $_REQUEST['id'];
        include("vues/GestionGroupes/vCreerModifierGroupe.php");
        break;

    case 'validerSupprimerGrp':
        $id = $_REQUEST['id'];
        GroupeDAO::delete($id);
        include("vues/GestionGroupes/vObtenirGroupes.php");
        break;

    case 'validerCreerGrp':case 'validerModifierGrp':
        $id = $enreg['ID'];
        $nom = $enreg['NOM'];
        $identite = $enreg['IDENTITERESPONSABLE'];
        $adresse = $enreg['ADRESSEPOSTALE'];
        $nbPers = $enreg['NOMBREPERSONNES'];
        $nomPays = $enreg['NOMPAYS'];
        $hebergement = $enreg['HEBERGEMENT'];
        $unGroupe = new Groupe($id, $nom, $identite, $adresse, $nbPers, $nomPays, $hebergement);

        if ($action == 'validerCreerGrp') {
            verifierDonneesGrpC($id, $nom, $identite, $adresse, $nbPers, $nomPays, $hebergement);
            if (nbErreurs() == 0) {
                $unGroupe = new Groupe($id, $nom, $identite, $adresse, $nbPers, $nomPays, $hebergement);
                GroupeDAO::insert($unGroupe);
                include("vues/GestionGroupes/vObtenirGroupes.php");
            } else {
                include("vues/GestionGroupes/vCreerModifierGroupe.php");
            }
        } else {
            verifierDonneesGrpM($id, $nom, $identite, $adresse, $nbPers, $nomPays, $hebergement);
            if (nbErreurs() == 0) {
                $unGroupe = new Groupe($id, $nom, $identite, $adresse, $nbPers, $nomPays, $hebergement);
                GroupeDAO::update($id, $unGroupe);
                include("vues/GestionGroupes/vObtenirGroupes.php");
            } else {
                include("vues/GestionGroupes/vCreerModifierGroupe.php");
            }
        }
        break;
}
*/
// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesGrpC($id, $nom, $identite, $adresse, $nbPers, $nomPays, $hebergement) {
    if ($id == "" || $nom == "" || $identite == "" || $adresse == "" ||
            $nbPers == "" || $nomPays == "" || $hebergement == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id != "") {
        // Si l'id est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (!estChiffresOuEtLettres($id)) {
            ajouterErreur
                    ("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
        } else {
            if (GroupeDAO::isAnExistingId($id)) {
                ajouterErreur("Le groupe $id existe déjà");
            }
        }
    }
    if ($nom != "" && GroupeDAO::isAnExistingName(true, $id, $nom)) {
        ajouterErreur("Le groupe $nom existe déjà");
    }

    if ($nom != ""){
        // Si l'id est constitué que de chiffres, une erreur sera généré.
        if (!estLettre($nom)){
            ajouterErreur("Le groupe ne doit contenir que des lettres");
        }
    }
    
}
    


    
   

function verifierDonneesGrpM($id, $nom, $identite, $adresse, $nbPers, $nomPays, $hebergement) {
    if ($id == "" || $nom == "" || $identite == "" || $adresse == "" ||
            $nbPers == "" || $nomPays == "" || $hebergement == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($nom != "" && GroupeDAO::isAnExistingName(false, $id, $nom)) {
        ajouterErreur("Le groupe $nom existe déjà");
    }

    if ($nom != ""){
        // Si l'id est constitué que de chiffres, une erreur sera généré.
        if (!estLettre($nom)){
            ajouterErreur("Le groupe ne doit contenir que des lettres");
        }
    }
    
}



// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();