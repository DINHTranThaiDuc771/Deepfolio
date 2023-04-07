<?php

    class Reseau implements JsonSerializable{

        public $nom;
        public $nomClasse;
        public $lien;

        public function __construct($nom = "", $nomClasse="", $lien = "") {
            $this->nom = $nom;
            $this->nomClasse = $nomClasse;
            $this->lien = $lien;
        }

        //--------------GETTERS--------------//
        
        public function getNom() { return $this->nom; }

        public function getLien() { return $this->lien; }

        //--------------SETTERS--------------//

        public function setNom($nom) { $this->nom = $nom; }

        public function setLien($lien) { $this->lien = $lien; }

        public function jsonSerialize()
        {
            return [
                "nom"           => $this->nom,
                "lien"          => urlencode($this->lien)
            ];
        }
    }
?>
