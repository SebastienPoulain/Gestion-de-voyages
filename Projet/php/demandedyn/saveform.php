<?php
require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  $arr_questions = array();
  $arr_questions = json_decode($_POST['questions']);


  $query = "DELETE FROM demandes_form";
  $stmt = $conn->prepare($query);
  $stmt->execute();

  $query = "INSERT INTO demandes_form (questionID, required, ordre) values (:questionID, :required, NOW(3))";
  $stmt = $conn->prepare($query);

  for ($i=0; $i < count($arr_questions); $i++) {
    $stmt->execute(array(':questionID' => $arr_questions[$i]->id_question, ':required' => $arr_questions[$i]->required));
  }

  echo "success";

$conn = null;
