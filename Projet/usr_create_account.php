<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href= "css/base.css" type="text/css">
  <link rel="icon" href="./img/favicon.jpg" sizes="16x16" type="image/png">
  <title>Création de compte</title>
</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>


<header>
    <img id="logo" src="img/iconcegep.jpg" alt="Icone du cegep">
</header>

  <div style="margin-top:1vh" class="container contain">
    <div class="container-fluid row" id="login-container">
      <div style="margin:0px auto"class="col-8 offset-1">
        <form id="frm_register" method="POST">
          <div id="create_alert" class="alert alert-danger" role="alert">
                  <div style="text-align:center;color:black;"id="alert_message">

                  </div>
            </div>

          <div class="container-fluid form-group">
              <label id="lbCode" for="tbCode" >Code de projet</label>
              <input type="text" class="form-control" id="tbCode" >
            </div>

            <div class="container-fluid form-group">
              <label id="lbProg" for="tbProg" >Nom du programme d'étude</label>
              <select type="" class="form-control" id="tbProg" >
			  <?php
               include "php/BD.inc.php";
                $sql = "SELECT * FROM  programmes";
                $test= $conn->prepare($sql);
                $test->execute();
                while($ligne=$test->fetch()){?> <option><?=$ligne['nom_programme'] ?></option><?php }?>
              </select>
            </div>

            <div class="container-fluid form-group">
              <label id="lbPrenom" for="tbPrenom" >Prénom</label>
              <input type="text" class="form-control" id="tbPrenom" >
            </div>

            <div class="container-fluid form-group">
              <label id="lbNom" for="tbNom" >Nom</label>
              <input type="text" class="form-control" id="tbNom" >
            </div>


              <label  id="lbHomme" for="tbHomme" >Homme</label>
              <input style="display:inline-block" name="sexe"  type="radio" value="homme"  id="tbHomme">
              <label id="lbFemme" for="tbFemme" >Femme</label>
              <input style="display:inline-block" name="sexe" type="radio"  value="femme"  id="tbFemme">
              <label id="lbAutre" for="tbAutre" >Autre</label>
              <input style="display:inline-block" name="sexe" type="radio" value="autre" id="tbAutre">


            <div class="container-fluid form-group">
              <label id="lbUsername" for="tbUsername" >Nom d'utilisateur</label>
              <input type="text" class="form-control" id="tbUsername" >
            </div>

            <div class="container-fluid form-group ">
              <label id="lbEmail" for="tbEmail">Adresse courriel</label>
              <input type="text" class="form-control" id="tbEmail" >
            </div>

            <div class="container-fluid form-group">
              <label id="lbTel" for="tbTel" >Numéro de téléphone</label>
              <input type="text" class="form-control" id="tbTel" >
            </div>


            <div class="container-fluid form-group">
              <label id="lbPassword" for="tbPassword">Mot de passe</label>
              <input type="password" class="form-control" id="tbPassword" >
            </div>

            <div class="container-fluid form-group">
              <label id="lbConfirmPassword" for="tbConfirmPassword">Confirmer le mot de passe</label>
              <input type="password" class="form-control" id="tbConfirmPassword" >
            </div>

          <div>
            <input class="btn btn-secondary" id="btCreateAccount" type="submit" value="Créer un compte"></input>
            <input style="float:right" class="btn  btn-secondary" id="btAnnuler" onclick="window.location.href='connection.php'" type="button" value="Annuler"></input>
          </div>

        </form>
      </div>
    </div>
  </div>

  <script src="js/global.js"></script>
  <script src="js/usr_create_account.js"></script>
</body>
</html>
