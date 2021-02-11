<?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
if(!empty($_SESSION["idprojet"]))
{
    echo $_SESSION["idprojet"];
}
else{
    echo "empty";
}

