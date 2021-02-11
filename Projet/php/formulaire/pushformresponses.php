<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!empty($_POST['responses'])){

  $query = "DELETE FROM reponses WHERE userID = :userID and projetID = :projetID;";
  $stmt = $conn->prepare($query);
  $stmt->execute(array(':userID' => $_SESSION['userID'], ':projetID' => $_SESSION['idprojet']));

  $responses = array();
  $responses = json_decode($_POST['responses']);

  $query = "INSERT INTO reponses(userID, projetID, questionID, reponse) values(:userID, :projetID, :questionID, :reponse);";
  $stmt = $conn->prepare($query);

  for ($i=0; $i < count($responses); $i++) {
    $stmt->execute(array(':userID' => $_SESSION['userID'], ':projetID' => $_SESSION['idprojet'], ':questionID' => $responses[$i]->question, ':reponse' => $responses[$i]->reponse));
  }

  echo json_encode(array('state' => 'success', 'message' => 'Vos réponses ont bien été sauvegardées et envoyées'));

} else {
  echo json_encode(array('state' => 'error', 'message' => 'Erreur, aucune réponse indiquée'));
}

$conn = null;
