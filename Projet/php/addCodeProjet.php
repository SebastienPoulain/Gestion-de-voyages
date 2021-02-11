<?php
require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!empty(trim($_POST['codeVoyage']))) {
    $code = trim($_POST['codeVoyage']);
    $sql = "SELECT count(codeProj) FROM projets where UPPER(codeProj) = :code";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':code' => $code));
    $result = $stmt->fetchColumn();

    if ($result > 0) {
        $userID = $_SESSION['userID'];
        $idprog = $_SESSION['idprog'];


        $sql = "SELECT ID from projets where codeProj = :code";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(':code' => $code));
        $result = $stmt->fetch();
        $projID = $result['ID'];


        $sql = "SELECT count(userID) FROM usr_projet_info where projetID = :code and userID = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':code' => $projID, ':userid' => $userID));
        $result = $stmt->fetchColumn();
        if ($result == 0) {
            $sql = "INSERT INTO usr_projet_info values(:userID, :projID, :idprog)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':userID' => $userID, ':projID' => $projID, ":idprog" => $idprog));

            echo 'success';
        } else {
            echo 'errorAlready';
        }
    } else {
        echo 'invalidCode';
    }
} else {
    echo 'errorvide';
}
