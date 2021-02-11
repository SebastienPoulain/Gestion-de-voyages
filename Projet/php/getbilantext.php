<?php

require 'BD.inc.php';

    $sql = "SELECT `text` FROM bilan_docs WHERE ID = 1 ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $text = $stmt->fetch();

  echo $text['text'];



$conn = null;