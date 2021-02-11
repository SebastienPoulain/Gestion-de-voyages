<?php

require '../BD.inc.php';

if (isset($_POST['docid'])){

  $sql = "SELECT * from demandes_docs where ID = :id";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':id' => $_POST['docid']));

  $doc = $stmt->fetch();

  echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http' . '://' . $_SERVER['HTTP_HOST'] . '/' . $doc['path'] . '/' . $doc['nom'];

}
else {
  echo 'error';
}

$conn = null;
