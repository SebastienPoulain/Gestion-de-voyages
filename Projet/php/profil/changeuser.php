<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_POST["programme"]))
{
  $nomProgramme = $_POST["programme"];
  $prenom = $_POST["prenom"];
  $nom = $_POST["nom"];
  $utilisateur = $_POST["username"];
  $adresse = $_POST["email"];
  $num = $_POST["tel"];


    $stmtExist = $conn->prepare("SELECT count(*) from utilisateurs where username = LOWER(:username)");
    $stmtExist->execute(array(':username' => $utilisateur));
    $userCtr = $stmtExist->fetchColumn();

      $stmtExist2 = $conn->prepare("SELECT count(*) from utilisateurs where email = LOWER(:email)");
    $stmtExist2->execute(array(':email' => $adresse));
    $emailCtr = $stmtExist2->fetchColumn();

    if($adresse == $_SESSION["email"])
    {
        $emailCtr = 0;
    }

    if($utilisateur == $_SESSION["user"])
    {
        $userCtr = 0;
    }

if ($userCtr == 0 && $emailCtr == 0) {


$sql = "UPDATE utilisateurs SET programme = '".$nomProgramme."', prenom = '".$prenom."', nom = '".$nom."',username = '".$utilisateur."',email = '".$adresse."', telephone = '".$num."'
WHERE ID = ".$_SESSION['userID'];

$test= $conn->prepare($sql);
$test->execute();

    $_SESSION['user'] = $utilisateur;
    $_SESSION['programme'] = $nomProgramme;
    $_SESSION["email"] = $adresse;

echo "success";
}else if($userCtr == 1){
echo "userExiste";
}else if($emailCtr == 1){
    echo "emailExiste";
}else{echo $emailCtr;}
}


$conn = null;
