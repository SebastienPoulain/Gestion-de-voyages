<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['oldpass'])){

  $pass = hash('SHA256', $_POST['oldpass']);

  $sql = "SELECT * from utilisateurs where username = :username and password = :pass";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':username' => $_SESSION['user'], ':pass' => $pass));

  $user = $stmt->fetch();

  if ($user)
    echo 'success';
  else
    echo 'error_user_notfound';
}
else {
  echo 'error_empty_field';
}

$conn = null;
