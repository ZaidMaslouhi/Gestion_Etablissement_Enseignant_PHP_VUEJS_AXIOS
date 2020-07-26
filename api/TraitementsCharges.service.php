<?php


require_once('classes/Charge.class.php');

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
    $charge = new Charge();
    echo $data = ToJson($charge->getAllCharges());
}

if($action == 'add'){
    $charge = new Charge();
    $res = $charge->getVolHor($_POST['idEnseiCharge']);
    if(($res['SumVolHoraire']+$_POST['VolumeHoraire']) > $res['HeureEnsei']){
        $msg->error = true;
        $msg->message = 'Ce enseignant ne peut pas dépasser '.$res['HeureEnsei'].' heures d\'enseignement par l\'année !!!';
    }
    else if($charge->addCharge($_POST['Semestre'],$_POST['Filiere'], $_POST['Niveau'],
                            $_POST['Module'],$_POST['Matiere'],$_POST['TypeEtude'],
                            $_POST['VolumeHoraire'],$_POST['DepartementAttacher'],
                            $_POST['idEnseiCharge'])){
        $msg->error = false;
        $msg->message = 'Ajouter avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'insertion !!";
    }
    echo json_encode($msg);
}


if($action == 'update'){
    $res;
    $charge = new Charge();
    $arr = $charge->getVolHor($_POST['idEnseiCharge'],$_POST['idCharges']);
    ($arr['idEnseiCharge'] == $_POST['idEnseiCharge'])? 
        $res = ($arr['SumVolHoraire'] - $arr['VolumeHoraire']) + $_POST['VolumeHoraire']
        :
        $res = $arr['SumVolHoraire'] + $_POST['VolumeHoraire'];
    
    if($res > $arr['HeureEnsei']){
        $msg->error = true;
        $msg->message = $res . 'Ce enseignant ne peut pas dépasser '.$arr['HeureEnsei'].' heures d\'enseignement par l\'année !!!';
    }
    else if($charge->updateCharge($_POST['idCharges'],$_POST['Semestre'],$_POST['Filiere'],
                            $_POST['Niveau'],$_POST['Module'],$_POST['Matiere'],
                            $_POST['TypeEtude'],$_POST['VolumeHoraire'],$_POST['DepartementAttacher'],
                            $_POST['idEnseiCharge'])){
        $msg->error = false;
        $msg->message = 'Modifier avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'modification !! ";
    }
    echo json_encode($msg);
}

if($action == 'delete'){
    $charge = new Charge();
    if($charge->deleteCharge($_POST['idCharges'])){
        $msg->error = false;
        $msg->message = 'Supprimer avec succes';
    }else{
        $msg->error = true;
        $msg->message = "Erreur de l'suppression !!";
    }
    echo json_encode($msg);
}



?>

