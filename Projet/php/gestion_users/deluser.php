<?php

require '../BD.inc.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $sql="SELECT ID FROM utilisateurs WHERE username = :username;";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':username' => $username));

    $user = $stmt->fetch();

    if ($user) {
        $sql="UPDATE `utilisateurs` SET `actif` = '0' WHERE ID = :id;";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $user['ID']));

        echo 'success';
    } else {
        echo 'error_unfound_user';
    }
} else {
    echo 'error';
}

$conn = null;
