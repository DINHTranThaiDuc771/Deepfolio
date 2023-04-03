<?php

    class Portfolio {

        private $nomutilisateur;
        private $idportfolio;
        private $nomportfolio;
        private $accesible;

        public function __construct( $nomutilisateur = "", $idportfolio = 1, $nomportfolio = "", $accesible = false ) {
            $this->nomutilisateur = $nomutilisateur;
            $this->idportfolio = $idportfolio;
            $this->nomportfolio = $nomportfolio;
            $this->accesible = $accesible;
        }

        public function getNomPortfolio() { return $this->nomportfolio; }
        public function getNomUtilisateur() { return $this->nomutilisateur; }
        public function getId() { return $this->idportfolio; }
        public function isAccesible() { return $this->accesible; }
    }

?>