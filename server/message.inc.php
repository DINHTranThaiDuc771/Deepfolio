<?php

class Message {
      private $titre;
      private $auteur;
      private $email;
      private $datep;
      private $texte;


        public function __construct($titre, $auteur, $email, $dateP, $texte) {
                $this->titre = $titre;
                $this->auteur = $auteur;
                $this->email = $email;
                $this->dateP = $dateP;
                $this->texte = $texte;
        }

        public function getTitre() {
                return $this->titre;
        }

        public function getAuteur() {
                return $this->auteur;
        }

        public function getEmail() {
                return $this->email;
        }

        public function getDateP() {
                return $this->dateP;
        }

        public function getTexte() {
                return $this->texte;
        }
        
        public function __toString(){
                return 
                "<article><h3>Titre: "         .$this->titre    ."</h3>".
                "\n<h4>auteur: "        .$this->auteur   ." - ". 
                "\nDate: "              .$this->dateP    ."</h4>".
                "\e<h5>mail: "          .$this->email    ."</h5>".                
                "\n<p>texte: "          .$this->texte    ."</p></article>";   
        }

}

?>