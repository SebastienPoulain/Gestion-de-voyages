<?php

require '../BD.inc.php';

if (isset($_POST['username']) && isset($_POST['tempPass'])) {
    $username = $_POST['username'];
    $tempPass = hash('SHA256', $_POST['tempPass']);

    $sql="UPDATE utilisateurs SET password = :password WHERE username = :username;";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':username' => $username, ':password' => $tempPass));

    echo 'success';
} else {
    echo 'error';
}

$conn = null;
