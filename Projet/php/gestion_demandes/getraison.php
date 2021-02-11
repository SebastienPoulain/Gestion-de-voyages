<?php

require '../BD.inc.php';

if(isset($_POST['id'])){

  $id = $_POST['id'];

  $sql = "SELECT raison_refus,file_path FROM demandes WHERE ID = :id ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id' => $id));
    $raison = $stmt->fetchAll();

echo json_encode($raison);


}
else {
  echo 'error';
}

$conn = null;

?>
