<?php

    class Utilisateur {

        private $nomUtilisateur;
        private $prenom;
        private $nom;
        private $age;
        private $ville;
        private $universite ;
        private $mail;

        public function __construct( $nomUtilisateur = "", $prenom = "", $nom = "", $age = 18, $ville = "", $universite = "", $mail = "" ) {
            $this->nomUtilisateur = $nomUtilisateur;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->age = $age;
            $this->ville = $ville;
            $this->universite  = $universite ;
            $this->mail = $mail;
        }

        public function getNomUtilisateur() { return $this->nomUtilisateur; }
        public function getPrenom() { return $this->prenom; }
        public function getNom() { return $this->nom; }
        public function getAge() { return $this->age; }
        public function getVille() { return $this->ville; }
        public function getUniversite() { return $this->universite; }
        public function getMail() { return $this->mail; }

    }

?>