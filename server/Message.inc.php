<?php

class Message {
      private $titre;
      private $auteur;
      private $email;
      private $date;
      private $texte;


        public function __construct($titre, $auteur, $email, $date, $texte) {
                $this->titre = $titre;
                $this->auteur = $auteur;
                $this->email = $email;
                $this->date = $date;
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
                return $this->date;
        }

        public function getTexte() {
                return $this->texte;
        }
}

?>