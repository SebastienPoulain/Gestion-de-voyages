<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href= "css/base.css" type="text/css">
    <link rel="stylesheet" href= "css/profil.css" type="text/css">
    <title>Page de connexion</title>
    <link rel="icon" href="img/favicon.jpg" sizes="16x16" type="image/png">
</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="js/global.js"></script>

<header>
    <img id="logo" src="img/iconcegep.jpg" alt="Icone du cegep">
</header>


<div class="container contain container-fluid">
  <div class="row justify-content-center container-fluid" id="login-container">
        <form id="frm_connexion" method="POST">
          <div class="form-group container-fluid">
              <div id="connexion_alert" class="alert alert-danger" role="alert">
                      <div style="color:black;text-align:center;" id="alert_message">

                      </div>
                </div>
          </div>

            <div class="form-group container-fluid">
              <label id="lbUsername" for="tbUsername" >Nom d'utilisateur</label>
              <input type="text" placeholder="Faire attention aux lettres majuscules" class="form-control" id="tbUsername">
            </div>

            <div class="form-group container-fluid">
              <label id="lbPassword" for="tbPassword">Mot de passe</label>
              <input type="password" placeholder="Faire attention aux lettres majuscules" class="form-control" id="tbPassword">
            </div>

            <div>
              <a href="usr_create_account.php">Création de compte</a>
              <a style="float:right" href="forgottenPassword.php">Mot de passe oublié</a>
              <input style="margin-top:10px"type="submit" class="btn btn2 btn-secondary" id="btConnexion" value="Connexion"></input>
            </div>
        </form>
  </div>
</div>

<div id="result"></div>

<script src="js/connection.js"></script>
</body>
</html>
