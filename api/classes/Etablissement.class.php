<?php

require_once('Connexion.class.php');

class Etabissement{

    private $id;
    private $name;
    private $email;
    private $tel;
    private $adress;
    private $ville;
    private $con = null;

    function __construct($id=null, $name=null, $email=null, $tel=null, $adress=null, $ville=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->tel = $tel;
        $this->adress = $adress;
        $this->ville = $ville;
        $this->con = Connexion::SeConnecter();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }


    public function getAllEtablissements()
    {
        $query = 'SELECT * FROM etablissements ORDER by idEtab';
        return $this->con->query($query);
    }

    // public function getOneEtablissement($id)
    // {
    //     $this->setId($id);
    //     $query = 'SELECT * FROM etablissements WHERE idEtab=' . $this->id;
    //     return $this->con->query($query);
    // }

    public function addEtablissement($name,$email,$tel,$adress,$ville){
        if($name) $this->setName($name);
        if($email) $this->setEmail($email);
        if($tel) $this->setTel($tel);
        if($adress) $this->setAdress($adress);
        if($ville) $this->setVille($ville);
        $query = 'INSERT INTO etablissements(NomEtab,email,tel,adress,ville) 
                    VALUES("'.$this->name.'","'.$this->email.'",'.$this->tel.',
                            "'.$this->adress.'","'.$this->ville.'")';
        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEtablissement($id,$name,$email,$tel,$adress,$ville){
        if($id) $this->setId($id);
        if($name) $this->setName($name);
        if($email) $this->setEmail($email);
        if($tel) $this->setTel($tel);
        if($adress) $this->setAdress($adress);
        if($ville) $this->setVille($ville);
        $query = 'UPDATE etablissements SET NomEtab="'.$this->name.'", email="'.$this->email.'",
                    tel='.$this->tel.', adress="'.$this->adress.'", ville="'.$this->ville.'"
                    WHERE idEtab='.$this->id;
        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEtablissement($id){
        if($id) $this->setId($id);
        $query = 'DELETE FROM etablissements WHERE idEtab='.$this->id;
        if ($this->con->query($query)) {
            return true;
        } else {
            return false;
        }
    }


}


?>
