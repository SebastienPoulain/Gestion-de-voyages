<?php

require 'BD.inc.php';


if (!empty($_FILES['file'])) {
  $target_dir = "../docs/";
  $target_file = $target_dir . $_FILES["file"]["name"];
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if (file_exists($target_file)) {
        unlink($target_file);
    }

    if ($_FILES["file"]["size"] > 5000000) {
        echo "error_file_size";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "docx" && $imageFileType != "xlsx" && $imageFileType != "doc" && $imageFileType != "xls" && $imageFileType != "pdf" && $imageFileType != "zip") {
        echo "error_file_type";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "error";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

            //$sql = "INSERT into bilan_docs (nom, `path`, infoText) values(:nom, :path1, :infoText);";
            $sql = "UPDATE bilan_docs SET nom = :nom , `path` = :path1, `text`= :infoText WHERE ID = 1";
            $stmt = $conn->prepare($sql);
            
            $stmt->execute(array(':nom' => $_FILES["file"]["name"], ':path1' => basename($target_dir), ':infoText'=> $_POST['text']));

            echo "success";
        //echo "The file ". basename($_FILES["file"]["name"]). " has been uploaded.";
        } else {
            echo "error_upload";
            $projDocID = -1;
            echo $projDocID;
        }
    }
} else {
    $projDocID = -1;
    echo $projDocID;
}

$conn = null;
