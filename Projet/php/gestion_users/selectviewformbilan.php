<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$query = "SELECT ID, type FROM utilisateurs where username = :username;";
$stmt = $conn->prepare($query);
$stmt->execute(array(':username' => $_POST['id']));


$_SESSION['selectedetu'] = $stmt->fetch()['ID'];
$_SESSION['selectedetutype'] = $stmt->fetch()['type'];
