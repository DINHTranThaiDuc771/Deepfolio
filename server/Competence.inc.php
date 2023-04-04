<?php

class Competence{

    private $nom;
    private $description;
    private $lien;
    private $projet;

    public function __construct($nom = "", $description = "", $lien = "", $projet = "") {
        $this->nom = $nom;
        $this->description = $description;
        $this->lien = $lien;
        $this->projet = $projet;
    }

    //--------------GETTERS--------------//
    public function getNom() { return $this->nom; }

    public function getDescription() { return $this->description; }

    public function getLien() { return $this->lien; }

    public function getProjet() { return $this->projet; }

    //--------------SETTERS--------------//
    public function setNom($nom) { $this->nom = $nom; }

    public function setDescription($description) { $this->description = $description; }

    public function setLien($lien) { $this->lien = $lien; }

    public function setProjet($projet) { $this->projet = $projet; } 

}

?>