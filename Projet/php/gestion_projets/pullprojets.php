<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["pulltype"])) {
    $pulltype = $_POST["pulltype"];

    $data = array();
    $id = array();
    $nom = array();
    $code = array();
    $destination = array();
    $dateD = array();
    $dateR = array();

    if ($pulltype == "actif") {
        if ($_SESSION['type'] == 'A') {
            $sql = "SELECT * from projets WHERE actif = 0";


            foreach ($conn->query($sql) as $row) {
                $sql = "SELECT * from demandes where ID = :demandeID ";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':demandeID' => $row['id_demande']));
                $infoproj2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($infoproj2 as $row2) {
                    array_push($id, $row['ID']);
                    array_push($nom, $row['nom_projet']);
                    $row['codeProj'] = substr_replace($row['codeProj'], "-", 4, 0);
                    array_push($code, $row['codeProj']);
                    array_push($destination, $row2['precisionDestination']);
                    array_push($dateD, $row2['dateD']);
                    array_push($dateR, $row2['dateR']);
                }
            }
        } elseif ($_SESSION['type'] == 'P' or $_SESSION['type'] == 'E') {
            $sql = "SELECT projetID from usr_projet_info WHERE userID = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id' => $_SESSION['userID']));
            $projIDs = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($projIDs as $projID) {
                $sql = "SELECT * from projets where ID = :projID";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':projID' => $projID['projetID']));
                $infoproj = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($infoproj as $row) {
                    $sql = "SELECT * from demandes where ID = :demandeID";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array(':demandeID' => $row['id_demande']));
                    $infoproj2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach ($infoproj2 as $row2) {
                        array_push($id, $row['ID']);
                        array_push($nom, $row['nom_projet']);
                        $row['codeProj'] = substr_replace($row['codeProj'], "-", 4, 0);
                        array_push($code, $row['codeProj']);
                        array_push($destination, $row2['precisionDestination']);
                        array_push($dateD, $row2['dateD']);
                        array_push($dateR, $row2['dateR']);
                    }
                }
            }
        }

        $data['id'] = $id;
        $data['nom'] = $nom;
        $data['code'] = $code;
        $data['destination'] = $destination;
        $data['dateD'] = $dateD;
        $data['dateR'] = $dateR;
    }

    if ($pulltype == "désactivé") {
        if ($_SESSION['type'] == 'A') {
            $sql = "SELECT * from projets WHERE actif = 1";

            foreach ($conn->query($sql) as $row) {
                $sql = "SELECT * from demandes where ID = :demandeID";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':demandeID' => $row['id_demande']));
                $infoproj2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($infoproj2 as $row2) {
                    array_push($id, $row['ID']);
                    array_push($nom, $row['nom_projet']);
                    $row['codeProj'] = substr_replace($row['codeProj'], "-", 4, 0);
                    array_push($code, $row['codeProj']);
                    array_push($destination, $row2['precisionDestination']);
                    array_push($dateD, $row2['dateD']);
                    array_push($dateR, $row2['dateR']);
                }
            }
        } elseif ($_SESSION['type'] == 'P' or $_SESSION['type'] == 'E') {
            $sql = "SELECT projetID from usr_projet_info WHERE userID = :id ";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id' => $_SESSION['userID']));
            $projIDs = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($projIDs as $projID) {
                $sql = "SELECT * from projets where ID = :projID";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':projID' => $projID['projetID']));
                $infoproj = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($infoproj as $row) {
                    $sql = "SELECT * from demandes where ID = :demandeID";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array(':demandeID' => $row['id_demande']));
                    $infoproj2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach ($infoproj2 as $row2) {
                        array_push($id, $row['ID']);
                        array_push($nom, $row['nom_projet']);
                        $row['codeProj'] = substr_replace($row['codeProj'], "-", 4, 0);
                        array_push($code, $row['codeProj']);
                        array_push($destination, $row2['precisionDestination']);
                        array_push($dateD, $row2['dateD']);
                        array_push($dateR, $row2['dateR']);
                    }
                }
            }
        }

        $data['id'] = $id;
        $data['nom'] = $nom;
        $data['code'] = $code;
        $data['destination'] = $destination;
        $data['dateD'] = $dateD;
        $data['dateR'] = $dateR;
    }
}

echo json_encode($data);

$conn = null;
