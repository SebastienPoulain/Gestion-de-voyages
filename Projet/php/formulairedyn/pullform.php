<?php
require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!empty($_SESSION["idprojet"]) && $_POST['page'] == "formulaire" && $_SESSION['type'] == "A") {
    $query = "SELECT questionID, pourprof, pouretu, required from projets_questions where projetID = :projetID order by ordre;";
    $stmt = $conn->prepare($query);
    $stmt->execute(array(':projetID' => $_SESSION["idprojet"]));

    echo json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
} elseif (!empty($_SESSION["idprojet"])) {
    $arr_questions = array();

    if ($_POST['page'] == "viewformulaire"){
      $query = "SELECT type from utilisateurs where id = :id;";
      $stmt = $conn->prepare($query);
      $stmt->execute(array(':id' => $_SESSION['selectedetu']));
      $type = $stmt->fetch()['type'];
    } else {
      $type = $_SESSION['type'];
    }

    if ($type == "E") {
        $query = "SELECT questionID, required from projets_questions where projetID = :projetID and pouretu = 1 order by ordre;";
    } else {
        $query = "SELECT questionID, required from projets_questions where projetID = :projetID and pourprof = 1 order by ordre;";
    }

    $stmt = $conn->prepare($query);
    $stmt->execute(array(':projetID' => $_SESSION["idprojet"]));

    while ($row = $stmt->fetch()) {
        $query = "SELECT * FROM questions where id = :id;";
        $stmt1 = $conn->prepare($query);
        $stmt1->execute(array(':id' => $row['questionID']));
        $question = $stmt1->fetch(\PDO::FETCH_ASSOC);
        $question['required'] = $row['required'];

        array_push($arr_questions, $question);
    }

    echo json_encode($arr_questions);
} else {
    echo "error";
}

$conn = null;
