<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data = array();
$id = array();
$titre = array();
$etat = array();
$date = array();
$dateR = array();


if ($_SESSION['type'] == 'A') {

$sql = "SELECT ID,titre,date_remise,etat,dateR from demandes";

    foreach($conn->query($sql) as $row){
      array_push($id, $row['ID']);
      array_push($titre, $row['titre']);
      array_push($date,$row['date_remise']);
      array_push($etat, $row['etat']);

    if ($row['dateR'] < date("Y-m-d")){
      array_push($dateR,false);
    }
    else{
      array_push($dateR,true);
    }

    }
    $data['id'] = $id;
    $data['titre'] = $titre;
    $data['date_remise'] = $date;
    $data['etat'] = $etat;
    $data['dateR'] = $dateR;
}
else if($_SESSION['type'] == 'P'){
  $sql = "SELECT ID,titre,date_remise,etat,dateR from demandes WHERE userID= :userId";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':userId' => $_SESSION['userID']));
    $demandes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
   
        foreach($demandes as $demande){
      array_push($id, $demande['ID']);
      array_push($titre, $demande['titre']);
      array_push($date,$demande['date_remise']);
      array_push($etat, $demande['etat']);

      if ($demande['dateR'] < date("Y-m-d")){
        array_push($dateR,false);
      }
      else{
        array_push($dateR,true);
      }
    }

    $data['id'] = $id;
    $data['titre'] = $titre;
    $data['date_remise'] = $date;
    $data['etat'] = $etat;
    $data['dateR'] = $dateR;
}



echo json_encode($data);

$conn = null;


