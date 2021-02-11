<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST['responses'])) {
    $responses = array();
    $responses = json_decode($_POST['responses']);

    if ($_SESSION['demandeID'] == -1) {
        $query = "INSERT INTO demandes(userID, programme, destination, dateD, dateR, precisionDestination, titre) values(:userID, :programme, :destination, :dateD, :dateR, :precisionDestination, :titre);";
        $stmt = $conn->prepare($query);
        $values = array(':userID' => $_SESSION['userID'], ':programme' => $responses[0]->programme, ':destination' => $responses[0]->destination, ':dateD' => $responses[0]->dateD, ':dateR' => $responses[0]->dateR, ':precisionDestination' => $responses[0]->precisions, ':titre' => $responses[0]->title);
        $stmt->execute($values);

        $id_demande = $conn->lastInsertId();


        $query = "INSERT INTO demandes_activites(id_demande, activites, dates) values(:id_demande, :activites, :dates);";
        $stmt = $conn->prepare($query);

        for ($i=0; $i < count($responses[1]->activites); $i++) {
          $stmt->execute(array(':id_demande' => $id_demande, ':activites' => $responses[1]->activites[$i], ':dates' => $responses[1]->dates_activites[$i]));
        }

        $query = "INSERT INTO demandes_reponses(demandeID, userID, questionID, reponse) values(:demandeID, :userID, :questionID, :reponse);";
        $stmt = $conn->prepare($query);

        for ($i=2; $i < count($responses); $i++) {
            $stmt->execute(array(':demandeID' => $id_demande, ':userID' => $_SESSION['userID'], ':questionID' => $responses[$i]->question, ':reponse' => $responses[$i]->reponse));
        }

        echo json_encode(array('state' => 'success', 'message' => 'Vos réponses ont bien été sauvegardées et envoyées'));
    } else {
        $query = "DELETE FROM demandes_reponses WHERE demandeID = :demandeID;";
        $stmt = $conn->prepare($query);
        $stmt->execute(array(':demandeID' => $_SESSION['demandeID']));

        $query = "DELETE FROM demandes_activites WHERE id_demande = :demandeID;";
        $stmt = $conn->prepare($query);
        $stmt->execute(array(':demandeID' => $_SESSION['demandeID']));

        $query = "UPDATE demandes set userID = :userID, programme = :programme, destination = :destination, dateD = :dateD, dateR = :dateR, precisionDestination = :precisionDestination, titre = :titre WHERE id = :demandeID;";
        $stmt = $conn->prepare($query);
        $values = array(':userID' => $_SESSION['userID'], ':programme' => $responses[0]->programme, ':destination' => $responses[0]->destination,
      ':dateD' => $responses[0]->dateD, ':dateR' => $responses[0]->dateR, ':precisionDestination' => $responses[0]->precisions, ':titre' => $responses[0]->title,
      ':demandeID' => $_SESSION['demandeID']);
        $stmt->execute($values);


        $query = "INSERT INTO demandes_activites(id_demande, activites, dates) values(:id_demande, :activites, :dates);";
        $stmt = $conn->prepare($query);

        for ($i=0; $i < count($responses[1]->activites); $i++) {
          $stmt->execute(array(':id_demande' => $_SESSION['demandeID'], ':activites' => $responses[1]->activites[$i], ':dates' => $responses[1]->dates_activites[$i]));
        }


        $query = "INSERT INTO demandes_reponses(demandeID, userID, questionID, reponse) values(:demandeID, :userID, :questionID, :reponse);";
        $stmt = $conn->prepare($query);

        for ($i=2; $i < count($responses); $i++) {
            $stmt->execute(array(':demandeID' => $_SESSION['demandeID'], ':userID' => $_SESSION['userID'], ':questionID' => $responses[$i]->question, ':reponse' => $responses[$i]->reponse));
        }

        echo json_encode(array('state' => 'success', 'message' => 'Vos réponses ont bien été sauvegardées et envoyées'));
    }
} else {
    echo json_encode(array('state' => 'error', 'message' => 'Erreur, aucune réponse indiquée'));
}

$conn = null;
