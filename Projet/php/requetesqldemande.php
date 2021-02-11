<?php
require 'BD.inc.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!empty(trim($_POST['nom'])) && !empty(trim($_POST['prenom'])) && !empty(trim($_POST['adresse'])) && !empty(trim($_POST['programme'])) && !empty(trim($_POST['destination'])) &&
!empty(trim($_POST['precisionDestination'])) && !empty(trim($_POST['titreProjet'])) && !empty(trim($_POST['description'])) && !empty(trim($_POST['etudiants']))){

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$programme = $_POST['programme'];
$destination = $_POST['destination'];
$dateD = $_POST['dateD'];
$dateR = $_POST['dateR'];
$precisionDestination = $_POST['precisionDestination'];
$titreProjet = $_POST['titreProjet'];
$description = $_POST['description'];
$etudiants = $_POST['etudiants'];
$liberation = $_POST['liberation'];
$acceptation = $_POST['acceptation'];
$recrutement = $_POST['recrutement'];
$strategies = $_POST['strategies'];


$projetDocsId = $_POST['projID'];


$straractivite = $_POST['aractivite'];
$strardateactivite = $_POST['ardateactivite'];
$strarnomacc = $_POST['arnomacc'];
$strarpreacc = $_POST['arpreacc'];
$strartelacc = $_POST['artelacc'];
$strarcouacc = $_POST['arcouacc'];


$aractivite = explode(",",$straractivite);
$ardateactivite = explode(",",$strardateactivite);
$arnomacc = explode(",",$strarnomacc);
$arpreacc = explode(",",$strarpreacc);
$artelacc = explode(",",$strartelacc);
$arcouacc = explode(",",$strarcouacc);


$sql = "INSERT INTO demandes (userID, projetDocsID, Nom, Prenom, adresse, programme, destination,  dateD, dateR, precisionDestination, titre, description, etudiants, liberation, financement, recrutement, strategies, etat) values (:id, :projetDocsID, :nom, :prenom, :adresse, :programme, :destination, :dateD, :dateR, :precisionDestination, :titreProjet, :description, :etudiants, :liberation, :acceptation, :recrutement, :strategies, :etat);";
$req = $conn->prepare($sql);
$req->execute(array(':id' => $_SESSION['userID'] , ':projetDocsID' => $projetDocsId != '-1' ? $projetDocsId : null,':nom' => $nom, ':prenom' => $prenom, ':adresse' => $adresse, ':programme' => $programme, ':destination' => $destination, ':dateD' => $dateD, ':dateR' => $dateR, ':precisionDestination' => $precisionDestination, ':titreProjet' => $titreProjet, ':description' => $description, ':etudiants' => $etudiants, ':liberation' => $liberation, ':acceptation' => $acceptation, ':recrutement' => $recrutement, ':strategies' => $strategies, ':etat' => 0 ));
$sql = "SELECT ID FROM demandes ORDER BY date_creation DESC LIMIT 1;";
$req = $conn->prepare($sql);
$req->execute();
$id = $req->fetch();

for ($ctr = 0; $ctr < count($aractivite); $ctr++ ){

$sql = "INSERT INTO demandes_activites (id_demande, activites, dates) VALUES (:id_demande, :activites, :dates);";
$req = $conn->prepare($sql);
$req->execute(array(':id_demande' => $id['ID'], ':activites' => $aractivite[$ctr], ':dates' => $ardateactivite[$ctr]));

}


for ($ctr = 0; $ctr < count($arnomacc); $ctr++){

  $sql = "INSERT INTO demandes_accompagnateurs (id_demande, nom, prenom, telephone, courriel) VALUES (:id_demande, :nom, :prenom, :telephone, :courriel);";
  $req = $conn->prepare($sql);
  $req->execute(array(':id_demande' => $id['ID'], ':nom' => $arnomacc[$ctr], ':prenom' => $arpreacc[$ctr], ':telephone' => $artelacc[$ctr], 'courriel' => $arcouacc[$ctr]));
}


echo 'success';

}
else echo 'error';

$conn = null;
