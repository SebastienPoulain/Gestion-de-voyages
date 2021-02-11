<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
session_regenerate_id(true);

if (!empty(trim($_POST['usr'])) && !empty(trim($_POST['passwd'])))
{
  $username = $_POST['usr'];
  $passwd = hash('SHA256', $_POST['passwd']);

  $sql = "SELECT ID, type, programme,email, imgBackground FROM utilisateurs where username = LOWER(:username) and password = :passwd and actif = 1";

  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':username' => $username, ':passwd' => $passwd));

  $result = $stmt->fetch();

  if ($result)
  {
    $userID = $result['ID'];
    $type = $result['type'];
    $programme = $result['programme'];
    $imgProfil = $result['imgBackground'];
    $email = $result["email"];

    $_SESSION["imgProfil"] = $imgProfil;
    $_SESSION['userID'] = $userID;
    $_SESSION['user'] = $username;
    $_SESSION['type'] = $type;
    $_SESSION['programme'] = $programme;
     $_SESSION['email'] = $email;

      $sql = "SELECT id_programme FROM programmes where nom_programme = :nom_programme";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':nom_programme' => $programme));
      $result = $stmt->fetch();

      $_SESSION['idprog'] = $result['id_programme'];

    if($_SESSION['type'] == 'E'){
      $sql = "SELECT projetID FROM usr_projet_info where userID = :id";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':id' => $userID));
      $result = $stmt->fetch();

      $_SESSION['idprojet'] = $result['projetID'];

      $sql = "SELECT nom_projet FROM projets where ID = :id";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':id' => $_SESSION['idprojet']));
      $result = $stmt->fetch();

      $_SESSION['nomprojet']= $result['nom_projet'];

    }

    echo "success";
  }
  else{
    echo "error";
  }
}
else{
  echo "error";
}

$conn = null;
