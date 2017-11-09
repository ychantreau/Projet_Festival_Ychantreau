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
        $idGroupe= $enreg['ID_GROUPE'];
        $idLieu= $enreg['ID_LIEU'];
        $dateRep = $enreg['DATE_REP'];
        $heureDebut = $enreg['HEUREDEBUT'];
        $heureFin = $enreg['HEUREFIN'];

        $objetGroupe = GroupeDAO::getOneById($idGroupe);
        $objetLieu = LieuDAO::getOneById($idLieu);
        
        $uneRepresentation = new Representation($id, $objetGroupe, $objetLieu, $dateRep, $heureDebut, $heureFin);

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
        $groupe = $objetMetier->getGroupe();
        $lieu = $objetMetier->getLieu();
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':idTypeCh', $groupe->getGroupe()->getId());
        $stmt->bindValue(':idTypeCh', $lieu->getLieu()->getId());
        $stmt->bindValue(':dateRep', $objetMetier->getDate());
        $stmt->bindValue(':heureDebut', $objetMetier->getHeureDebut());
        $stmt->bindValue(':heureFin', $objetMetier->getHeureFin());
    }

    /**
     * Retourne la liste de toutess les representations SELECT date_rep,l.nom,g.nom,heureDebut,heureFin FROM Representation r INNER JOIN Groupe g ON r.id_groupe = g.id INNER JOIN Lieu l ON r.id_lieu = l.id
     * @return array tableau d'objets de type Representation
     */
    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Representation r INNER JOIN Groupe g ON r.id_groupe = g.id INNER JOIN Lieu l ON r.id_lieu = l.id";
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
     * SELECT * FROM Representation r INNER JOIN Groupe g ON r.id_groupe = g.id INNER JOIN Lieu l ON r.id_lieu = l.id WHERE r.id = :id
     * @param string $id
     * @return Representation ; null sinon
     */
    public static function getOneById($id) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Representation WHERE id = :id";
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
        $requete = "INSERT INTO Representation VALUES (:id, :nom, :dateRep, :heureDebut, :heureFin)";
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
        $requete = "UPDATE  Representation SET NOM=:nom, DATE_REP=:dateRep,
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
        $requete = "DELETE FROM Representation WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

}
