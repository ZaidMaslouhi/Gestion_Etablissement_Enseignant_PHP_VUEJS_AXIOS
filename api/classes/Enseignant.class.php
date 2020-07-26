<?php

require_once('Connexion.class.php');

class Enseignant{

    private $id;
    private $lastName;
    private $firstName;
    private $grade;
    private $type;
    private $heuresEnseignement;
    private $prixHeure;
    private $idEtab;
    private $con = null;

    function __construct($id=null,$lastName=null,$firstName=null,$grade=null,$type=null,
                        $heuresEnseignement=null,$prixHeure=null,$idEtab=null)
    {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->grade = $grade;
        $this->type = $type;
        $this->heuresEnseignement = $heuresEnseignement;
        $this->prixHeure = $prixHeure;
        $this->idEtab = $idEtab;
        $this->con = Connexion::SeConnecter(); 
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getlastName()
    {
        return $this->lastName;
    }

    public function setlastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getfirstName()
    {
        return $this->firstName;
    }

    public function setfirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getHeuresEnseignement()
    {
        return $this->heuresEnseignement;
    }

    public function setHeuresEnseignement($heuresEnseignement)
    {
        $this->heuresEnseignement = $heuresEnseignement;

        return $this;
    }

    public function getPrixHeure()
    {
        return $this->prixHeure;
    }

    public function setPrixHeure($prixHeure)
    {
        $this->prixHeure = $prixHeure;

        return $this;
    }

    public function getIdEtab()
    {
        return $this->idEtab;
    }

    public function setIdEtab($idEtab)
    {
        $this->idEtab = $idEtab;

        return $this;
    }

    public function getAllEnseignants(){
        $query = 'SELECT ens.*,NomEtab FROM enseignants ens join etablissements etb
                    on ens.idEtabEnsei = etb.idEtab ORDER by idEnsei';
        return $this->con->query($query);
    }

    // public function getOneEnseignant($id){
    //     if($id) $this->setId($id);
    //     $query = 'SELECT * FROM enseignants WHERE idEnsei=' . $this->id;
    //     return $this->con->query($query);
    // }

    public function addEnseignant($lastName,$firstName,$grade,$type,$heurEns,$prixHeure,$idEtab){
        if($lastName) $this->setlastName($lastName);
        if($firstName) $this->setfirstName($firstName);
        if($grade) $this->setGrade($grade);
        if($type) $this->settype($type);
        if($heurEns) $this->setHeuresEnseignement($heurEns);
        if($prixHeure) $this->setPrixHeure($prixHeure);
        if($idEtab) $this->setIdEtab($idEtab);
        $query = 'INSERT INTO enseignants(NomEnsei,PreNomEnsei,Grade,TypeEnsei,HeureEnsei,prixHeure,idEtabEnsei)
                    VALUES("'.$this->lastName.'","'.$this->firstName.'","'.$this->grade.'"
                    ,"'.$this->type.'",'.$this->heuresEnseignement.','.$this->prixHeure.','.$this->idEtab.')';
        
        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEnseignant($id,$lastName,$firstName,$grade,$type,$heurEns,$prixHeure,$idEtab){
        if($id) $this->setId($id);
        if($lastName) $this->setlastName($lastName);
        if($firstName) $this->setfirstName($firstName);
        if($grade) $this->setGrade($grade);
        if($type) $this->settype($type);
        if($heurEns) $this->setHeuresEnseignement($heurEns);
        if($prixHeure) $this->setPrixHeure($prixHeure);
        if($idEtab) $this->setIdEtab($idEtab);

        $query = 'UPDATE enseignants SET NomEnsei="'.$this->lastName.'",PreNomEnsei="'.$this->firstName.'"
                    ,Grade="'.$this->grade.'",TypeEnsei="'.$this->type.'",HeureEnsei='.$this->heuresEnseignement.'
                    ,prixHeure='.$this->prixHeure.',idEtabEnsei='.$this->idEtab.' WHERE idEnsei=' . $this->id;

        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEnseignant($id){
        if($id) $this->setId($id);
        $query = 'DELETE FROM enseignants WHERE idEnsei=' . $this->id;
        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }

}

?>