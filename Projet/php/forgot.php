<?php

/* fonction pour filtrer les données */

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/* fonction générer une chaine de caractères aléatoirement, elle sert à générer le nouveau mot de passe temporaire */

function random_string($length)
{
    $string = "";
    $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $string .= $chars[rand(0, $size - 1)];
    }
    return $string;
}

if (isset($_POST["email"])) {
    $email = test_input($_POST["email"]);

    require 'BD.inc.php';

    /* requête pour voir si le courriel entré correspondant à une personne de la base de données */

    $req = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $req->execute(["email" => $_POST["email"]]);
    $user = $req->fetch();

    if (!empty($user)) {

        /* on génère un nouveau mot de passe aléatoire et on lui envoie par courriel */

        $password1 = random_string(10);
        $password2 = hash("SHA256", $password1);
        $sql = "UPDATE utilisateurs SET password=? WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$password2, $email]);

        $to = $email;
        $sujet = "Recouvrement de mot de passe";
        $message = "Voici votre mot de passe temporaire : " . $password1 . "\n" . "Nous vous recommandons de le changer dans votre profil";
        $headers = "MIME-Version: 1.0" . "\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
        $headers .= 'From: ' . "siteBureauInternational@cegeptr.qc.ca";

        if (mail($to, $sujet, $message, $headers)) {
            echo 'Un mot de passe temporaire vous a été envoyé par courriel';
        } else {
            echo "envoie impossible, veuillez réessayer";
        }
    } else {
        echo 'Ce courriel est relié à aucun compte';
    }
} else {
    echo "Vous devez remplir tous les champs";
}

$conn = null;
