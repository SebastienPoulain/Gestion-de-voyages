<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/categorie.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<script src="js/pays.js" charset="utf-8"></script><?php
  if (isset($_SESSION['type']) && ($_SESSION['type'] == "A")) {?>
<br>
<br>
    <h1>Gestion des pays</h1>
    <br><br>

    <table id="tblPays" class="table table-striped">
        <thead class="thead-dark">
        <th class="text-center no-sort" scope="col">#</th>
        <th class="text-center" scope="col">Pays</th>
        <th class="text-center" scope="col">Statut</th>
        <th class="text-center no-sort" scope="col">Actions</th>
        </thead>
        <tbody class="table-light">
        </tbody>
    </table><?php if ($_SESSION['type'] == "A") { ?>
        <input id="addPays" class="btn btn-primary float-right" type="button" value="Ajouter un pays" data-toggle="modal" data-target="#addPaysModal"><?php } ?>


        <div class="modal fade" id="addPaysModal" tabindex="-1" role="dialog" aria-labelledby="addPaysModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black !important;" class="modal-title" id="addPaysModalLabel">Ajouter un pays</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form id="form_addPays" method="post">
                  <div class="form-group">
                    <label style="color:black !important;" for="nomPays">Nom du pays</label>
                    <input id="nomPays" class="form-control" type="text" value="">
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <input id="submitAddPays" type="submit" form="form_addPays" class="btn btn-primary" value="Ajouter">
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modifPaysModal" tabindex="-1" role="dialog" aria-labelledby="modifPaysModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black !important;" class="modal-title" id="modifPaysModalLabel">Modifier un pays</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form id="form_modifPays" method="post">
                  <div class="form-group">
                    <label style="color:black !important;" for="nomPaysmod">Nom du pays</label>
                    <input id="nomPaysmod" class="form-control" type="text" value=>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <input id="submitModifPays" type="submit" form="form_modifPays" class="btn btn-primary" value="Modifier">
              </div>
            </div>
          </div>
        </div><?php
  } else {
      echo "<br><br><h3>Vous n'avez pas les autorisations nécessaires pour accéder à cette page.</h3>";
  }?>
</body>
</html>
