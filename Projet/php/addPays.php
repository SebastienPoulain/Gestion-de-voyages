<?php

require 'BD.inc.php';

if (isset($_POST['nomPays'])) {
    $nomPays = $_POST['nomPays'];

    $stmtExist = $conn->prepare("SELECT count(*) from pays where fr = LOWER(:pays)");
    $stmtExist->execute(array(':pays' => $nomPays));
    $paysCtr = $stmtExist->fetchColumn();

    if ($paysCtr == 0) {
        $sql = "INSERT INTO pays(fr) values(:nomPays)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':nomPays' => $nomPays));
        echo "success";
    } else {
        echo "error_user_exists";
    }
} else {
    echo "error";
}

$conn = null;
