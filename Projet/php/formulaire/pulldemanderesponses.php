<?php
require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['demandeID'])) {
    $query = "SELECT * from demandes WHERE id = :demandeID;";
    $stmt = $conn->prepare($query);

    if ($stmt->execute(array(':demandeID' => $_SESSION['demandeID']))) {
        $demande = $stmt->fetch(\PDO::FETCH_ASSOC);

        $query = "SELECT * from demandes_reponses WHERE demandeID = :demandeID;";
        $stmt = $conn->prepare($query);

        $query = "SELECT * from demandes_activites WHERE id_demande = :demandeID ORDER BY dates;";
        $stmt1 = $conn->prepare($query);

        if ($stmt->execute(array(':demandeID' => $_SESSION['demandeID'])) && $stmt1->execute(array(':demandeID' => $_SESSION['demandeID']))) {
            $arr = array();

            array_push($arr, array('state' => 'success', 'message' => 'reponses recues'));
            array_push($arr, $demande);
            array_push($arr, $stmt->fetchAll(\PDO::FETCH_ASSOC));
            array_push($arr, $stmt1->fetchAll(\PDO::FETCH_ASSOC));
            echo json_encode($arr);
        } else {
            echo json_encode(array('state' => 'error', 'message' => 'echec de la requete'));
        }
    }
} else {
    echo json_encode(array('state' => 'error', 'message' => 'utilisateur introuvable'));
}

$conn = null;
