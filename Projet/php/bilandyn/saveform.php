<?php
require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!empty($_SESSION["idprojet"])) {
  $arr_questions = array();
  $arr_questions = json_decode($_POST['questions']);


  $query = "DELETE FROM bilan_projet_question where projetID = :projetID";
  $stmt = $conn->prepare($query);
  $stmt->execute(array(':projetID' => $_SESSION["idprojet"]));

  $query = "INSERT INTO bilan_projet_question (projetID, questionID, pourprof, pouretu, required, ordre) values (:projetID, :questionID, :pourprof, :pouretu, :required, NOW(3))";
  $stmt = $conn->prepare($query);

  for ($i=0; $i < count($arr_questions); $i++) {
    $stmt->execute(array(':projetID' => $_SESSION["idprojet"], ':questionID' => $arr_questions[$i]->id_question, ':pourprof' => $arr_questions[$i]->pourprof, ':pouretu' => $arr_questions[$i]->pouretu, ':required' => $arr_questions[$i]->required));
  }

  echo "success";

} else {
  echo "error_no_proj";
}

$conn = null;
