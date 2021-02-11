<?php

require 'BD.inc.php';

if (!empty(trim($_POST['usr'])) && !empty(trim($_POST['passwd'])) && !empty(trim($_POST['code']))&& !empty(trim($_POST['email']))&& !empty(trim($_POST['tel']))&& !empty(trim($_POST['nom']))&& !empty(trim($_POST['prenom'])) && !empty(trim($_POST['sexe']))) {
    $username = $_POST['usr'];
    $passwd = hash('SHA256', $_POST['passwd']);
    $code = $_POST['code'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $prog = $_POST['prog'];


    $sql = "SELECT codeProj FROM projets where codeProj = :code";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':code' => $code));

    $result = $stmt->fetch();

    $stmtExist = $conn->prepare("SELECT count(*) from utilisateurs where username = LOWER(:username)");
    $stmtExist->execute(array(':username' => $username));
    $userCtr = $stmtExist->fetchColumn();

    $stmtExist = $conn->prepare("SELECT count(*) from utilisateurs where email = LOWER(:email)");
    $stmtExist->execute(array(':email' => $email));
    $emailCtr = $stmtExist->fetchColumn();

    if ($result && $userCtr == 0 && $emailCtr == 0) {
        $sql = "INSERT INTO utilisateurs(prenom,nom,username, password,email,telephone,type,genre,programme) value(:prenom,:nom,LOWER(:username),:passwd,:email,:tel,:type,:genre,:prog)";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(':prenom' => $prenom,':nom' => $nom,':username' => $username, ':passwd' => $passwd,':email' => $email,':tel' => $tel, ':type' => 'E',':genre' => $sexe,':prog' => $prog));

        if ($stmt->rowCount() > 0) {
            $sql = "SELECT ID from utilisateurs where username = LOWER(:username)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':username' => $username));

            $result = $stmt->fetch();
            $userID = $result['ID'];

            $sql = "SELECT ID from projets where codeProj = :code";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':code' => $code));

            $result = $stmt->fetch();
            $projID = $result['ID'];

            $sql = "SELECT id_programme from programmes where nom_programme = :nom_prog";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':nom_prog' => $prog));

            $result = $stmt->fetch();
            $progID = $result['id_programme'];

            $sql = "INSERT INTO usr_projet_info values(:userID, :projID, :id_programme)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':userID' => $userID, ':projID' => $projID, ':id_programme'=>$progID));

            echo "success";
        } else {
            echo "errorBD";
        }
    } elseif ($userCtr > 0) {
        echo "Ce nom d'utilisateur est déjà utilisé";
    } elseif ($result == 0) {
        echo "Le code de projet n'existe pas";
    } elseif ($emailCtr > 0) {
        echo "L'adresse courriel existe déjà";
    }
}

$conn = null;
