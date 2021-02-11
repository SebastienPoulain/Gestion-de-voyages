<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/categorie.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<script src="js/programmes.js" charset="utf-8"></script><?php
  if (isset($_SESSION['type']) && ($_SESSION['type'] == "A")) {?>
<br>
<br>
    <h1 >Gestion des programmes</h1>
    <br><br>

    <table id="tblProg" class="table table-striped">
        <thead class="thead-dark">
        <th class="text-center no-sort" scope="col">#</th>
        <th class="text-center" scope="col">Programmes</th>
        <th class="text-center" scope="col">Statut</th>
        <th class="text-center no-sort" scope="col">Actions</th>
        </thead>
        <tbody class="table-light">
        </tbody>
    </table><?php if ($_SESSION['type'] == "A") { ?>
        <input id="addProg" class="btn btn-primary float-right" type="button" value="Ajouter un programme" data-toggle="modal" data-target="#addProgModal"><?php } ?>


        <div class="modal fade" id="addProgModal" tabindex="-1" role="dialog" aria-labelledby="addProgModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black !important;" class="modal-title" id="addProgModalLabel">Ajouter un programme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form id="form_addProg" method="post">
                  <div class="form-group">
                    <label style="color:black !important;" for="nomPays">Nom du programme</label>
                    <input id="nomProg" class="form-control" type="text" value="">
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <input id="submitAddProg" type="submit" form="form_addProg" class="btn btn-primary" value="Ajouter">
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modifProgModal" tabindex="-1" role="dialog" aria-labelledby="modifProgModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black !important;" class="modal-title" id="modifProgModalLabel">Modifier un programme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form id="form_modifProg" method="post">
                  <div class="form-group">
                    <label style="color:black !important;" for="nomProgmod">Nom du programme</label>
                    <input id="nomProgmod" class="form-control" type="text" value=>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <input id="submitModifProg" type="submit" form="form_modifProg" class="btn btn-primary" value="Modifier">
              </div>
            </div>
          </div>
        </div><?php
  } else {
      echo "<br><br><h3>Vous n'avez pas les autorisations nécessaires pour accéder à cette page.</h3>";
  }?>
</body>
</html>
