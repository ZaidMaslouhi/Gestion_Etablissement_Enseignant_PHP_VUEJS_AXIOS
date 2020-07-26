<?php

// use ___PHPSTORM_HELPERS\object;

require_once('classes/Enseignant.class.php');

$action = 'read';
$data;
$msg = (object)[];

function ToJson($result){
    $res = array();
    while($row = $result->fetch_assoc())
        array_push($res,$row);
    return json_encode($res);
}

if(isset($_GET['action']))  $action = $_GET['action'];

if($action == 'read'){
    $res;
    $ensg = new Enseignant();
    echo $data = ToJson($ensg->getAllEnseignants());
}

if($action == 'add'){
    $ensg = new Enseignant();
    if($ensg->addEnseignant($_POST['NomEnsei'],$_POST['PreNomEnsei']
                            ,$_POST['Grade'],$_POST['TypeEnsei'],$_POST['HeureEnsei']
                            ,$_POST['PrixHeure'],$_POST['idEtabEnsei'])){
        $msg->error = false;
        $msg->message = 'Ajouter avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'insertion !!";
    }
    echo json_encode($msg);
}

if($action == 'update'){
    $ensg = new Enseignant();
    if($ensg->updateEnseignant($_POST['idEnsei'],$_POST['NomEnsei'],$_POST['PreNomEnsei']
                                ,$_POST['Grade'],$_POST['TypeEnsei'],$_POST['HeureEnsei']
                                ,$_POST['PrixHeure'],$_POST['idEtabEnsei'])){
        $msg->error = false;
        $msg->message = 'Modifier avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'modification !!";
    }
    echo json_encode($msg);
}

if($action == 'delete'){
    $ensg = new Enseignant();
    if($ensg->deleteEnseignant($_POST['idEnsei'])){
        $msg->error = false;
        $msg->message = 'Supprimer avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'suppression !!";
    }
    echo json_encode($msg);
}



?>
