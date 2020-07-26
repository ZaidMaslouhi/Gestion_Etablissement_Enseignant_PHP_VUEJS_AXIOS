<?php

// use ___PHPSTORM_HELPERS\object;

require_once('classes/Etablissement.class.php');

$action = 'read';
$data;
$msg = (object)[];
if(isset($_GET['action']))  $action = $_GET['action'];

function ToJson($result){
    $res = array();
    while($row = $result->fetch_assoc())
        array_push($res,$row);
    return json_encode($res);
}

if($action == 'read'){
    $res;
    $etab = new Etabissement();
    echo $data = ToJson($etab->getAllEtablissements());
}

if($action == 'add'){
    $etab = new Etabissement();
    if($etab->addEtablissement($_POST['NomEtab'],$_POST['email'],
                                $_POST['tel'],$_POST['adress'],$_POST['ville'])){
        $msg->error = false;
        $msg->message = 'Ajouter avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'insertion !!";
    }
    echo json_encode($msg);
}

if($action == 'update'){
    $etab = new Etabissement();
    if($etab->updateEtablissement($_POST['idEtab'],$_POST['NomEtab'],$_POST['email'],
                                $_POST['tel'],$_POST['adress'],$_POST['ville'])){
        $msg->error = false;
        $msg->message = 'Modifier avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'modification !!";
    }
    echo json_encode($msg);
}

if($action == 'delete'){
    $etab = new Etabissement();
    if($etab->deleteEtablissement($_POST['idEtab'])){
        $msg->error = false;
        $msg->message = 'Supprimer avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'suppression !!";
    }
    echo json_encode($msg);
}



?>
