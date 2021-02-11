<?php

require 'BD.inc.php';

if (isset($_POST['nomProg'])) {
    $nomProg = $_POST['nomProg'];
    $ancienNomProg = $_POST['ancienNomProg'];


        $stmtExist = $conn->prepare("SELECT count(*) from programmes where nom_programme = LOWER(:prog)");
        $stmtExist->execute(array(':prog' => $nomProg));
        $progCtr = $stmtExist->fetchColumn();

        if ($progCtr == 0) {
        $sql = "UPDATE programmes set nom_programme = :nomProg where nom_programme = :ancienNomProg";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':nomProg' => $nomProg,':ancienNomProg' => $ancienNomProg));
        echo "success";
      } else {
          echo "error_user_exists";
      }
} else {
    echo "error";
}

$conn = null;
