<?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
if(isset($_POST['nom'])&&isset($_POST['idProjet']))
{
   $_SESSION['nomprojet']= $_POST['nom']; 
   $_SESSION['idprojet']= $_POST['idProjet'];
}


