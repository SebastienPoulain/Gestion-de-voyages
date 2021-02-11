<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['id'])) {

  $query = "SELECT id_demande from projets WHERE ID = :id";
  $stmt = $conn->prepare($query);
  $stmt->execute(array(':id' => $_POST['id']));

  $_SESSION['demandeID'] = $stmt->fetch()['id_demande'];

  echo "success";
} else {
  echo "error";
}
$conn = null;
