<header class="header">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="row">
  <div class="col-md-5 col-sm-2 col-2">
      <a href="?page=projets">
          <img id="logo" src="img/iconcegep.jpg" alt="Icone du cegep">
      </a>
  </div>
    <div class="col-md-5 col-sm-5 col-6">
      <span id="projetTitle"></span>
    </div>
    <div class="col-md-2 col-sm-5 col-4">
        <p id="hello" class="text-nowrap text-center">Bonjour <?= $_SESSION['user'] ?></p>
      <button class="btn  btn-secondary btn-block btn2" id="btDeconnexion" type="button" onclick="window.location.href='connection.php'" style="font-size: large;">Déconnexion</button>
    </div>

<?php
if ($_SESSION['type'] == 'A') {
    echo " <div class='navbar w3-bar w3-border w3-white'>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=projets'><i class='fas fa-calendar-alt'></i> Projet</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=formulaire'><i class='far fa-file-alt'></i> Formulaire</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=demande'><i class='fas fa-file-alt'></i> Demande</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=profil'><i class='fas fa-address-card'></i> Profil</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=gestion_users'><i class='fas fa-users'></i> Utilisateur</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=appreciation_admin'><i class='fas fa-book'></i> Bilan</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=stat'><i class='fas fa-chart-bar'></i> Statistique</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=Categorie'><i class='fas fa-list-alt'></i> Catégories</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=pays'><i class='fas fa-globe'></i> Pays</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=programmes'><i class='fas fa-graduation-cap'></i> Programmes</a>

</div>";
} elseif ($_SESSION['type'] == 'P') {
    echo " <div class='navbar w3-bar w3-border w3-white'>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=projets'><i class='fas fa-calendar-alt'></i> Projet</a>
  <a  class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=formulaire'><i class='far fa-file-alt'></i> Formulaire</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=demande'><i class='fas fa-file-alt'></i> Demande</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=profil'><i class='fas fa-address-card'></i> Profil</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=gestion_users'><i class='fas fa-users'></i> Utilisateur</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=bilan'><i class='fas fa-book'></i> Bilan</a>
</div>";
} elseif ($_SESSION['type'] == 'E') {
    echo " <div class='container-fluid w3-bar w3-border w3-white'>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=projets'><i class='fas fa-calendar-alt'></i> Projet</a>
  <a  class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=formulaire'><i class='far fa-file-alt'></i> Formulaire</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=profil'><i class='fas fa-address-card'></i> Profil</a>
  <a class='w3-bar-item w3-button w3-hover-none w3-hover-text-black' style='color:#07265F;' href='?page=bilan'><i class='fas fa-book'></i> Bilan</a>
</div>";
}?>

 </div>


</header>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
<body>




      <script type="text/javascript"><?php

 if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }

   require 'php/BD.inc.php';

   $stmt = $conn->prepare("SELECT * from usr_projet_info where userID = :userID;");
   $stmt->execute(array(':userID' => $_SESSION['userID']));
   $projID = $stmt->fetchAll();
   $projctr = count($projID); ?>
<?php
  if ($projctr >= 1 || $_SESSION['type'] == "A") {
      if (!empty($_SESSION["nomprojet"])) {?>
    $("#projetTitle").html("<?=$_SESSION["nomprojet"]?>");<?php
      } else {?>
     $("#projetTitle").html('Aucun projet n\'a été sélectionné');<?php
      }
  } elseif ($projctr == 0) {?>
    $("#projetTitle").html('Aucun projet n\'a été créé');<?php
  }

$conn = null;?>

$(document).ready(function() {
  $(".dropdown-item").click(function(event) {
    $(".dropdown-toggle").text($(this).text());
  });

if($(window).width() < 1185)
{
  $("#logo").attr('src', 'img/iconcegepmin.jpg');
  $("#logo").width(53);
  $("#btDeconnexion").html("<i class='fas fa-sign-out-alt'></i>");
}
else{
  $("#logo").attr('src', 'img/iconcegep.jpg');
  $("#logo").width('auto');
  $("#btDeconnexion").html('Déconnexion');
}

if (matchMedia) {
const mq = window.matchMedia("(min-width: 1185px)");
mq.addListener(WidthChange);
WidthChange(mq);
}


function WidthChange(mq) {
if (mq.matches) {
  $("#logo").attr('src', 'img/iconcegep.jpg');
  $("#logo").width('auto');
  $("#btDeconnexion").html('Déconnexion');
} else {
  $("#logo").attr('src', 'img/iconcegepmin.jpg');
  $("#logo").width(53);
  $("#btDeconnexion").html("<i class='fas fa-sign-out-alt'></i>");
}

}



});


    </script>
