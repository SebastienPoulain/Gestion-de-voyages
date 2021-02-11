<?php
require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if(!empty(trim($_POST['nom'])) && !empty(trim($_POST['prenom'])) && !empty(trim($_POST['courriel'])) && !empty(trim($_POST['reglements'])) && !empty(trim($_POST['politiques'])) && !empty(trim($_POST['compagnieassmal'])) && !empty(trim($_POST['numassmal'])) && !empty(trim($_POST['adressecompagniemal'])) && !empty(trim($_POST['telcompagniemal'])) && !empty(trim($_POST['telurgcompagniemal'])) && !empty(trim($_POST['courrielcompagniemal'])) && !empty(trim($_POST['compagnieassbag'])) && !empty(trim($_POST['numassbag'])) && !empty(trim($_POST['adressecompagniebag'])) && !empty(trim($_POST['telcompagniebag'])) && !empty(trim($_POST['courrielcompagniebag'])) && !empty(trim($_POST['adresseamb'])) && !empty(trim($_POST['telamb'])) && !empty(trim($_POST['courrielamb']))   ){
echo'je suis dans le if';
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $courriel = $_POST['courriel'];
  $sexe = $_POST['sexe'];
  $datenaissance = $_POST['datenaissance'];
  $reglements = $_POST['reglements'];
  $politiques = $_POST['politiques'];
  $compagnieassmal = $_POST['compagnieassmal'];
  $numassmal = $_POST['numassmal'];
  $adressecompagniemal = $_POST['adressecompagniemal'];
  $telcompagniemal = $_POST['telcompagniemal'];
  $telurgcompagniemal = $_POST['telurgcompagniemal'];
  $courrielcompagniemal = $_POST['courrielcompagniemal'];
  $compagnieassbag = $_POST['compagnieassbag'];
  $numassbag = $_POST['numassbag'];
  $adressecompagniebag = $_POST['adressecompagniebag'];
  $telcompagniebag = $_POST['telcompagniebag'];
  $courrielcompagniebag = $_POST['courrielcompagniebag'];
  $adresseamb = $_POST['adresseamb'];
  $telamb = $_POST['telamb'];
  $courrielamb = $_POST['courrielamb'];
  $taSante = $_POST['taSante'];
  $taMedications = $_POST['taMedications'];
  $taAllergies = $_POST['taAllergies'];



if ($politiques == 'on')
$politiques = 1;
if ($politiques == 'off')
$politiques = 0;
if ($reglements == 'on')
$reglements = 1;
if ($reglements == 'off')
$reglements = 0;


  $strarCoorDuEtu = $_POST['arCoorDuEtu'];
  $strarCoorAuEtu = $_POST['arCoorAuEtu'];
  $strarCoorAdEtu = $_POST['arCoorAdEtu'];
  $strarCoorTelEtu = $_POST['arCoorTelEtu'];

  $strarCoorDuRes = $_POST['arCoorDuRes'];
  $strarCoorAuRes = $_POST['arCoorAuRes'];
  $strarCoorAdRes = $_POST['arCoorAdRes'];
  $strarCoorTelRes = $_POST['arCoorTelRes'];

  $strarCoorDuPro = $_POST['arCoorDuPro'];
  $strarCoorAuPro = $_POST['arCoorAuPro'];
  $strarCoorAdPro = $_POST['arCoorAdPro'];
  $strarCoorTelPro = $_POST['arCoorTelPro'];

  $strarVaccin = $_POST['arVaccin'];
  $strarValeurVaccin =  $_POST['arValeurVaccin'];

  $arCoorDuEtu = explode(",",$strarCoorDuEtu);
  $arCoorAuEtu = explode(",",$strarCoorAuEtu);
  $arCoorAdEtu = explode(",",$strarCoorAdEtu);
  $arCoorTelEtu = explode(",",$strarCoorTelEtu);

  $arCoorDuRes = explode(",",$strarCoorDuRes);
  $arCoorAuRes = explode(",",$strarCoorAuRes);
  $arCoorAdRes = explode(",",$strarCoorAdRes);
  $arCoorTelRes = explode(",",$strarCoorTelRes);

  $arCoorDuPro = explode(",",$strarCoorDuPro);
  $arCoorAuPro = explode(",",$strarCoorAuPro);
  $arCoorAdPro = explode(",",$strarCoorAdPro);
  $arCoorTelPro = explode(",",$strarCoorTelPro);

  $arVaccin = explode(",",$strarVaccin);
  $arValeurVaccin = explode(",",$strarValeurVaccin);

  $sql = "INSERT INTO formulaires_etudiants (userid, projetid, nom, prenom, courriel, sexe, datenaissance) values (:id, :projID, :nom, :prenom, :courriel, :sexe, :datenaissance);";
  $req = $conn->prepare($sql);
  $req->execute(array(':id' => $_SESSION['userID'], ':projID' => $_SESSION['idprojet'], ':nom' => $nom, ':prenom' => $prenom, ':courriel' => $courriel, ':sexe' => $sexe, ':datenaissance' => $datenaissance));

  $sql = "SELECT id_formulaire FROM formulaires_etudiants ORDER BY date_creation DESC LIMIT 1;";
  $req = $conn->prepare($sql);
  $req->execute();
  $id = $req->fetch();

  $sql = "INSERT INTO form_eng (id_formulaire, politiques, reglements) values (:id, :politiques, :reglements);";
  $req = $conn->prepare($sql);
  $req->execute(array(':id' => $id[0], ':politiques' => $politiques, ':reglements' => $reglements));




echo'je suis avant les COORDONNÉES';
  for ($ctr = 0; $ctr < count($arCoorDuEtu); $ctr++ ){

  $sql = "INSERT INTO form_coor_etu (id_formulaire, dateDu, dateAu, adresse, telephone) VALUES (:id, :dateDu, :dateAu, :adresse, :telephone);";
  $req = $conn->prepare($sql);
  $req->execute(array(':id' => $id['id_formulaire'], ':dateDu' => $arCoorDuEtu[$ctr], ':dateAu' => $arCoorAuEtu[$ctr], ':adresse' => $arCoorAdEtu[$ctr], ':telephone' => $arCoorTelEtu[$ctr]));

  }

  for ($ctr2 = 0; $ctr2 < count($arCoorDuRes); $ctr2++ ){

  $sql = "INSERT INTO form_coor_res (id_formulaire, dateDu, dateAu, adresse, telephone) VALUES (:id, :dateDu, :dateAu, :adresse, :telephone);";
  $req = $conn->prepare($sql);
  $req->execute(array(':id' => $id['id_formulaire'], ':dateDu' => $arCoorDuRes[$ctr2], ':dateAu' => $arCoorAuRes[$ctr2], ':adresse' => $arCoorAdRes[$ctr2], ':telephone' => $arCoorTelRes[$ctr2]));

  }

  for ($ctr3 = 0; $ctr3 < count($arCoorDuPro); $ctr3++ ){

  $sql = "INSERT INTO form_coor_pro (id_formulaire, dateDu, dateAu, adresse, telephone) VALUES (:id, :dateDu, :dateAu, :adresse, :telephone);";
  $req = $conn->prepare($sql);
  $req->execute(array(':id' => $id['id_formulaire'], ':dateDu' => $arCoorDuPro[$ctr3], ':dateAu' => $arCoorAuPro[$ctr3], ':adresse' => $arCoorAdPro[$ctr3], ':telephone' => $arCoorTelPro[$ctr3]));

  }

echo'je suis avant les assurances';
/* COMPAGNIE ASS MAL */
$sql = "INSERT INTO form_ass_mal (id_formulaire, nom, num, adresse, tel, telurg, courriel) values (:id, :compagnieassmal, :numassmal, :adressecompagniemal, :telcompagniemal, :telurgcompagniemal, :courrielcompagniemal);";
$req = $conn->prepare($sql);
$req->execute(array(':id' => $id['id_formulaire'], ':compagnieassmal' => $compagnieassmal, ':numassmal' => $numassmal, ':adressecompagniemal' => $adressecompagniemal, ':telcompagniemal' => $telcompagniemal, ':telurgcompagniemal' => $telurgcompagniemal, ':courrielcompagniemal' => $courrielcompagniemal ));
/* COMPAGNIE ASS BAG */
$sql = "INSERT INTO form_ass_bag (id_formulaire, nom, num, adresse, tel, courriel) values (:id, :compagnieassbag, :numassbag, :adressecompagniebag, :telcompagniebag, :courrielcompagniebag);";
$req = $conn->prepare($sql);
$req->execute(array(':id' => $id['id_formulaire'], ':compagnieassbag' => $compagnieassbag, ':numassbag' => $numassbag, ':adressecompagniebag' => $adressecompagniebag, ':telcompagniebag' => $telcompagniebag, ':courrielcompagniebag' => $courrielcompagniebag ));
/* AMBASSADE */
$sql = "INSERT INTO form_amb (id_formulaire, adresse, tel, courriel) values (:id, :adresseamb, :telamb, :courrielamb);";
$req = $conn->prepare($sql);
$req->execute(array(':id' => $id['id_formulaire'], ':adresseamb' => $adresseamb, ':telamb' => $telamb, ':courrielamb' => $courrielamb ));

/* ETAT DE SANTE */
$sql = "INSERT INTO form_sante (id_formulaire, etat_sante, medications, allergies) values (:id, :taSante, :taMedications, :taAllergies);";
$req = $conn->prepare($sql);
$req->execute(array(':id' => $id['id_formulaire'], ':taSante' => $taSante, ':taMedications' => $taMedications, ':taAllergies' => $taAllergies ));
echo'je suis avant les vaccins';
/*  VACCINS */
for ($ctr4 = 0; $ctr4 < count($arVaccin); $ctr4++ ){

$sql = "INSERT INTO form_vaccins (id_formulaire, id_vaccin, valeur_vaccin ) VALUES (:id, :id_vaccin, :valeur_vaccin);";
$req = $conn->prepare($sql);
$req->execute(array(':id' => $id['id_formulaire'], ':id_vaccin' => $arVaccin[$ctr4], ':valeur_vaccin' => $arValeurVaccin[$ctr4]));

}




echo 'success';

}

else{
   echo 'error';
}


$conn = null;
