<?php

require '../BD.inc.php';

if (isset($_POST['id']) && isset($_POST['codeProj'])) {

    $id = $_POST['id'];
    $codeProj = $_POST['codeProj'];

    $titre = "";
    $userid = "";

    $sql1 = "SELECT titre,userID, programme,file_path FROM demandes WHERE ID= ?;";

    $stmt = $conn->prepare($sql1);
    $stmt->execute([$id]);
    $res = $stmt->fetch();
    $titre = $res['titre'];
    $path = "../../uploads/".$res['file_path'];
    if($res['file_path'] != NULL){
    if(file_exists($path)){
        unlink($path);
    }
    }
    $userid = $res['userID'];
    $idProgramme = $res['programme'];

    $sql = "UPDATE demandes SET etat=?, raison_refus='',file_path = NULL WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([1, $id]);


    $sql1 = "SELECT count(ID) as projetExiste FROM projets WHERE id_demande= ?;";

    $stmt = $conn->prepare($sql1);
    $stmt->execute([$id]);
    $projetExiste = $stmt->fetch();

if($projetExiste['projetExiste']>0){

    $sql = "UPDATE projets SET actif=0 WHERE id_demande=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    echo 'success';
}
else{
    $sql = "INSERT INTO projets(id_demande,nom_projet, codeProj)  VALUES ( ? , ?  , ?); ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $titre, $codeProj]);

    $sql1 = "SELECT ID FROM projets WHERE id_demande= ?;";

    $stmt = $conn->prepare($sql1);
    $stmt->execute([$id]);
    $titre = $stmt->fetch();
    $idprojet = $titre['ID'];

    if (isset($userid)) {
        if (isset($idprojet)) {
            if (isset($idProgramme)) {

                $sql = "INSERT INTO usr_projet_info values(:userID, :projID, :idprog)";

                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':userID' => $userid, ':projID' => $idprojet, ":idprog" => $idProgramme));

                /*
                  $projID = $conn->lastInsertId();

                  $sql = "SELECT * from vaccins;";
                  $stmt->$conn->prepare($sql);
                  $stmt->execute();

                  $vaccins = $stmt->fetchAll();

                  foreach ($vaccin as $vaccins) {
                    $sql = "INSERT INTO proj_vaccins(proj_id, vaccin_id) values(:projid, :vaccinid);";
                    $stmt->$conn->prepare($sql);
                    $stmt->execute(array(':projid' => $projID, ':vaccinid' => $vaccin['id_vaccin']));
                  }

                  */
                echo 'success';

            } else {
                echo 'probleme de idprog';
            }
        } else {
            echo 'porbleme de projet id';
        }
    } else {
        echo 'problèmede userid';
    }
}
} else {
    echo 'error';
}

$conn = null;
