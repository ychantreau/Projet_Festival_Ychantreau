<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\dao;

use modele\metier\Representation;
use PDOStatement;
use PDO;

/**
 * Description of RepresentationDAO
 *
 * @author ttnguyen
 */
class RepresentationDAO {

    protected static function enregVersMetier(array $enreg) {
        $id = $enreg['ID'];
        $lieu = $enreg[strtoupper('ID_LIEU')];
        $groupe = $enreg['ID_GROUPE'];
        $dateRep = $enreg['DATE_REP'];
        $heureDebut = $enreg['HEUREDEBUT'];
        $heureFin = $enreg['HEUREFIN'];

        $uneRepresentation = new Representation($id, $lieu, $dateRep, $heureDebut, $heureFin);

        return $uneRepresentation;
    }

    /**
     * Valorise les paramètres d'une requête préparée avec l'état d'un objet Representation
     * @param type $objetMetier un Representation
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg(Representation $objetMetier, PDOStatement $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        // Note : bindParam requiert une référence de variable en paramètre n°2 ; 
        // avec bindParam, la valeur affectée à la requête évoluerait avec celle de la variable sans
        // qu'il soit besoin de refaire un appel explicite à bindParam
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':nom', $objetMetier->getNom());
        $stmt->bindValue(':dateRep', $objetMetier->getDate());
        $stmt->bindValue(':heureDebut', $objetMetier->getHeureDebut());
        $stmt->bindValue(':heureFin', $objetMetier->getHeureFin());
    }

    /**
     * Retourne la liste de toutess les representations
     * @return array tableau d'objets de type Representations
     */
    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Representations INNER JOIN Groupe ON Representations.id_groupe = Groupe.id INNER JOIN Lieu ON Representations.id_lieu = Lieu.id";
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
     * Recherche une représentation selon la valeur de son identifiant
     * @param string $id
     * @return Representations ; null sinon
     */
    public static function getOneById($id) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Representations INNER JOIN Groupe ON Representations.id_groupe = Groupe.id INNER JOIN Lieu ON Representations.id_lieu = Lieu.id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Representation $objet objet métier à insérer
     * @return boolean =FALSE si l'opération échoue
     */
    public static function insert(Representation $objet) {
        $requete = "INSERT INTO Representations VALUES (:id, :nom, :dateRep, :heureDebut, :heureFin)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param Representation $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function updateRep($id, Representation $objet) {
        $ok = false;
        $requete = "UPDATE  Representations SET NOM=:nom, DATE_REP=:dateRep,
           HEUREDEBUT=:heureDebut, HEUREFIN=:heureFin,
           WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Détruire un enregistrement de la table ETABLISSEMENT d'après son identifiant
     * @param string identifiant de l'enregistrement à détruire
     * @return boolean =TRUE si l'enregistrement est détruit, =FALSE si l'opération échoue
     */
    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Representations WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

}
