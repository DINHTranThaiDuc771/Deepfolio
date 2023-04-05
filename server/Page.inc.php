<?php

    class Page implements JsonSerializable {

        private $nomutilisateur;
        private $idportfolio;
        private $idpage;
        private $jsonpage;
        private $type;

        public function __construct( $nomutilisateur = "", $idportfolio = 1, $idpage = 1, $jsonpage = "", $type = "") {
            $this->nomutilisateur = $nomutilisateur;
            $this->idportfolio = $idportfolio;
            $this->idpage = $idpage;
            $this->jsonpage = $jsonpage;
            $this->type = $type;
        }

        public function getNomUtilisateur() { return $this->nomutilisateur; }
        public function getIdPortfolio()    { return $this->idportfolio; }
        public function getIdPage()         { return $this->idpage; }
        public function getJson()           { return $this->jsonpage; }
        public function getType()           { return $this->type; }


        public function jsonSerialize() {
            return [
                "nomutilisateur" => $this->nomutilisateur,
                "idportfolio"    => $this->idportfolio,
                "idpage"         => $this->idpage,
                "jsonpage"       => $this->jsonpage,
                "type"           => $this->type
            ];
        }

    }

?>