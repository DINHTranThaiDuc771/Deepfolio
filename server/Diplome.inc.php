<?php


class Diplome implements JsonSerializable{

    private $nom;
    private $etablissement;
    private $anneeObtention;

    public function __construct($nom = "", $etablissement = "", $anneeObtention = "") {
        $this->nom = $nom;
        $this->etablissement = $etablissement;
        $this->anneeObtention = $anneeObtention;
    }

    //--------------GETTERS--------------//

    public function getNom() { return $this->nom; }

    public function getEtablissement() { return $this->etablissement; }

    public function getAnneeObtention() { return $this->anneeObtention; }

    //--------------SETTERS--------------//

    public function setNom($nom) { $this->nom = $nom; }

    public function setEtablissement($etablissement) { $this->etablissement = $etablissement; }

    public function setAnneeObtention($anneeObtention) { $this->anneeObtention = $anneeObtention; }


    public function jsonSerialize()
    {
        return [
            "poste"           => $this->nom,
            "etablissement"      => $this->etablissement,
            "anneeObtention"       =>$this->anneeObtention
        ];
    }
}
?>
