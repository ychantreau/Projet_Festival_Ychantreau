<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\metier;

/**
 * Description of Representation
 *
 * @author ttnguyen
 */
class Representation {
    private $id;
    
    private $id;
    
    private $groupe;
    
    private $lieu;
    
    private $dateRep;
    
    private $heureDebut;
    
    private $heureFin;
    
    function __construct($id, $groupe, $lieu, $dateRep, $heureDebut, $heureFin) {
        $this->id = $id;
        $this->groupe = $groupe;
        $this->lieu = $lieu;
        $this->dateRep = $dateRep;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
    }

    function getId() {
        return $this->id;
    }
    
    function getGroupe() {
        return $this->groupe;
    }

    function getLieu() {
        return $this->lieu;
    }

    function getDateRep() {
        return $this->dateRep;
    }

    function getHeureDebut() {
        return $this->heureDebut;
    }

    function getHeureFin() {
        return $this->heureFin;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setGroupe($groupe) {
        $this->groupe = $groupe;
    }

    function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    function setDateRep($dateRep) {
        $this->dateRep = $dateRep;
    }

    function setHeureDebut($heureDebut) {
        $this->heureDebut = $heureDebut;
    }

    function setHeureFin($heureFin) {
        $this->heureFin = $heureFin;
    }


    
}
