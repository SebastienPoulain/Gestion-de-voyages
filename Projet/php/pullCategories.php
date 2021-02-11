<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data = array();
$id = array();
$cat = array();
$actif = array();


if ($_SESSION['type'] == 'A') {
    $sql = "SELECT * from categories order by categorie";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    foreach ($categories as $row) {
        array_push($id, $row['id']);
        array_push($cat, $row['categorie']);
        array_push($actif, $row['actif']);
    }
}
$data['id'] = $id;
$data['categorie'] = $cat;
$data['actif'] = $actif;

echo json_encode($data);

$conn = null;
