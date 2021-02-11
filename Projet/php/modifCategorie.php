<?php

require 'BD.inc.php';

if (isset($_POST['nomCat'])) {
    $nomCat = $_POST['nomCat'];
    $ancienNomCat = $_POST['ancienNomCat'];


        $stmtExist = $conn->prepare("SELECT count(*) from categories where categorie = LOWER(:cat)");
        $stmtExist->execute(array(':cat' => $nomCat));
        $catCtr = $stmtExist->fetchColumn();

        if ($catCtr == 0) {
        $sql = "UPDATE categories set categorie = :nomCat where categorie = :ancienNomCat";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':nomCat' => $nomCat,':ancienNomCat' => $ancienNomCat));
        echo "success";
      } else {
          echo "error_user_exists";
      }
} else {
    echo "error";
}

$conn = null;
