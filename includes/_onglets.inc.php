<?php

// On récupère l'adresseRue de la page
$URL = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];

// Cette fonction est appelée pour la construction de chaque onglet ($i est la 
// position de l'onglet dans la barre)
function construireMenu($nom, $adr, $i) {
    global $URL;
    // Si l'onglet est déjà ouvert, le lien est inactif
    if (($adr != "") && (strpos($URL, $adr))) {
        // S'il s'agit de l'onglet de gauche, le style est différent car il faut 
        // conserver le trait à gauche sinon le trait de gauche est supprimé 
        // (afin d'éviter d'avoir une double épaisseur en raison du trait droit
        // de l'onglet précédent) class="ongletOuvertPrem",class="ongletOuvert",class="ongletPrem",class="onglet"
        if ($i == 1) {
            echo '<li>' . $nom . '</li>';
        } else {
            echo '<li>' . $nom . '</li>';
        }
    }
    else {
        // S'il s'agit de l'onglet de gauche, le style est différent car il faut 
        // conserver le trait à gauche sinon le trait de gauche est supprimé 
        // (afin d'éviter d'avoir une double épaisseur en raison du trait droit
        // de l'onglet précédent) 
        if ($i == 1) {
            echo '<li><a href="' . $adr . '">' . $nom . '</a></li>';
        } else {
            echo '<li><a href="' . $adr . '">' . $nom . '</a></li>';
        }
    }
}
