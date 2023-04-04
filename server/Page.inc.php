<?php

    class Page {

        private $nomutilisateur;
        private $idportfolio;
        private $idpage;
        private $jsonpage;

        public function __construct( $nomutilisateur = "", $idportfolio = 1, $idpage = 1, $jsonpage = "" ) {
            $this->nomutilisateur = $nomutilisateur;
            $this->idportfolio = $idportfolio;
            $this->idpage = $idpage;
            $this->jsonpage = $jsonpage;
        }

        public function getNomUtilisateur() { return $this->nomutilisateur; }
        public function getIdPortfolio() { return $this->idportfolio; }
        public function getIdPage() { return $this->idpage; }
        public function getJson() { return $this->jsonpage; }
    }

?>