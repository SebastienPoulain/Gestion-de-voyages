<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userID']))
    include 'main.php';
else
    include 'connection.php';
