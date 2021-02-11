<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data = array();
$id = array();
$pays = array();
$actif = array();

$sql = "SELECT * from pays order by fr";
$stmt = $conn->prepare($sql);
$stmt->execute();
$listepays = $stmt->fetchAll(\PDO::FETCH_ASSOC);


foreach ($listepays as $row) {
    array_push($id, $row['id_pays']);
    array_push($pays, $row['fr']);
    array_push($actif, $row['actif']);
}

$data['id_pays'] = $id;
$data['fr'] = $pays;
$data['actif'] = $actif;

echo json_encode($data);

$conn = null;
