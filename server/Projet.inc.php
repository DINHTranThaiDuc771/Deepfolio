<?php


class Projet implements JsonSerializable{

    private $nom;   
    private $description;
    private $tailleEquipe;
    private $lien;
    private $image;

    public function __construct($nom = "", $description = "", $tailleEquipe = "", $lien = "", $image = "") {
        $this->nom = $nom;
        $this->description = $description;
        $this->tailleEquipe = $tailleEquipe;
        $this->lien = $lien;
        $this->image = $image;
    }

    //--------------GETTERS--------------//

    public function getNom() { return $this->nom; }

    public function getDescription() { return $this->description; }

    public function getTailleEquipe() { return $this->tailleEquipe; }

    public function getLien() { return $this->lien; }

    public function getImage() { return $this->image; }

    //--------------SETTERS--------------//

    public function setNom($nom) { $this->nom = $nom; }

    public function setDescription($description) { $this->description = $description; }

    public function setTailleEquipe($tailleEquipe) { $this->tailleEquipe = $tailleEquipe; }

    public function setLien($lien) { $this->lien = $lien; }

    public function setImage($image) { $this->image = $image; }

    public function jsonSerialize()
    {
        return [
            "nom"           => $this->nom,
            "description"   => $this->description,
            "taille"        =>$this->tailleEquipe,
            "image"         =>$this->image,
            "lien"          => urlencode($this->lien)
        ];
    }
    
}
?>