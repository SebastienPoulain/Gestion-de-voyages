<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION["user"])) {
    header('Location: connection.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="icon" href="img/favicon.jpg" sizes="16x16" type="image/png">
  <title>Cégep de Trois-Rivières - Bureau international - Direction des communications et des affaires institutionnelles</title>
  <!--
    =============  CSS ==================================
   -->


    <link rel="stylesheet" href= "css/header.css" type="text/css">
    <link rel="stylesheet" href= "css/appreciation.css" type="text/css">
    <link rel="stylesheet" href= "css/apperciation_admin.css" type="text/css">


    <link rel="stylesheet" href= "css/stat_admin.css"><?php
     if (($_SESSION['imgProfil']== "img/imgForet.jpg")||($_SESSION['imgProfil']== "img/imgNature.jpg")||($_SESSION['imgProfil']== "img/ThemeMinecraft.png")||($_SESSION['imgProfil']== "img/ThemeVille.jpg")||($_SESSION['imgProfil']== "img/img1.jpg")) {?>
        <link rel="stylesheet" href="css/baseWhite.css"><?php
    } else { ?>
    <link rel="stylesheet" href="css/base.css"><?php
    } ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

</head>
<body style="with:100%; background-image: url('<?=$_SESSION['imgProfil']?>');" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" charset="utf-8"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
  <!--
    ============= SCRIPTS ===============
   -->
  <script src="js/global.js" charset="utf-8"></script>
  <script src="js/main.js" charset="utf-8"></script><?php
    include "header.php";



/* ===== SECTION ADMIN ====== */

if ($_SESSION["type"] == 'A') {
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
          case 'demande':
            include 'gestion_demandes.php';
            break;

          case 'gestion_users':
            include 'gestion_users.php';
            break;

          case 'viewdemande':
            include 'demandeform.php';
            break;

          case 'projets':
            include 'gestion_projets.php';
            break;

          case 'profil':
            include 'profil.php';
            break;

          case 'viewformulaire':
            include 'formulaire_etudiant.php';
            break;

            case 'viewBilan':
              include 'bilan.php';
              break;

          case 'Categorie':
            include 'ajoutCategorie.php';
            break;

          case 'formulaire':
            include 'formulairedyn.php';
            break;

          case 'pays':
            include 'pays.php';
            break;

          case 'programmes':
            include 'programmes.php';
            break;

          case 'appreciation_admin':
            include 'bilanAdmin.php';
            break;

          case 'stat':
            include 'stat_admin.php';
            break;

          case '404':
            include '404.php';
            break;

          case 'formdemande':
            include 'demandedyn.php';
            break;

          default:
            include 'gestion_projets.php';

      }
    } else {
        include 'gestion_projets.php';
    }
}

/* ===== SECTION PROF ====== */

if ($_SESSION["type"] == 'P') {
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
        case 'demande':
            if (isset($_GET['option']) && $_GET['option'] == "new") {
                include 'demandeform.php';
            } else {
                include 'gestion_demandes.php';
            }
            break;

          case 'gestion_users':
            include 'gestion_users.php';
            break;

          case 'viewdemande':
            include 'demandeform.php';
            break;

          case 'projets':
            include 'gestion_projets.php';
            break;

          case 'profil':
            include 'profil.php';
            break;

          case 'viewformulaire':
            include 'formulaire_etudiant.php';
            break;

          case 'bilan':
            include 'bilan.php';
            break;

          case 'formulaire':
            include 'formulaire_etudiant.php';
            break;


          case '404':
            include '404.php';
            break;

          default:
            include 'gestion_projets.php';

      }
    } else {
        include 'gestion_projets.php';
    }
}

/* ===== SECTION ETU ====== */

if ($_SESSION["type"] == 'E') {
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {

          case 'formulaire':
            include 'formulaire_etudiant.php';
            break;

          case 'viewdemande':
            include 'PageDemandeVoyage.php';
            break;

          case 'projets':
            include 'gestion_projets.php';
            break;

          case 'profil':
            include 'profil.php';
            break;


            case 'bilan':
              include 'bilan.php';
              break;

          case '404':
            include '404.php';
            break;

          default:
            include 'gestion_projets.php';

      }
    } else {
        include 'gestion_projets.php';
    }
}

?>

</body>
</html>
