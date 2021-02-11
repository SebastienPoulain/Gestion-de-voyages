<?php
require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_POST['page'] == "viewBilan") {
    $userid = $_SESSION['selectedetu'];
} else {
    $userid = $_SESSION['userID'];
}

if (isset($userid)) {
    $query = "SELECT * from bilan_reponses WHERE userID = :userID and projetID = :projetID;";
    $stmt = $conn->prepare($query);

    if ($stmt->execute(array(':userID' => $userid, ':projetID' => $_SESSION['idprojet']))) {
        $arr = array();

        array_push($arr, array('state' => 'success', 'message' => 'reponses recues'));
        array_push($arr, $stmt->fetchAll(\PDO::FETCH_ASSOC));
        echo json_encode($arr);
    } else {
        echo json_encode(array('state' => 'error', 'message' => 'echec de la requete'));
    }
} else {
    echo json_encode(array('state' => 'error', 'message' => 'utilisateur introuvable'));
}

$conn = null;
