<?php

require '../BD.inc.php';

$newDateDebut = $_POST['NewDateDebut'];
$newDateFin = $_POST['NewDateFin'];
$idProjet = $_POST['idProjet'];
$newNom = $_POST['NewNom'];

if (isset($newDateDebut) && isset($newDateFin) && isset($idProjet)&&isset($newNom)) {


    $sql1 = "SELECT id_demande FROM projets WHERE ID= ?;";

    $stmt = $conn->prepare($sql1);
    $stmt->execute([$idProjet]);
    $reponse = $stmt->fetch();
    $idDemande = $reponse['id_demande'];

    $sql1 = "SELECT * FROM demandes WHERE ID= ?;";

    $stmt = $conn->prepare($sql1);
    $stmt->execute([$idDemande]);
    $oldDemande = $stmt->fetch();


    $sql = "INSERT INTO demandes(userID,programme,destination,dateD,dateR,precisionDestination,titre,etat,raison_refus) 
    values(".$oldDemande['userID'].",".$oldDemande['programme'].",'".$oldDemande['destination']."','".$newDateDebut."','".$newDateFin."','".$oldDemande['precisionDestination']."','".$newNom."',0,'".$oldDemande['raison_refus']."')";
    $stmt= $conn->prepare($sql);
    $stmt->execute();

    //$stmt->execute(array(':userID' => $oldDemande['userID'], ':programme'=> $oldDemande['programme'],':destination'=> $oldDemande['destination'], ':dateD'=> $newDateDebut,':dateR'=> $newDateFin,':precisionDestination'=> $newDateDebut,':titre' => $newNom,
   //     ':raison_refus' => $oldDemande['raison_refus'],':date_changement_etat' => $oldDemande['date_changement_etat'],':file_path' => $oldDemande['file_path']));



    echo 'success';
} else {
    echo 'error';
}
$conn = null;