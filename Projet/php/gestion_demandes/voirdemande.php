<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(isset($_POST['id'])){
  $_SESSION['demandeID'] = $_POST['id'];
  echo "success";
} else {
  echo "error";
}

$conn = null;
