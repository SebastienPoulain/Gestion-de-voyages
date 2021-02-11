<?php

require 'BD.inc.php';

if (isset($_POST['nomCat'])) {
    $nomCat = $_POST['nomCat'];

    $stmtExist = $conn->prepare("SELECT count(*) from categories where categorie = LOWER(:cat)");
    $stmtExist->execute(array(':cat' => $nomCat));
    $catCtr = $stmtExist->fetchColumn();

    if ($catCtr == 0) {
        $sql = "INSERT INTO categories(categorie) values(:nomCat)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':nomCat' => $nomCat));
        echo "success";
    } else {
        echo "error_user_exists";
    }
} else {
    echo "error";
}

$conn = null;
