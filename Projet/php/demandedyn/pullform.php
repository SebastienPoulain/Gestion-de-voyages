<?php
require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_POST['page'] == "modif" && $_SESSION['type'] == "A") {
    $query = "SELECT questionID, required from demandes_form order by ordre;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
} else {
  $arr_questions = array();

  $query = "SELECT questionID, required from demandes_form order by ordre;";
  $stmt = $conn->prepare($query);
  $stmt->execute();

  while ($row = $stmt->fetch()) {
      $query = "SELECT * FROM demandes_questions where id = :id;";
      $stmt1 = $conn->prepare($query);
      $stmt1->execute(array(':id' => $row['questionID']));
      $question = $stmt1->fetch(\PDO::FETCH_ASSOC);
      $question['required'] = $row['required'];

      array_push($arr_questions, $question);
  }

  echo json_encode($arr_questions);
}
$conn = null;
