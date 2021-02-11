<?php

require '../BD.inc.php';

if (!empty(trim($_POST['cat'])) && !empty(trim($_POST['question']))) {
    $cat = $_POST['cat'];
    $question = $_POST['question'];
    $option = $_POST['option'];
    $info_sup = $_POST['info_supp'];

    $stmtExist = $conn->prepare("SELECT count(*) from demandes_questions where question = LOWER(:question) and affichage = LOWER(:affichage)");
    $stmtExist->execute(array(':question' => $question,':affichage' => $option));
    $questionCtr = $stmtExist->fetchColumn();


    if ($questionCtr == 0) {

        if ($option == 'download') {
            $sql = "INSERT INTO demandes_questions(id_categorie,question,input_option,affichage,info_sup) value(:id_categorie,:question,:input_option,:affichage,:info_sup)";

            $stmt = $conn->prepare($sql);

            $file = "uploads/" . $_FILES["file"]["name"];

            move_uploaded_file($_FILES["file"]["tmp_name"], "../../" . $file);

            $input_option = $file;

            $stmt->execute(array(':id_categorie' => $cat,':question' => $question,':input_option' => $input_option,':affichage' => $option,':info_sup' => $info_sup));

            echo "La question a été ajouté avec succès";
        } elseif ($option == 'select' || $option == "choixMultiple" || $option == "checkbox") {
            $sql = "INSERT INTO demandes_questions(id_categorie,question,input_option,affichage,info_sup) value(:id_categorie,:question,:input_option,:affichage,:info_sup)";

            $stmt = $conn->prepare($sql);

            $input_option = $_POST["list-option"];

            $stmt->execute(array(':id_categorie' => $cat,':question' => $question,':input_option' => $input_option,':affichage' => $option,':info_sup' => $info_sup));

            echo "La question a été ajouté avec succès";
        } elseif ($option == 'slider' || $option == "number") {
            $sql = "INSERT INTO demandes_questions(id_categorie,question,input_option,affichage,info_sup) value(:id_categorie,:question,:input_option,:affichage,:info_sup)";

            $stmt = $conn->prepare($sql);

            $input_option = $_POST["value-min"] . ";" . $_POST["value-max"] . ";" . $_POST["value-step"];

            $stmt->execute(array(':id_categorie' => $cat,':question' => $question,':input_option' => $input_option,':affichage' => $option,':info_sup' => $info_sup));

            echo "La question a été ajouté avec succès";
        } else {
            $sql = "INSERT INTO demandes_questions(id_categorie,question,input_option,affichage,info_sup) value(:id_categorie,:question,:input_option,:affichage,:info_sup)";

            $stmt = $conn->prepare($sql);

            $input_option = "none";

            $stmt->execute(array(':id_categorie' => $cat,':question' => $question,':input_option' => $input_option,':affichage' => $option,':info_sup' => $info_sup));

            echo "La question a été ajouté avec succès";
        }
    } else {
        echo "La question entrée existe déjà avec le même mode d'affichage";
    }
}

$conn = null;
