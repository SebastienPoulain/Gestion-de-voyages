<?php

require '../BD.inc.php';

if (isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['type'])) {
    $username = $_POST['username'];
    $pass = hash('SHA256', $_POST['pass']);
    $type = $_POST['type'];
    $programme = "Personnel administratif";
    $genre = "autre";

    $stmtExist = $conn->prepare("SELECT count(*) from utilisateurs where username = LOWER(:username)");
    $stmtExist->execute(array(':username' => $username));
    $userCtr = $stmtExist->fetchColumn();

    if ($userCtr == 0) {
        $sql = "INSERT INTO utilisateurs(username, password, type,prenom,nom,email,telephone,programme,genre) values(LOWER(:username), :password, :type,:prenom,:nom,:email,:telephone,:programme,:genre);";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':username' => $username, ':password' => $pass, ':type' => $type,':prenom' => "",':nom' => "",':email' => "",':telephone' => "",':programme' => $programme,':genre' => $genre));

        echo "success";
    } else {
        echo "error_user_exists";
    }
} else {
    echo "error";
}

$conn = null;
