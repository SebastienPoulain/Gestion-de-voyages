<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['newpass'])) {
    $pass = hash('SHA256', $_POST['newpass']);

    $sql = "UPDATE utilisateurs set password = :pass where username = :username";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute(array(':pass' => $pass, ':username' => $_SESSION['user']))) {
        echo "success";
    } else {
        echo "error_bd";
    }
} else {
    echo "error_empty_field";
}

$conn = null;
