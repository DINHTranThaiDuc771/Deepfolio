<?php

    class Utilisateur {

        private $nomutilisateur;
        private $mdphash;

        private $prenom;
        private $nom;
        private $age;
        private $ville;
        private $universite ;
        private $mailutilisateur;

        public function __construct( $nomutilisateur = "", $mdphash = "",$nom = "", $prenom = "", $age = 18, $ville = "", $universite = "", $mailutilisateur = "" ) {
            $this->nomutilisateur = $nomutilisateur;
            $this->mdphash = $mdphash;

            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->age = $age;
            $this->ville = $ville;
            $this->universite  = $universite ;
            $this->mailutilisateur = $mailutilisateur;
        }

        public function getNomUtilisateur() { return $this->nomutilisateur; }
        public function getMdp() { return $this->mdphash; }
        public function getPrenom() { return $this->prenom; }
        public function getNom() { return $this->nom; }
        public function getAge() { return $this->age; }
        public function getVille() { return $this->ville; }
        public function getUniversite() { return $this->universite; }
        public function getMail() { return $this->mailutilisateur; }

    }

?>