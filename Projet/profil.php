<!DOCTYPE html>
<html><?php
    include "php/BD.inc.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
         $sql = "SELECT * FROM  utilisateurs WHERE ID =".$_SESSION['userID'];
                $test= $conn->prepare($sql);
                $test->execute();
                while ($ligne=$test->fetch()) {
                    $prenom = $ligne["prenom"];
                    $nom = $ligne["nom"];
                    $username = $ligne["username"];
                    $email = $ligne["email"];
                    $programme = $ligne["programme"];
                    $telephone = $ligne["telephone"];
                }?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Profil</title>
    <!--[if lt IE 9]>
  <script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  </head>

  <body style="with:100%; background-image: url('<?=$_SESSION['imgProfil']?>');" >

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" charset="utf-8"></script>
    <script src="js/profil.js" charset="utf-8"></script>
    <link rel="stylesheet" href= "css/profil.css">

<div>
<br>
<br>
<div style="margin-top:1vh" class="container contain">
    <div class="container-fluid row" id="login-container">
      <div style="margin:0px auto"class="col-8 offset-1">

        <form id="frm_register" method="post">

 <h1 class="text-white">Profil</h1>
            <div class="container-fluid form-group ui-widget">
              <label id="lbProg" for="tbProg" >Nom du programme d'étude</label>
              <select type="" class="form-control" id="tbProg"  name="tbProg">

              <option selected><?=$programme?></option><?php
                $sql = "SELECT * FROM  programmes";
                $test= $conn->prepare($sql);
                $test->execute();
                while ($ligne=$test->fetch()) {?> <option><?=$ligne['nom_programme'] ?></option><?php }?>
              </select>
            </div>

            <div class="container-fluid form-group">
              <label id="lbPrenom" for="tbPrenom" >Prénom </label>
               <input type="text" class="form-control" id="tbPrenom"  name="tbPrenom" value= <?= $prenom ?>>


            </div>

            <div class="container-fluid form-group">
              <label id="lbNom" for="tbNom" >Nom</label>

               <input type="text" class="form-control" id="tbNom" name="tbNom" value= <?=$nom ?>>

            </div>


            <div class="container-fluid form-group">
              <label id="lbUsername" for="tbUsername" >Nom d'utilisateur</label>

                 <input type="text" class="form-control" id="tbUserName" name="tbUserName" value= <?=$username ?>>

            </div>

            <div class="container-fluid form-group ">
              <label id="lbEmail" for="tbEmail">Adresse courriel</label>

              <input type="text" class="form-control" id="tbEmail" name="tbEmail" value= <?=$email ?>>

            </div>

            <div class="container-fluid form-group">
              <label id="lbTel" for="tbTel" >Numéro de téléphone</label>

              <input type="text" class="form-control" id="tbTel" name="tbTel" value= <?=$telephone ?>>

            </div>

      <br>
      <br>
      <input id="sauvegarderProfil" class="btn btn-primary col-md-12" type="submit" value="Sauvegarder les changements" name="Save">
      <br>
      <br>
      <input id="resetPass" class="btn btn-primary col-md-12" type="button" value="Changer votre mot de passe" data-toggle="modal" data-target="#resetModal">
      <br>
      <br>
      <input id="CahngerImg" class="btn btn-primary col-md-12" type="button" value="Changer thème" data-toggle="modal" data-target="#ChangerImg">
      <br>


        </form>
      </div>
    </div>
  </div>


    </div>

      <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="resetModalLabel" style="color:black">Changement de mot de passe</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_changepass" method="post" >

                <label for="oldPass"style="color:black" >Mot de passe actuel :</label>
                <input id="oldPass"style="color:black" class="form-control" type="password">
                <label for="newPass" style="color:black">Nouveau mot de passe :</label>
                <input id="newPass" class="form-control" type="password">
                <label for="newPass1" style="color:black">Confirmer le nouveau mot de passe :</label>
                <input id="newPass1" style="color:black" class="form-control" type="password">

              </form>

            </div>
            <div class="modal-footer">
            <input type="submit" form="form_changepass" class="btn btn-success" value="Changer"></input>
              <button  type="button" class="btn btn2 btn-secondary aria-label="Close" data-dismiss="modal" pull-left">Annuler</button>
            </div>
          </div>
        </div>
      </div>


    </div>

      <div class="modal fade" id="ChangerImg" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="resetModalLabel" style="color:black">Changement le thème de l'application</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

    <form id="form_changeImg" method="post" >

<table style="width:100%">
  <tr>
    <th>
      <div class="container-fluid gallery">
    <img src="img/ThemeVille.jpg" width="100" height="100">
    <input type="radio" name="img" value="img/ThemeVille.jpg" style="margin:auto;">
    </div>
</th>

    <th>
      <div class="container-fluid gallery">
    <img src="img/ThemeMinecraft.png" width="100" height="100">
     <input type="radio" name="img" value="img/ThemeMinecraft.png" style="margin:auto;">
    </div>
</th>

     <th>
      <div class="container-fluid gallery">
    <img src="img/img1.jpg" width="100" height="100">
     <input type="radio" name="img" value="img/img1.jpg" style="margin:auto;">
    </div>
</th>
  </tr>
  <tr>
    <th>
      <div class="container-fluid gallery">
    <img src="img/imgMontagne.jpg" width="100" height="100">
      <input type="radio" name="img" value="img/imgMontagne.jpg" style="margin:auto;">
    </div>
</th>
    <th>
      <div class="container-fluid gallery">
    <img src="img/img3.jpg" width="100" height="100">
     <input type="radio" name="img" value="img/img3.jpg" style="margin:auto;">
    </div>
</th>
    <th>
      <div class="container-fluid gallery">

    <img src="img/imgHiver.jpg" width="100" height="100">
     <input type="radio" name="img" value="img/imgHiver.jpg" style="margin:auto;">
    </div>
</th>
  </tr>
  <tr>
    <th>
      <div class="container-fluid gallery">

    <img src="img/imgForet.jpg" width="100" height="100">
     <input type="radio" name="img" value="img/imgForet.jpg" style="margin:auto;">
    </div>
</th>
    <th>
      <div class="container-fluid gallery">

    <img src="img/img6.jpg" width="100" height="100">
     <input type="radio" name="img" value="img/img6.jpg" style="margin:auto;">
    </div>
</th>
    <th>
      <div class="container-fluid gallery">
    <img src="img/imgNature.jpg" width="100" height="100">
        <input type="radio" name="img" value="img/imgNature.jpg" style="margin:auto;">
    </div>
</th>
  </tr>
</table>
       <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="NewImage" id="NewImage"></input>
              <button type="button" class="btn btn2 btn-secondary pull-left" data-dismiss="modal">Annuler</button>
            </div>

  </form>
            </div>

          </div>
        </div>
      </div>


</div>




  </body>

</html>
