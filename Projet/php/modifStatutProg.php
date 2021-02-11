<?php

require 'BD.inc.php';

if (isset($_POST['id']) && isset($_POST["statut"])) {
    $id = $_POST['id'];
    $statut = $_POST['statut'];

    if ($statut == "Actif") {
        $stat = 0;
    } elseif ($statut == "Inactif") {
        $stat = 1;
    }

    $sql = "UPDATE programmes SET actif = :actif where id_programme = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':actif' => $stat,':id' => $id));
    echo "Le statut du programme a été mis à jour";
} else {
    echo "error";
}

$conn = null;
