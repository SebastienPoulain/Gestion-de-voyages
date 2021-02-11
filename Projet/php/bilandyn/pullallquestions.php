<?php

require '../BD.inc.php';
require "questions_categories.php";

$obj = new Questions_categories($conn);

echo $obj->getAllQuestions();

$obj->conn = null;
$conn = null;
