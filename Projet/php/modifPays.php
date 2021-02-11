<?php

require 'BD.inc.php';

if (isset($_POST['nomPays'])) {
    $nomPays = $_POST['nomPays'];
    $ancienNomPays = $_POST['ancienNomPays'];


        $stmtExist = $conn->prepare("SELECT count(*) from pays where fr = LOWER(:pays)");
        $stmtExist->execute(array(':pays' => $nomPays));
        $paysCtr = $stmtExist->fetchColumn();

        if ($paysCtr == 0) {
        $sql = "UPDATE pays set fr = :nomPays where fr = :ancienNomPays";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':nomPays' => $nomPays,':ancienNomPays' => $ancienNomPays));
        echo "success";
      } else {
          echo "error_user_exists";
      }
} else {
    echo "error";
}

$conn = null;
