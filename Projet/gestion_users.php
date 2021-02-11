<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/gestion_users.css">


</head>
<body>

<script src="js/global.js" charset="utf-8"></script>
<script src="js/gestion_users.js" charset="utf-8"></script>

<?php
if (isset($_SESSION['type']) && ($_SESSION['type'] == "A" || $_SESSION['type'] == "P")) {?>
<br>
<br>
    <h1 >Gestion des utilisateurs</h1>
    <br><br>
    <input type="button" id="affProjet" class="btAffichage btn btn-secondary" value="Afficher les utilisateurs du projet sélectionné" onclick="pullusers('projet')"></input>
    <input type="button" id="affTous" class="btSelectAffichage btn btn-secondary" value="Afficher tous les utilisateurs" onclick="pullusers('all')"></input>
    <input type="button" id="affdisable" class="btSelectAffichage btn btn-secondary" value="Afficher tous les utilisateurs désactivés" onclick="pullusers('disable')"></input>

    <table id="tblUsers" class="table table-striped">
        <thead class="thead-dark">
        <th class="no-sort"scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Type</th>
        <th class="no-sort"scope="col">Actions</th>
        </thead>
        <tbody class="table-light">
        </tbody>
    </table>

<?php if ($_SESSION['type'] == "A") { ?>
    <input id="addUser" class="btn btn-primary float-right" type="button" value="Ajouter un utilisateur" data-toggle="modal" data-target="#addUserModal">
<?php } ?>


    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">Ajouter un utilisateur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form id="form_adduser" method="post">
              <div class="form-group">
                <label for="username">Nom d'utilisateur</label><input id="username" class="form-control" type="text" value="">
              </div>
              <div class="form-group">
                <label>Type</label><select id="type" class="form-control">
                  <option value="P">Enseignant/Accompagnateur</option>
                  <option value="A">Administrateur</option>
                </select>
              </div>

              <div class="form-group">
                <label for="password">Mot de passe</label><input id="password" class="form-control" type="text" value="" readonly>
                <input id="generate" class="btn btn-secondary" type="button" value="Générer un mot de passe">
              </div>
            </form>

          </div>
          <div class="modal-footer">
            <input id="submitAddUser" type="submit" form="form_adduser" class="btn btn-primary" value="Créer">
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button id="confirmBT" type="button" class="btn btn-danger" data-dismiss="modal">Oui</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetModalLabel">Mot de passe réinitialisé</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Mot de passe réinitialisé ; le nouveau mot de passe pour l'utilisateur <span
                                id="userReset"></span> est: <span id="tempPass"></span></p>
                    <p>Veuillez le garder en mémoire ou directement l'envoyer au propriétaire du compte car vous ne
                        pourrez plus le voir par la suite.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successerrorModal" tabindex="-1" role="dialog" aria-labelledby="successerrorModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successerrorModalLabel">Mot de passe réinitialisé</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>


</div><?php
} else {
        echo "<br><br><h3>Vous n'avez pas les autorisations nécessaires pour accéder à cette page.</h3>";
    }?>
</body>
</html>
