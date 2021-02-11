<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/categorie.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<script src="js/categorie.js" charset="utf-8"></script><?php
  if (isset($_SESSION['type']) && ($_SESSION['type'] == "A")) {?>
<br>
<br>
    <h1 >Gestion des catégories de questions</h1>
    <br><br>

    <table id="tblCat" class="table table-striped">
        <thead class="thead-dark">
        <th class="text-center no-sort" scope="col">#</th>
        <th class="text-center" scope="col">Catégorie</th>
        <th class="text-center" scope="col">Statut</th>
        <th class="text-center no-sort" scope="col">Actions</th>
        </thead>
        <tbody class="table-light">
        </tbody>
    </table><?php if ($_SESSION['type'] == "A") { ?>
        <input id="addCategorie" class="btn btn-primary float-right" type="button" value="Ajouter une catégorie" data-toggle="modal" data-target="#addCatModal"><?php } ?>


        <div class="modal fade" id="addCatModal" tabindex="-1" role="dialog" aria-labelledby="addCatModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black !important;" class="modal-title" id="addCatModalLabel">Ajouter une catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form id="form_addCat" method="post">
                  <div class="form-group">
                    <label style="color:black !important;" for="nomCat">Nom de la catégorie</label>
                    <input id="nomCat" class="form-control" type="text" value="">
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <input id="submitAddCat" type="submit" form="form_addCat" class="btn btn-primary" value="Ajouter">
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modifCatModal" tabindex="-1" role="dialog" aria-labelledby="modifCatModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black !important;" class="modal-title" id="modifCatModalLabel">Modifier une catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form id="form_modifCat" method="post">
                  <div class="form-group">
                    <label style="color:black !important;" for="nomCatmod">Nom de la catégorie</label>
                    <input id="nomCatmod" class="form-control" type="text" value=>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <input id="submitModifCat" type="submit" form="form_modifCat" class="btn btn-primary" value="Modifier">
              </div>
            </div>
          </div>
        </div><?php
  } else {
      echo "<br><br><h3>Vous n'avez pas les autorisations nécessaires pour accéder à cette page.</h3>";
  }?>
</body>
</html>
