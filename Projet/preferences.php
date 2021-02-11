<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Préférences</title>

  <link rel="stylesheet" href="css/preferences.css">
  <!--[if lt IE 9]>
  <script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body>
  <div class="midSection">

    <input id="resetPass" class="btn btn-primary" type="button" value="Changer votre mot de passe" data-toggle='modal' data-target='#resetModal'>

    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetModalLabel">Changement de mot de passe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <label for="oldPass">Ancien mot de passe :</label>
                  <input id="oldPass" class="form-control" type="text">
                    <label for="newPass">Nouveau mot de passe :</label>
                    <input id="newPass" class="form-control" type="text">
                      <label for="newPass1">Confirmer le nouveu mot de passe :</label>
                      <input id="newPass1" class="form-control" type="text">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Valider</button>
                </div>
            </div>
        </div>
    </div>


  </div>

</body>
</html>
