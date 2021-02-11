<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data = array();
$id = array();
$prog = array();
$actif = array();


$sql = "SELECT * from programmes order by nom_programme";
$stmt = $conn->prepare($sql);
$stmt->execute();
$listeprog = $stmt->fetchAll(\PDO::FETCH_ASSOC);


foreach ($listeprog as $row) {
    array_push($id, $row['id_programme']);
    array_push($prog, $row['nom_programme']);
    array_push($actif, $row['actif']);
}

$data['id'] = $id;
$data['prog'] = $prog;
$data['actif'] = $actif;

echo json_encode($data);

$conn = null;
