<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\metier;

/**
 * Description of Lieu
 *
 * @author ttnguyen
 */
class Lieu {    
    
    private $id;
    
    private $nom;
    
    private $adr;
    
    private $capacite;
    
    
    function __construct($id, $nom, $adr, $capacite) {
        $this->id = $id;
        $this->nom = $nom;
        $this->adr = $adr;
        $this->capacite = $capacite;
    }
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getAdr() {
        return $this->adr;
    }

    function getCapacite() {
        return $this->capacite;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setAdr($adr) {
        $this->adr = $adr;
    }

    function setCapacite($capacite) {
        $this->capacite = $capacite;
    }

}
