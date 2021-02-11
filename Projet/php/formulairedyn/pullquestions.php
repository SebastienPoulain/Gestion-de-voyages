<?php

require '../BD.inc.php';
require "questions_categories.php";

$obj = new Questions_categories($conn);

echo $obj->getQuestions();

$obj->conn = null;
$conn = null;
