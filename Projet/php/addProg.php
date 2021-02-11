<?php

require 'BD.inc.php';

if (isset($_POST['nomProg'])) {
    $nomProg = $_POST['nomProg'];

    $stmtExist = $conn->prepare("SELECT count(*) from programmes where nom_programme = LOWER(:prog)");
    $stmtExist->execute(array(':prog' => $nomProg));
    $progCtr = $stmtExist->fetchColumn();

    if ($progCtr == 0) {
        $sql = "INSERT INTO programmes(nom_programme) values(:nomProg)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':nomProg' => $nomProg));
        echo "success";
    } else {
        echo "error_user_exists";
    }
} else {
    echo "error";
}

$conn = null;
