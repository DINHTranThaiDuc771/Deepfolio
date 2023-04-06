<?php

class Competence implements JsonSerializable{

    private $nom;
    private $description;
    private $lien;

    public function __construct($nom = "", $description = "", $lien = "") {
        $this->nom = $nom;
        $this->description = $description;
        $this->lien = $lien;
    }

    //--------------GETTERS--------------//
    public function getNom() { return $this->nom; }

    public function getDescription() { return $this->description; }

    public function getLien() { return $this->lien; }

    //--------------SETTERS--------------//
    public function setNom($nom) { $this->nom = $nom; }

    public function setDescription($description) { $this->description = $description; }

    public function setLien($lien) { $this->lien = $lien; }


    public function jsonSerialize() {
        return [
            "nom"           => $this->nom,
            "description"   => $this->description,
            "lien"          => $this->lien
        ];
    }

}

?>