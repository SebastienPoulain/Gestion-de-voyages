<?php

require '../BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["pulltype"])) {
    $pulltype = $_POST["pulltype"];
    $data = array();
    $users = array();
    $users2 = array();
    $username = array();
    $types = array();
    if ($pulltype == "all") {
        if ($_SESSION['type'] == 'P') {
            $sql = "SELECT * from usr_projet_info where userID = :userID;";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':userID' => $_SESSION['userID']));
            $projIDs = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($projIDs as $projID) {
                $sql = "SELECT * from usr_projet_info where projetID = :projID and userID != :userID;";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':projID' => $projID['projetID'], ':userID' => $_SESSION['userID']));
                $userListe = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($userListe as $user) {
                    $sql = "SELECT nom,prenom, type, actif,username from utilisateurs where ID = :id order by username";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array(':id' => $user['userID']));

                    $selectedUser = $stmt->fetch();

                    if ($selectedUser['type'] == 'A') {
                        $selectedUser['type'] = 'Administrateur';
                    } elseif ($selectedUser['type'] == 'P') {
                        $selectedUser['type'] = 'Accompagnateur';
                    } elseif ($selectedUser['type'] == 'E') {
                        $selectedUser['type'] = 'Étudiant';
                    }

                    if ($selectedUser['actif'] == 1) {
                        array_push($users, $selectedUser['nom']);
                        array_push($users2, $selectedUser['prenom']);
                        array_push($types, $selectedUser['type']);
                        array_push($username, $selectedUser['username']);
                    }
                }
            }
        } elseif ($_SESSION['type'] == 'A') {
            $sql = "SELECT nom,prenom, type, actif,username from utilisateurs order by username";
            foreach ($conn->query($sql) as $row) {
                if ($row['type'] == 'A') {
                    $row['type'] = 'Administrateur';
                } elseif ($row['type'] == 'P') {
                    $row['type'] = 'Accompagnateur';
                } elseif ($row['type'] == 'E') {
                    $row['type'] = 'Étudiant';
                }

                if ($row['actif'] == 1) {
                    array_push($users, $row['nom']);
                    array_push($users2, $row['prenom']);
                    array_push($types, $row['type']);
                    array_push($username, $row['username']);
                }
            }
        }
    } elseif ($pulltype == "projet") {
        if (!empty($_SESSION['idprojet'])) {
            if ($_SESSION['type'] == 'A' || $_SESSION['type'] == 'P') {
                $sql = "SELECT userID from usr_projet_info where projetID=:projetid and userID != :userID;";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':projetid' => $_SESSION['idprojet'], ':userID' => $_SESSION['userID']));
                $userIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($userIds as $userId) {
                    $sql = "SELECT nom,prenom, type, actif,username from utilisateurs where ID = :id order by username";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array(':id' => $userId['userID']));
                    $userinfo = $stmt->fetch();

                    if ($userinfo['type'] == 'A') {
                        $userinfo['type'] = 'Administrateur';
                    } elseif ($userinfo['type'] == 'P') {
                        $userinfo['type'] = 'Accompagnateur';
                    } elseif ($userinfo['type'] == 'E') {
                        $userinfo['type'] = 'Étudiant';
                    }
                    if ($userinfo['actif'] == 1) {
                        array_push($users, $userinfo['nom']);
                        array_push($users2, $userinfo['prenom']);
                        array_push($types, $userinfo['type']);
                        array_push($username, $userinfo['username']);
                    }
                }
            }
        }
    } elseif ($pulltype == "disable") {
        if ($_SESSION['type'] == 'P') {
            $sql = "SELECT * from usr_projet_info where userID = :userID;";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':userID' => $_SESSION['userID']));
            $projIDs = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($projIDs as $projID) {
                $sql = "SELECT * from usr_projet_info where projetID = :projID and userID != :userID;";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':projID' => $projID['projetID'], ':userID' => $_SESSION['userID']));
                $userListe = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($userListe as $user) {
                    $sql = "SELECT nom,prenom, type, actif,username from utilisateurs where ID = :id order by username";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array(':id' => $user['userID']));

                    $selectedUser = $stmt->fetch();

                    if ($selectedUser['type'] == 'A') {
                        $selectedUser['type'] = 'Administrateur';
                    } elseif ($selectedUser['type'] == 'P') {
                        $selectedUser['type'] = 'Accompagnateur';
                    } elseif ($selectedUser['type'] == 'E') {
                        $selectedUser['type'] = 'Étudiant';
                    }

                    if ($selectedUser['actif'] == 0) {
                        array_push($users, $selectedUser['nom']);
                        array_push($users2, $selectedUser['prenom']);
                        array_push($types, $selectedUser['type']);
                        array_push($username, $selectedUser['username']);
                    }
                }
            }
        } elseif ($_SESSION['type'] == 'A') {
            $sql = "SELECT nom,prenom, type, actif,username from utilisateurs order by username";
            foreach ($conn->query($sql) as $row) {
                if ($row['type'] == 'A') {
                    $row['type'] = 'Administrateur';
                } elseif ($row['type'] == 'P') {
                    $row['type'] = 'Accompagnateur';
                } elseif ($row['type'] == 'E') {
                    $row['type'] = 'Étudiant';
                }

                if ($row['actif'] == 0) {
                    array_push($users, $row['nom']);
                    array_push($users2, $row['prenom']);
                    array_push($types, $row['type']);
                    array_push($username, $row['username']);
                }
            }
        }
    }

    $data['nom'] = $users;
    $data['prenom'] = $users2;
    $data['type'] = $types;
    $data['currentUser'] = $_SESSION['user'];
    $data["username"] = $username;

    echo json_encode($data);
}
$conn = null;
