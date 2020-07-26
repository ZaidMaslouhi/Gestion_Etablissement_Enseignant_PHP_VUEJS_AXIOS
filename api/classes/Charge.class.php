<?php

require_once('Connexion.class.php');

class Charge{

    private $id;
    private $semestre;
    private $filiere;
    private $niveau;
    private $module;
    private $matiere;
    private $type;
    private $volmHoraire;
    private $depart;
    private $idEnsei;
    private $con = null;

    function __construct($id=null,$semestre=null,$filiere=null,$niveau=null,$module=null,
                        $matiere=null,$type=null,$volmHoraire=null,$depart=null,
                        $idEnsei=null)
    {
        $this->id = $id;
        $this->semestre = $semestre;
        $this->filiere = $filiere;
        $this->niveau = $niveau;
        $this->module = $module;
        $this->matiere = $matiere;
        $this->type = $type;
        $this->volmHoraire = $volmHoraire;
        $this->depart = $depart;
        $this->idEnsei = $idEnsei;
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

    public function getSemestre()
    {
        return $this->semestre;
    }

    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getFiliere()
    {
        return $this->filiere;
    }

    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    public function getMatiere()
    {
        return $this->matiere;
    }

    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

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

    public function getVolmHoraire()
    {
        return $this->volmHoraire;
    }

    public function setVolmHoraire($volmHoraire)
    {
        $this->volmHoraire = $volmHoraire;

        return $this;
    }

    public function getDepart()
    {
        return $this->depart;
    }

    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    public function getIdEnsei()
    {
        return $this->idEnsei;
    }

    public function setIdEnsei($idEnsei)
    {
        $this->idEnsei = $idEnsei;

        return $this;
    }

    public function getAllCharges()
    {
        $query = 'SELECT ch.*,NomEnsei FROM chargesensperm ch join enseignants ens
                    on ch.idEnseiCharge = ens.idEnsei WHERE ens.TypeEnsei="Permanent"
                    ORDER by idCharges';
        return $this->con->query($query);
    }

    public function getVolHor($idEns,$idCharg = null)
    {
        $arr = [];
        $query1 = 'SELECT SUM(VolumeHoraire)as "SumVolHoraire",ens.HeureEnsei 
                    FROM chargesensperm join enseignants ens
                    ON idEnseiCharge = ens.idEnsei WHERE idEnseiCharge=' . $idEns;
        $arr = array_merge($arr,$this->con->query($query1)->fetch_assoc());
        if($idCharg){
            $query2 = "SELECT VolumeHoraire,idEnseiCharge from chargesensperm 
                        WHERE idCharges=" . $idCharg;
            $arr = array_merge($arr,$this->con->query($query2)->fetch_assoc());
        }
        return $arr;
    }

    public function addCharge($semestre,$filiere,$niveau,$module,$matiere,$type,
                            $volmHoraire,$depart,$idEnsei){
        if($semestre) $this->setSemestre($semestre);
        if($filiere) $this->setFiliere($filiere);
        if($niveau) $this->setNiveau($niveau);
        if($module) $this->setModule($module);
        if($matiere) $this->setMatiere($matiere);
        if($type) $this->settype($type);
        if($volmHoraire) $this->setVolmHoraire($volmHoraire);
        if($depart) $this->setDepart($depart);
        if($idEnsei) $this->setIdEnsei($idEnsei);

        $query = 'INSERT INTO chargesensperm VALUES(null,"'.$this->semestre.'","'.$this->filiere.'","'.$this->niveau.'","'.$this->module.'","'.$this->matiere.'","'.$this->type.'",'.$this->volmHoraire.',"'.$this->depart.'",'.$this->idEnsei.')';
        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCharge($id,$semestre,$filiere,$niveau,$module,$matiere,$type,
                                        $volmHoraire,$depart,$idEnsei){
        if($id) $this->setId($id);
        if($semestre) $this->setSemestre($semestre);
        if($filiere) $this->setFiliere($filiere);
        if($niveau) $this->setNiveau($niveau);
        if($module) $this->setModule($module);
        if($matiere) $this->setMatiere($matiere);
        if($type) $this->settype($type);
        if($volmHoraire) $this->setVolmHoraire($volmHoraire);
        if($depart) $this->setDepart($depart);
        if($idEnsei) $this->setIdEnsei($idEnsei);
        
        $query = 'UPDATE chargesensperm SET Semestre="'.$this->semestre.'",Filiere="'.$this->filiere.'"
        ,Niveau="'.$this->niveau.'",Module="'.$this->module.'",Matiere="'.$this->matiere.'",
        TypeEtude="'.$this->type.'",VolumeHoraire='.$this->volmHoraire.',DepartementAttacher="'.$this->depart.'"
        ,idEnseiCharge='.$this->idEnsei.' WHERE idCharges='.$this->id;

        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteCharge($id){
        if($id) $this->setId($id);
        $query = 'DELETE FROM chargesensperm WHERE idCharges='.$this->id;
        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }
}


?>
