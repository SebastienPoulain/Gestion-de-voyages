<?php

require '../BD.inc.php';

if (isset($_POST["q"]) && isset($_POST['statut'])) {

  $question = $_POST["q"];
  $info = $_POST["info"];
  $catQuestion = $_POST["id"];
  $statut = $_POST["statut"];
  $cat = $_POST["cat"];
  $ancienq = $_POST["ancienq"];

    $stmtExist = $conn->prepare("SELECT count(*) from bilan_questions where question = LOWER(:question)");
    $stmtExist->execute(array(':question' => $question));
    $questionCtr = $stmtExist->fetchColumn();

  if($ancienq == $question){
    $questionCtr = 0;
  }


    if ($questionCtr == 0) {

      $stmtExist = $conn->prepare("UPDATE bilan_questions set question = :question,info_sup = :info,actif = :statut,id_categorie = :idCat where id = :idQuestion");
      $stmtExist->execute(array(':question' => $question,':info' => $info,':statut' => $statut,':idCat' => $cat,':idQuestion' => $catQuestion));

echo "La question a été modifiée avec succès";

    } else {
        echo "La question entrée existe déjà";
    }
}
else{
  echo "error";
}

$conn = null;
