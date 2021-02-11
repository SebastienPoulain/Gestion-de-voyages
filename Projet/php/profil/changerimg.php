<?php 

 include "../BD.inc.php";

 if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(isset($_POST['img']))
{
$imgSelected = $_POST["img"];

$sql = "UPDATE utilisateurs SET imgBackground ='".$imgSelected."'
WHERE ID = ".$_SESSION['userID'];

$test= $conn->prepare($sql);
$test->execute();


$_SESSION["imgProfil"] = $imgSelected;

echo "success";
}
else{
    echo "error";
}

$conn = null;