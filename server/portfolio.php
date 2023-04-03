<?php

    class Portfolio {

        private $nomUtilisateur;
        private $id;
        private $nomPortfolio;
        private $accesible;

        public function __construct( $nomUtilisateur = "", $id = 1, $nomPortfolio = "", $accesible = false ) {
            $this->nomUtilisateur = $nomUtilisateur;
            $this->id = $id;
            $this->nomPortfolio = $nomPortfolio;
            $this->accesible = $accesible;
        }

        public function getNomPortfolio() { return $this->nomPortfolio; }
        public function getNomUtilisateur() { return $this->nomUtilisateur; }
        public function getId() { return $this->id; }
        public function isAccesible() { return $this->accesible; }
    }

?>