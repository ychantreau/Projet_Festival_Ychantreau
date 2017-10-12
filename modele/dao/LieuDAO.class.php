<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\dao;
use modele\metier\Lieu;
use PDOStatement;
use PDO;

/**
 * Description of LieuDAO
 *
 * @author ttnguyen
 */
class LieuDAO {
    

    protected static function enregVersMetier(array $enreg) {
        $id = $enreg['ID'];
        $nom = $enreg['NOM'];
        $adr = $enreg['ADR'];
        $capacite = $enreg['CAPACITE'];

        $unLieu = new Lieu($id, $nom, $adr, $capacite);

        return $unLieu;
    }
    /**
     * Retourne la liste de tous les lieus
     * @return array tableau d'objets de type Lieu
     */
    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Lieu";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            // Tant qu'il y a des enregistrements dans la table
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //ajoute un nouveau lieu au tableau
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    /**
     * Recherche un lieu selon la valeur de son identifiant
     * @param string $id
     * @return Lieu le lieu trouvé ; null sinon
     */
    public static function getOneById($id) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Lieu WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }


    
}
