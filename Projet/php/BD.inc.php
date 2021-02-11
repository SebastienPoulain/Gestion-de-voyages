<?php
$servername = "localhost";
$username = "id16081245_root";
$password = "TH-}ql$4inAYE]o&";
$dbname = "id16081245_projetinter2";

try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->exec("set names utf8");
  $connState = "Connected successfully";
}

catch(PDOException $e)
{
  $connState = "Connection failed: " . $e->getMessage();
}
