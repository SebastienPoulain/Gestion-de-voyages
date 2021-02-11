<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href= "css/connection.css" type="text/css">
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


<div class="container-fluid container contain container-fluid">
  <div class="container-fluid row justify-content-center container-fluid">
        <form id="frm_forgot" method="POST">
          <div class="container-fluid form-group container-fluid">
            <div id="forgot_alert" class="alert alert-danger" role="alert">
                    <div id="alert_message">

                    </div>
              </div>
            <h2 style="color:white;margin-bottom:10%;text-align:center;">Mot de passe oublié</h2>
            <div class="container-fluid form-group container-fluid">
              <input type="text" placeholder="Adresse courriel" name="email"  class="form-control" id="email">
            </div>

            <div>
                <input type="submit" class="btn btn-secondary" id="btEnvoyer" value="Envoyer"></input>
                <input style="float:right" type="button"class="btn btn-secondary" onclick="location.href='connection.php'" value="Annuler"></input>
            </div>
        </form>
    </div>
  </div>

<script src="js/forgot.js"></script>
</body>
</html>
