<?php

require '../BD.inc.php';

if(isset($_POST['idRefus'])){

  $id = $_POST['idRefus'];

  if(isset($_POST['msgRefus']))
  {
     $msgrefus = $_POST['msgRefus'];
  }
  else{
      $msgrefus = "";
  }

  $sql="Select count(id_demande) as existe, ID from projets WHERE id_demande =:id  group by ID";
$stmt = $conn->prepare($sql);
$stmt->execute(array(':id'=> $id));
$projetExiste = $stmt->fetch();

if($projetExiste['existe'] > 0){
$sql="Select count(userID) as nbrEtu from usr_projet_info WHERE projetID =:id";
$stmt = $conn->prepare($sql);
$stmt->execute(array(':id'=> $projetExiste['ID']));
$etu = $stmt->fetch();

if($etu['nbrEtu']>0){
    $sql="Update projets set actif = 1 WHERE ID =:id";
$stmt = $conn->prepare($sql);
$stmt->execute(array(':id'=> $projetExiste['ID']));
}else{
        $sql="Delete from projets WHERE ID =:id";
$stmt = $conn->prepare($sql);
$stmt->execute(array(':id'=> $projetExiste['ID']));
}
}
   if ($_FILES['file']['name']!=''){
  $filename = date('Y-m-d H:i:s') . $_FILES["file"]["name"];
  $filename = str_replace(":","",$filename);

  $sql="SELECT file_path from demandes WHERE ID=:id";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':id'=> $id));
  $ancienFile = $stmt->fetch();

}else{
$filename = NULL;
}

  $sql="UPDATE demandes SET etat=:etat, raison_refus=:raison,file_path = :file  WHERE ID=:id";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':etat' => 2, ':raison' => $msgrefus,':file' => $filename, ':id'=> $id));

  if($filename != ""){

    if($ancienFile[0] != NULL){
    unlink("../../uploads/" . $ancienFile[0]);
  }

  move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/" . $filename);
  }
    echo "success";
}
else {
  echo 'error';
}

$conn = null;
